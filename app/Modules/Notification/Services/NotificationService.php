<?php

namespace App\Modules\Notification\Services;

use App\Modules\Notification\Models\Notification;
use App\Modules\Auth\Models\User;
use Exception;

class NotificationService
{
    /**
     * Create a notification
     */
    public function createNotification(User $user, array $data): Notification
    {
        try {
            return Notification::create([
                'user_id' => $user->id,
                'type' => $data['type'] ?? 'info',
                'title' => $data['title'],
                'message' => $data['message'],
                'action_url' => $data['action_url'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception('Notification creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Get unread notifications
     */
    public function getUnreadNotifications(User $user, int $limit = 20)
    {
        return Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(Notification $notification): bool
    {
        return $notification->update(['read_at' => now()]);
    }

    /**
     * Mark all as read
     */
    public function markAllAsRead(User $user): bool
    {
        return Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    /**
     * Get notification count
     */
    public function getUnreadCount(User $user): int
    {
        return Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->count();
    }
}
