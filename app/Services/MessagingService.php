<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Notification;
use App\Models\ConversationThread;
use App\Models\CommunicationPermission;
use App\Models\User;
use App\Models\FarmerGroup;

/**
 * MessagingService
 * 
 * Service class for managing inter-role communication
 * Provides high-level operations for the messaging system
 */
class MessagingService
{
    /**
     * Send a message with full validation
     * 
     * @param User $sender
     * @param array $data Message data (recipient_id, subject, content, etc.)
     * @return Message|null
     */
    public static function sendMessage(User $sender, array $data): ?Message
    {
        // Validate permissions
        if (!self::validateSendPermission($sender, $data)) {
            return null;
        }

        // Create message
        $message = Message::create([
            'sender_id' => $sender->id,
            'recipient_id' => $data['recipient_id'] ?? null,
            'subject' => $data['subject'],
            'content' => $data['content'],
            'message_type' => $data['message_type'] ?? 'direct',
            'priority' => $data['priority'] ?? 'normal',
            'recipient_type' => $data['recipient_type'] ?? null,
            'target_group_id' => $data['target_group_id'] ?? null,
        ]);

        // Handle broadcast recipients
        if ($message->message_type === 'broadcast' && isset($data['target_group_id'])) {
            self::createBroadcastRecipients($message, $data['target_group_id']);
        }

        // Create notifications
        self::createNotifications($message);

        return $message;
    }

    /**
     * Validate that sender has permission to send
     */
    public static function validateSendPermission(User $sender, array $data): bool
    {
        $messageType = $data['message_type'] ?? 'direct';

        if ($messageType === 'direct') {
            $recipient = User::find($data['recipient_id'] ?? null);
            if (!$recipient) {
                return false;
            }

            return CommunicationPermission::isAllowed(
                $sender->role,
                $recipient->role,
                'direct'
            );
        }

        if ($messageType === 'broadcast') {
            return CommunicationPermission::isAllowed(
                $sender->role,
                'farmer',
                'broadcast'
            );
        }

        if ($messageType === 'announcement') {
            return CommunicationPermission::isAllowed(
                $sender->role,
                'farmer',
                'announcement'
            );
        }

        return false;
    }

    /**
     * Create recipient entries for broadcast
     */
    private static function createBroadcastRecipients(Message $message, int $groupId): void
    {
        $group = FarmerGroup::findOrFail($groupId);
        $farmers = $group->farmers()->with('users')->get()->pluck('users.id')->unique();

        foreach ($farmers as $farmerId) {
            $message->recipients()->attach($farmerId, [
                'recipient_role' => 'farmer',
                'is_read' => false,
            ]);
        }
    }

    /**
     * Create notifications for message recipients
     */
    private static function createNotifications(Message $message): void
    {
        $recipientIds = [];

        if ($message->recipient_id) {
            $recipientIds[] = $message->recipient_id;
        }

        if ($message->recipients->isNotEmpty()) {
            $recipientIds = array_merge($recipientIds, $message->recipients->pluck('id')->toArray());
        }

        $recipientIds = array_unique($recipientIds);

        foreach ($recipientIds as $recipientId) {
            Notification::create([
                'user_id' => $recipientId,
                'message_id' => $message->id,
                'notification_channel' => 'in_app',
            ]);
        }
    }

    /**
     * Get inbox for user with filters
     */
    public static function getInbox(User $user, array $filters = [])
    {
        $query = Message::where(function ($q) use ($user) {
            $q->where('recipient_id', $user->id)
                ->orWhereHas('recipients', function ($subQ) use ($user) {
                    $subQ->where('user_id', $user->id);
                });
        });

        // Apply filters
        if (!empty($filters['unread_only'])) {
            $query->where('is_read', false);
        }

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (!empty($filters['sender_id'])) {
            $query->where('sender_id', $filters['sender_id']);
        }

        if (!empty($filters['from_date'])) {
            $query->whereDate('sent_at', '>=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $query->whereDate('sent_at', '<=', $filters['to_date']);
        }

        return $query->with('sender')
            ->orderByDesc('sent_at')
            ->paginate($filters['per_page'] ?? 15);
    }

    /**
     * Get conversation threads for user
     */
    public static function getThreads(User $user, array $filters = [])
    {
        $query = ConversationThread::whereHas('participants', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        });

        if (!empty($filters['open_only'])) {
            $query->where('is_closed', false);
        }

        return $query->with('initiator', 'participants', 'lastMessage')
            ->orderByDesc('last_activity_at')
            ->paginate($filters['per_page'] ?? 10);
    }

    /**
     * Create a conversation thread
     */
    public static function createThread(User $initiator, array $data): ?ConversationThread
    {
        $thread = ConversationThread::create([
            'initiator_id' => $initiator->id,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
        ]);

        // Add initiator
        $thread->addParticipant($initiator);

        // Add participants, checking permissions
        if (!empty($data['participant_ids'])) {
            foreach ($data['participant_ids'] as $participantId) {
                $participant = User::findOrFail($participantId);

                // Verify permission
                if (CommunicationPermission::isAllowed(
                    $initiator->role,
                    $participant->role,
                    'direct'
                )) {
                    $thread->addParticipant($participant);
                }
            }
        }

        return $thread;
    }

