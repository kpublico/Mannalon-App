<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerProfile extends Model
{
    use HasFactory;

    protected $table = 'farmer_profiles';

    protected $fillable = [
        'user_id',
        'farmer_group_id',
        'full_name',
        'gender',
        'date_of_birth',
        'age',
        'civil_status',
        'contact_number',
        'government_id_type',
        'government_id_number',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function farmerGroup()
    {
        return $this->belongsTo(FarmerGroup::class, 'farmer_group_id');
    }

    public function addresses()
    {
        return $this->hasMany(FarmerAddress::class);
    }

    public function farmingProfile()
    {
        return $this->hasOne(FarmingProfile::class);
    }

    public function farmRecords()
    {
        return $this->hasMany(FarmRecord::class);
    }

    public function financialRecords()
    {
        return $this->hasMany(FarmerFinancialRecord::class);
    }

    public function creditRecords()
    {
        return $this->hasMany(FarmerCreditRecord::class);
    }

    public function insuranceRecords()
    {
        return $this->hasMany(FarmerInsuranceRecord::class);
    }

    public function governmentPrograms()
    {
        return $this->hasOne(GovernmentProgramParticipation::class);
    }

    public function documents()
    {
        return $this->hasMany(FarmerDocument::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(FarmerAuditLog::class);
    }

    // Helper Methods
    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function getPrimaryAddress()
    {
        return $this->addresses()->where('address_type', 'home')->first();
    }

    public function getPrimaryFarm()
    {
        return $this->farmRecords()->first();
    }

    public function isActive(): bool
    {
        return $this->user && $this->user->status === 'active';
    }
}
