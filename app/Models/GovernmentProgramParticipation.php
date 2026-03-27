<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentProgramParticipation extends Model
{
    use HasFactory;

    protected $table = 'government_program_participation';

    protected $fillable = [
        'farmer_profile_id',
        'rsbsa_number',
        'rsbsa_registration_date',
        'rsbsa_status',
    ];

    protected $casts = [
        'rsbsa_registration_date' => 'date',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function benefitsAvailed()
    {
        return $this->hasMany(ProgramBenefitAvailed::class, 'government_program_id');
    }

    public function isRegisteredInRSBSA(): bool
    {
        return $this->rsbsa_status === 'registered';
    }

    public function getTotalBenefitsReceived()
    {
        return $this->benefitsAvailed()
            ->where('status', 'received')
            ->sum('benefit_value');
    }
}
