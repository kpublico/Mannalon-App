<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use App\Models\ConversationThread;
use App\Models\User;
use App\Models\FarmerGroup;
use App\Models\CommunicationPermission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class MessagingController extends Controller
{
    /**
     * Display the messaging inbox
     */
    public function inbox(): View
    {
        $user = Auth::user();
        $messages = Message::where('recipient_id', $user->id)
            ->orWhereHas('recipients', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->orderByDesc('sent_at')
            ->paginate(15);

        $unreadCount = Message::unreadCountForUser($user);

        return view('messaging.inbox', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
        ]);
    }

    /**
     * Display compose message form
     */
    public function compose(): View
    {
        $user = Auth::user();
        $availableRoles = $this->getAvailableRecipientRoles($user);

        return view('messaging.compose', [
            'availableRoles' => $availableRoles,
        ]);
    }

    /**
     * Store a new message
     */
    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'recipient_id' => 'nullable|exists:users,id',
            'recipient_role' => 'nullable|string',
            'target_group_id' => 'nullable|exists:farmer_groups,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'message_type' => 'required|in:direct,broadcast,announcement',
            'priority' => 'required|in:low,normal,high,urgent',
        ]);

        // Determine recipient and message type
        $messageType = $validated['message_type'];
        $recipient = null;

        if ($messageType === 'direct' && $validated['recipient_id']) {
            $recipient = User::findOrFail($validated['recipient_id']);

            // Check permission
            if (!Message::canSend($user, $recipient, 'direct')) {
                return response()->json(['error' => 'You do not have permission to send messages to this role'], 403);
            }
        } elseif (in_array($messageType, ['broadcast', 'announcement'])) {
            // Check if user can broadcast/announce
            if (!$user->can('send-broadcasts')) {
                return response()->json(['error' => 'You do not have permission to send broadcasts'], 403);
            }
        }

        // Create the message
        try {
            $message = Message::create([
                'sender_id' => $user->id,
                'recipient_id' => $recipient?->id,
                'subject' => $validated['subject'],
                'content' => $validated['content'],
                'message_type' => $messageType,
                'priority' => $validated['priority'],
                'recipient_type' => $validated['recipient_role'] ?? null,
                'target_group_id' => $validated['target_group_id'] ?? null,
            ]);

            // Handle broadcast recipients
            if ($messageType === 'broadcast' && $validated['target_group_id']) {
                $this->createBroadcastRecipients($message, $validated['target_group_id']);
            }

            // Create notifications
            $this->createNotifications($message);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'data' => $message->load('sender'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send message: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show a specific message
     */
    public function show(Message $message): View
    {
        $this->authorize('view', $message);

        // Mark as read
        $message->markAsRead();

        return view('messaging.show', [
            'message' => $message->load('sender', 'recipient'),
        ]);
    }

    /**
     * Mark message as read
     */
    public function markAsRead(Message $message): JsonResponse
    {
        $this->authorize('view', $message);
        $message->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Archive a message
     */
    public function archive(Message $message): JsonResponse
    {
        $this->authorize('update', $message);
        $message->archive();

        return response()->json(['success' => true]);
    }

    /**
     * Delete a message
     */
    public function delete(Message $message): JsonResponse
    {
        $this->authorize('delete', $message);
        $message->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Get notifications for current user
     */
    public function notifications(): JsonResponse
    {
        $user = Auth::user();
        $notifications = Notification::unreadForUser($user);

        return response()->json([
            'count' => $notifications->count(),
            'notifications' => $notifications,
        ]);
    }

    /**
     * Dismiss a notification
     */
    public function dismissNotification(Notification $notification): JsonResponse
    {
        $this->authorize('update', $notification);
        $notification->dismiss();

        return response()->json(['success' => true]);
    }

    /**
     * Start a conversation thread
     */
    public function startConversation(Request $request): JsonResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'participant_ids' => 'required|array|min:1',
            'participant_ids.*' => 'exists:users,id',
        ]);

        try {
            $thread = ConversationThread::create([
                'initiator_id' => $user->id,
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
            ]);

            // Add initiator as participant
            $thread->addParticipant($user);

            // Add other participants
            foreach ($validated['participant_ids'] as $participantId) {
                $participant = User::findOrFail($participantId);
                // Verify permission to add participant
                if (Message::canSend($user, $participant, 'direct')) {
                    $thread->addParticipant($participant);
                }
            }

            return response()->json([
                'success' => true,
                'thread' => $thread,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all conversation threads for user
     */
    public function threads(): View
    {
        $user = Auth::user();
        $threads = $user->conversationThreads()
            ->with('initiator', 'participants', 'lastMessage')
            ->orderByDesc('last_activity_at')
            ->paginate(10);

        return view('messaging.threads', [
            'threads' => $threads,
        ]);
    }

    /**
     * Show a specific conversation thread
     */
    public function showThread(ConversationThread $thread): View
    {
        $this->authorize('view', $thread);

        $messages = $thread->messages()
            ->with('sender', 'recipients')
            ->paginate(20);

        return view('messaging.thread', [
            'thread' => $thread,
            'messages' => $messages,
        ]);
    }

    /**
     * Reply to a conversation thread
     */
    public function replyThread(Request $request, ConversationThread $thread): JsonResponse
    {
        $this->authorize('reply', $thread);
        $user = Auth::user();

        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        try {
            $message = Message::create([
                'sender_id' => $user->id,
                'thread_id' => $thread->id,
                'subject' => 'Re: ' . $thread->title,
                'content' => $validated['content'],
                'message_type' => 'direct',
                'priority' => 'normal',
            ]);

            // Add as recipient to all participants except sender
            $thread->participants()
                ->where('user_id', '!=', $user->id)
                ->get()
                ->each(function ($participant) use ($message) {
                    $message->recipients()->attach($participant->user_id);
                });

            // Update thread last activity
            $thread->update([
                'last_message_id' => $message->id,
                'last_activity_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => $message->load('sender'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get available recipient roles for current user
     */
    protected function getAvailableRecipientRoles(User $user): array
    {
        $senderRole = $user->role->name;

        return CommunicationPermission::where('sender_role', $senderRole)
            ->where('is_enabled', true)
            ->pluck('recipient_role')
            ->unique()
            ->toArray();
    }

    /**
     * Create recipients for broadcast messages
     */
    protected function createBroadcastRecipients(Message $message, int $groupId): void
    {
        $group = FarmerGroup::findOrFail($groupId);
        $farmers = $group->farmers()
            ->with('users')
            ->get()
            ->pluck('users.id')
            ->unique();

        foreach ($farmers as $farmerId) {
            $message->recipients()->attach($farmerId, [
                'recipient_role' => 'farmer',
            ]);
        }
    }

    /**
     * Create notifications for message recipients
     */
    protected function createNotifications(Message $message): void
    {
        $recipientIds = [];

        if ($message->recipient_id) {
            $recipientIds[] = $message->recipient_id;
        } elseif ($message->recipients->isNotEmpty()) {
            $recipientIds = $message->recipients->pluck('id')->toArray();
        }

        foreach ($recipientIds as $recipientId) {
            Notification::create([
                'user_id' => $recipientId,
                'message_id' => $message->id,
                'notification_channel' => 'in_app',
            ]);
        }
    }

    /**
     * Get message statistics for dashboard
     */
    public function getStatistics(): JsonResponse
    {
        $user = Auth::user();

        $stats = [
            'total_messages' => Message::where('sender_id', $user->id)->count(),
            'received_messages' => Message::where('recipient_id', $user->id)->count(),
            'unread_count' => Message::unreadCountForUser($user),
            'active_threads' => ConversationThread::whereHas('participants', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->where('is_closed', false)->count(),
        ];

        return response()->json($stats);
    }
}
