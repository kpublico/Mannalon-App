<?php

namespace App\Modules\Messaging\Services;

use App\Modules\Messaging\Models\Message;
use App\Modules\Messaging\Models\ConversationThread;
use App\Modules\Auth\Models\User;
use Exception;

class MessagingService
{
    /**
     * Send a message
     */
    public function sendMessage(User $sender, array $data): Message
    {
        try {
            return Message::create([
                'sender_id' => $sender->id,
                'recipient_id' => $data['recipient_id'] ?? null,
                'subject' => $data['subject'],
                'content' => $data['content'],
                'message_type' => $data['message_type'] ?? 'direct',
                'priority' => $data['priority'] ?? 'normal',
            ]);
        } catch (Exception $e) {
            throw new Exception('Message send failed: ' . $e->getMessage());
        }
    }

    /**
     * Create a conversation thread
     */
    public function createThread(User $initiator, array $data): ConversationThread
    {
        try {
            return ConversationThread::create([
                'initiator_id' => $initiator->id,
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception('Thread creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Get unread message count
     */
    public function getUnreadCount(User $user): int
    {
        return Message::where('recipient_id', $user->id)
            ->whereNull('read_at')
            ->count();
    }

    /**
     * Mark message as read
     */
    public function markAsRead(Message $message): bool
    {
        return $message->update(['read_at' => now()]);
    }
}
