<?php

namespace App\Traits;

use App\Models\Message;
use App\Models\User;

/**
 * RoleMessagingTrait
 * 
 * Provides messaging capabilities and permissions based on user roles.
 * Allows different roles to communicate through controlled channels.
 */
trait RoleMessagingTrait
{
    /**
     * Get all roles this user can send messages to
     */
    public function getAvailableRecipientRoles(): array
    {
        return \App\Models\CommunicationPermission::where('sender_role', $this->role)
            ->where('is_enabled', true)
            ->pluck('recipient_role')
            ->unique()
            ->toArray();
    }

    /**
     * Get available communication methods for a specific recipient role
     */
    public function getAvailableMethods(string $recipientRole): array
    {
        return \App\Models\CommunicationPermission::where('sender_role', $this->role)
            ->where('recipient_role', $recipientRole)
            ->where('is_enabled', true)
            ->pluck('communication_method')
            ->toArray();
    }

    /**
     * Check if user can send direct messages to a specific recipient
     */
    public function canSendDirectMessageTo(User $recipient): bool
    {
        return \App\Models\CommunicationPermission::isAllowed($this->role, $recipient->role, 'direct');
    }

    /**
     * Check if user can send broadcast messages (to groups)
     */
    public function canSendBroadcast(): bool
    {
        return \App\Models\CommunicationPermission::isAllowed($this->role, 'farmer', 'broadcast');
    }

    /**
     * Check if user can send announcements (system-wide)
     */
    public function canSendAnnouncements(): bool
    {
        return \App\Models\CommunicationPermission::isAllowed($this->role, 'farmer', 'announcement');
    }

    /**
     * Send a direct message to another user
     */
    public function sendDirectMessage(User $recipient, string $subject, string $content, array $options = []): ?Message
    {
        if (!$this->canSendDirectMessageTo($recipient)) {
            return null;
        }

        return Message::create([
            'sender_id' => $this->id,
            'recipient_id' => $recipient->id,
            'subject' => $subject,
            'content' => $content,
            'message_type' => 'direct',
            'priority' => $options['priority'] ?? 'normal',
        ]);
    }

    /**
     * Send a broadcast message to a farmer group
     */
    public function sendBroadcastToGroup(int $groupId, string $subject, string $content, array $options = []): ?Message
    {
        if (!$this->canSendBroadcast()) {
            return null;
        }

        $message = Message::create([
            'sender_id' => $this->id,
            'subject' => $subject,
            'content' => $content,
            'message_type' => 'broadcast',
            'target_group_id' => $groupId,
            'priority' => $options['priority'] ?? 'normal',
        ]);

        // Add recipients
        $group = \App\Models\FarmerGroup::findOrFail($groupId);
        $farmers = $group->farmers()->pluck('user_id');

        foreach ($farmers as $farmerId) {
            $message->recipients()->attach($farmerId, ['recipient_role' => 'farmer']);
        }

        return $message;
    }

    /**
     * Send a system announcement
     */
    public function sendSystemAnnouncement(string $subject, string $content, array $options = []): ?Message
    {
        if (!$this->canSendAnnouncements()) {
            return null;
        }

        return Message::create([
            'sender_id' => $this->id,
            'subject' => $subject,
            'content' => $content,
            'message_type' => 'announcement',
            'priority' => $options['priority'] ?? 'normal',
            'metadata' => $options['metadata'] ?? null,
        ]);
    }

    /**
     * Get unread message count
     */
    public function getUnreadMessageCount(): int
    {
        return Message::unreadCountForUser($this);
    }

    /**
     * Get recent messages (received)
     */
    public function getRecentMessages(int $limit = 10)
    {
        return Message::where('recipient_id', $this->id)
            ->orWhereHas('recipients', function ($q) {
                $q->where('users.id', $this->id);
            })
            ->orderByDesc('sent_at')
            ->limit($limit)
            ->get();
    }
}
