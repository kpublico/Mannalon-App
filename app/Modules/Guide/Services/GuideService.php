<?php

namespace App\Modules\Guide\Services;

use App\Modules\Guide\Models\FarmingGuide;
use Exception;

class GuideService
{
    /**
     * Create a new farming guide
     */
    public function createGuide(array $data): FarmingGuide
    {
        try {
            return FarmingGuide::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'crop_type' => $data['crop_type'] ?? null,
                'category' => $data['category'] ?? 'General',
                'steps' => $data['steps'] ?? null,
                'video_url' => $data['video_url'] ?? null,
                'pdf_url' => $data['pdf_url'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception('Guide creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Get guides by crop type
     */
    public function getGuidesByCategory(string $category, int $limit = 10)
    {
        return FarmingGuide::where('crop_type', $category)
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    /**
     * Search guides
     */
    public function searchGuides(string $query, int $limit = 20)
    {
        return FarmingGuide::where(function ($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
                ->orWhere('content', 'like', '%' . $query . '%')
                ->orWhere('steps', 'like', '%' . $query . '%');
        })
        ->limit($limit)
        ->get();
    }
}
