<?php

namespace App\Modules\Messaging\Controllers;

use App\Modules\Messaging\Models\Message;
use App\Modules\Notification\Models\Notification;
use App\Modules\Messaging\Models\ConversationThread;
use App\Modules\Auth\Models\User;
use App\Modules\Farmer\Models\FarmerGroup;
use App\Modules\Shared\Models\CommunicationPermission;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

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
            'subject' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'message_type' => 'required|in:direct,broadcast',
            'priority' => 'required|in:low,normal,high,urgent',
        ]);

        try {
            $message = Message::create([
                'sender_id' => $user->id,
                'recipient_id' => $validated['recipient_id'] ?? null,
                'subject' => $validated['subject'],
                'content' => $validated['content'],
                'message_type' => $validated['message_type'],
                'priority' => $validated['priority'],
            ]);

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
        return view('messaging.show', [
            'message' => $message->load('sender', 'recipient'),
        ]);
    }

    /**
     * Mark message as read
     */
    public function markAsRead(Message $message): JsonResponse
    {
        return response()->json(['success' => true]);
    }

    /**
     * Delete a message
     */
    public function delete(Message $message): JsonResponse
    {
        $message->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Get notifications for current user
     */
    public function notifications(): JsonResponse
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->get();

        return response()->json([
            'count' => $notifications->count(),
            'notifications' => $notifications,
        ]);
    }

    /**
     * Get available recipient roles based on user role
     */
    private function getAvailableRecipientRoles($user): array
    {
        $roles = [];
        
        if ($user->role === 'admin' || $user->role === 'super_admin') {
            $roles = ['farmer', 'admin', 'supervisor'];
        } elseif ($user->role === 'farmer') {
            $roles = ['admin', 'supervisor'];
        }

        return $roles;
    }
}
