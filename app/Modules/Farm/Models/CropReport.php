<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_profile_id',
        'reported_by_user_id',
        'reviewed_by_admin_user_id',
        'crop_name',
        'season',
        'area_hectares',
        'planting_date',
        'expected_harvest_date',
        'actual_harvest_date',
        'estimated_yield_kg',
        'actual_yield_kg',
        'status',
        'remarks',
        'submitted_at',
        'reviewed_at',
    ];

    protected $casts = [
        'area_hectares' => 'decimal:2',
        'estimated_yield_kg' => 'decimal:2',
        'actual_yield_kg' => 'decimal:2',
        'planting_date' => 'date',
        'expected_harvest_date' => 'date',
        'actual_harvest_date' => 'date',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class, 'farmer_profile_id');
    }

    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by_user_id');
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by_admin_user_id');
    }
}
