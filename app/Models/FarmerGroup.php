<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_user_id',
        'group_name',
        'region',
        'province',
        'municipality',
        'barangay',
        'description',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    public function farmerProfiles()
    {
        return $this->hasMany(FarmerProfile::class, 'farmer_group_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'target_group_id');
    }
}
