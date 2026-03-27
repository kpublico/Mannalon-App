<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmingProfile extends Model
{
    use HasFactory;

    protected $table = 'farming_profiles';

    protected $fillable = [
        'farmer_profile_id',
        'farmer_type',
        'years_in_farming',
        'primary_occupation',
        'secondary_occupation',
        'farmers_association',
        'association_membership_status',
        'association_joined_date',
    ];

    protected $casts = [
        'association_joined_date' => 'date',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function isMemberOfAssociation(): bool
    {
        return $this->association_membership_status === 'member';
    }
}
