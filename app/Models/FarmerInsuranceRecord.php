<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerInsuranceRecord extends Model
{
    use HasFactory;

    protected $table = 'farmer_insurance_records';

    protected $fillable = [
        'farmer_profile_id',
        'insurance_type',
        'insurance_provider',
        'policy_number',
        'policy_start_date',
        'policy_end_date',
        'premium_amount',
        'coverage_amount',
        'status',
        'coverage_details',
    ];

    protected $casts = [
        'policy_start_date' => 'date',
        'policy_end_date' => 'date',
        'premium_amount' => 'float',
        'coverage_amount' => 'float',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->policy_end_date >= now()->toDateString();
    }

    public function isPolicyExpired(): bool
    {
        return $this->policy_end_date < now()->toDateString();
    }
}