    /**
     * Reply to thread
     */
    public static function replyToThread(User $replier, ConversationThread $thread, string $content): ?Message
    {
        // Check if user is participant and thread is open
        if (!$thread->isParticipant($replier) || $thread->is_closed) {
            return null;
        }

        $message = Message::create([
            'sender_id' => $replier->id,
            'thread_id' => $thread->id,
            'subject' => 'Re: ' . $thread->title,
            'content' => $content,
            'message_type' => 'direct',
            'priority' => 'normal',
        ]);

        // Add recipients (all participants except sender)
        $thread->participants()
            ->where('user_id', '!=', $replier->id)
            ->pluck('user_id')
            ->each(function ($userId) use ($message) {
                $message->recipients()->attach($userId, ['recipient_role' => 'unknown']);
            });

        // Update thread
        $thread->update([
            'last_message_id' => $message->id,
            'last_activity_at' => now(),
        ]);

        return $message;
    }

    /**
     * Get role-based statistics
     */
    public static function getStatistics(User $user): array
    {
        return [
            'total_sent' => Message::where('sender_id', $user->id)->count(),
            'total_received' => Message::where('recipient_id', $user->id)->count(),
            'unread_count' => Message::unreadCountForUser($user),
            'unread_notifications' => Notification::unreadForUser($user)->count(),
            'active_threads' => ConversationThread::whereHas('participants', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->where('is_closed', false)->count(),
            'available_recipient_roles' => $user->getAvailableRecipientRoles(),
        ];
    }

    /**
     * Bulk send message to multiple recipients
     */
    public static function bulkSendMessage(User $sender, array $recipientIds, array $data): array
    {
        $results = [
            'sent' => 0,
            'failed' => 0,
            'messages' => [],
        ];

        foreach ($recipientIds as $recipientId) {
            $recipient = User::find($recipientId);
            if (!$recipient) {
                $results['failed']++;
                continue;
            }

            $messageData = array_merge($data, [
                'recipient_id' => $recipientId,
                'message_type' => 'direct',
            ]);

            $message = self::sendMessage($sender, $messageData);
            if ($message) {
                $results['sent']++;
                $results['messages'][] = $message->id;
            } else {
                $results['failed']++;
            }
        }

        return $results;
    }

    /**
     * Archive old messages
     */
    public static function archiveOldMessages(User $user, int $daysOld = 30): int
    {
        $cutoffDate = now()->subDays($daysOld);

        return Message::where(function ($q) use ($user) {
            $q->where('recipient_id', $user->id)
                ->orWhereHas('recipients', function ($subQ) use ($user) {
                    $subQ->where('user_id', $user->id);
                });
        })
            ->where('sent_at', '<', $cutoffDate)
            ->where('is_archived', false)
            ->update(['is_archived' => true]);
    }

    /**
     * Close a thread
     */
    public static function closeThread(ConversationThread $thread, User $user): bool
    {
        // Only initiator can close
        if ($thread->initiator_id !== $user->id) {
            return false;
        }

        $thread->close();
        return true;
    }

    /**
     * Get communication capabilities for a role
     */
    public static function getRoleCapabilities(string $role): array
    {
        $permissions = CommunicationPermission::where('sender_role', $role)
            ->where('is_enabled', true)
            ->get();

        $capabilities = [
            'can_send_direct' => false,
            'can_broadcast' => false,
            'can_announce' => false,
            'recipient_roles' => [],
            'methods' => [],
        ];

        foreach ($permissions as $permission) {
            if ($permission->communication_method === 'direct') {
                $capabilities['can_send_direct'] = true;
            }
            if ($permission->communication_method === 'broadcast') {
                $capabilities['can_broadcast'] = true;
            }
            if ($permission->communication_method === 'announcement') {
                $capabilities['can_announce'] = true;
            }

            $capabilities['recipient_roles'][] = $permission->recipient_role;
            $capabilities['methods'][] = $permission->communication_method;
        }

        $capabilities['recipient_roles'] = array_unique($capabilities['recipient_roles']);
        $capabilities['methods'] = array_unique($capabilities['methods']);

        return $capabilities;
    }

    /**
     * Mark all messages as read
     */
    public static function markAllAsRead(User $user): int
    {
        return Message::where(function ($q) use ($user) {
            $q->where('recipient_id', $user->id)
                ->orWhereHas('recipients', function ($subQ) use ($user) {
                    $subQ->where('user_id', $user->id);
                });
        })
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
    }

    /**
     * Search messages
     */
    public static function searchMessages(User $user, string $query): array
    {
        return Message::where(function ($q) use ($user) {
            $q->where('recipient_id', $user->id)
                ->orWhereHas('recipients', function ($subQ) use ($user) {
                    $subQ->where('user_id', $user->id);
                });
        })
            ->where(function ($q) use ($query) {
                $q->where('subject', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->with('sender')
            ->get()
            ->toArray();
    }
}
