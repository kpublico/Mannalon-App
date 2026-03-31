<?php

namespace App\Modules\Farmer\Services;

use App\Modules\Farmer\Models\Farmer;
use App\Modules\Farmer\Models\FarmerProfile;
use Exception;

class FarmerService
{
    /**
     * Create a new farmer
     */
    public function createFarmer(array $data): Farmer
    {
        try {
            return Farmer::create([
                'name' => $data['name'] ?? null,
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'] ?? null,
                'farm_location' => $data['farm_location'] ?? null,
                'farmer_type' => $data['farmer_type'] ?? 'individual',
                'farm_size_hectares' => $data['farm_size_hectares'] ?? 0,
            ]);
        } catch (Exception $e) {
            throw new Exception('Farmer creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Update farmer information
     */
    public function updateFarmer(Farmer $farmer, array $data): Farmer
    {
        try {
            $farmer->update($data);
            return $farmer;
        } catch (Exception $e) {
            throw new Exception('Farmer update failed: ' . $e->getMessage());
        }
    }

    /**
     * Get farmer profile
     */
    public function getFarmerProfile(Farmer $farmer): ?FarmerProfile
    {
        return $farmer->profile;
    }

    /**
     * Search farmers
     */
    public function searchFarmers(string $query, int $limit = 20)
    {
        return Farmer::where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%');
        })
        ->limit($limit)
        ->get();
    }
}
