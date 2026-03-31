<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerAddress extends Model
{
    use HasFactory;

    protected $table = 'farmer_addresses';

    protected $fillable = [
        'farmer_profile_id',
        'address_type',
        'region',
        'province',
        'municipality_city',
        'barangay',
        'sitio_purok',
        'detailed_address',
        'gps_latitude',
        'gps_longitude',
    ];

    protected $casts = [
        'gps_latitude' => 'float',
        'gps_longitude' => 'float',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function getFullAddress(): string
    {
        $parts = array_filter([
            $this->detailed_address,
            $this->sitio_purok,
            $this->barangay,
            $this->municipality_city,
            $this->province,
            $this->region,
        ]);

        return implode(', ', $parts);
    }
}
