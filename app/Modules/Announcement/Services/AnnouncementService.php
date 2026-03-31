<?php

namespace App\Modules\Announcement\Services;

use App\Modules\Announcement\Models\Announcement;
use Exception;

class AnnouncementService
{
    /**
     * Create an announcement
     */
    public function createAnnouncement(array $data): Announcement
    {
        try {
            return Announcement::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'category' => $data['category'] ?? 'General',
                'audience_scope' => $data['audience_scope'] ?? 'all',
                'is_published' => $data['is_published'] ?? false,
                'starts_at' => $data['starts_at'] ?? now(),
                'ends_at' => $data['ends_at'] ?? null,
                'expiry_date' => $data['expiry_date'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception('Announcement creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Publish an announcement
     */
    public function publishAnnouncement(Announcement $announcement): bool
    {
        try {
            return $announcement->update(['is_published' => true]);
        } catch (Exception $e) {
            throw new Exception('Announcement publish failed: ' . $e->getMessage());
        }
    }

    /**
     * Get active announcements
     */
    public function getActiveAnnouncements(int $limit = 20)
    {
        return Announcement::where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('expiry_date')
                    ->orWhereDate('expiry_date', '>=', now()->toDateString());
            })
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Get announcements by category
     */
    public function getByCategory(string $category, int $limit = 20)
    {
        return Announcement::where('category', $category)
            ->where('is_published', true)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }
}
