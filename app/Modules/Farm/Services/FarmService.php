<?php

namespace App\Modules\Farm\Services;

use App\Modules\Farm\Models\Crop;
use App\Modules\Farm\Models\Livestock;
use App\Modules\Farm\Models\FarmDetail;
use Exception;

class FarmService
{
    /**
     * Create a new crop
     */
    public function createCrop(array $data): Crop
    {
        try {
            return Crop::create([
                'name' => $data['name'],
                'area' => $data['area'] ?? 0,
                'planting_date' => $data['planting_date'] ?? now(),
                'expected_harvest_date' => $data['expected_harvest_date'] ?? null,
                'status' => $data['status'] ?? 'active',
                'description' => $data['description'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception('Crop creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Add livestock
     */
    public function addLivestock(array $data): Livestock
    {
        try {
            return Livestock::create([
                'type' => $data['type'],
                'count' => $data['count'] ?? 1,
                'health_status' => $data['health_status'] ?? 'healthy',
                'notes' => $data['notes'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception('Livestock creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Update farm details
     */
    public function updateFarmDetails(int $farmerId, array $data): FarmDetail
    {
        try {
            return FarmDetail::updateOrCreate(
                ['farmer_id' => $farmerId],
                [
                    'farm_size' => $data['farm_size'] ?? 0,
                    'latitude' => $data['latitude'] ?? null,
                    'longitude' => $data['longitude'] ?? null,
                    'land_type' => $data['land_type'] ?? null,
                    'notes' => $data['notes'] ?? null,
                ]
            );
        } catch (Exception $e) {
            throw new Exception('Farm details update failed: ' . $e->getMessage());
        }
    }

    /**
     * Get farm statistics
     */
    public function getFarmStatistics(int $farmerId): array
    {
        return [
            'total_crops' => Crop::where('farmer_id', $farmerId)->count(),
            'active_crops' => Crop::where('farmer_id', $farmerId)->where('status', 'active')->count(),
            'total_livestock' => Livestock::where('farmer_id', $farmerId)->count(),
            'farm_area' => FarmDetail::where('farmer_id', $farmerId)->sum('farm_size') ?? 0,
        ];
    }
}
