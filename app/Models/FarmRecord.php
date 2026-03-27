<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmRecord extends Model
{
    use HasFactory;

    protected $table = 'farm_records';

    protected $fillable = [
        'farmer_profile_id',
        'farm_name',
        'farm_size_hectares',
        'land_ownership_type',
        'number_of_parcels',
        'farm_description',
        'ownership_date',
    ];

    protected $casts = [
        'farm_size_hectares' => 'float',
        'ownership_date' => 'date',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function parcels()
    {
        return $this->hasMany(FarmParcel::class, 'farm_record_id');
    }

    public function equipment()
    {
        return $this->hasMany(FarmEquipment::class);
    }

    public function waterResources()
    {
        return $this->hasOne(FarmWaterResource::class);
    }

    public function inputs()
    {
        return $this->hasMany(FarmInput::class);
    }

    public function crops()
    {
        return $this->hasMany(Crop::class, 'farm_id');
    }

    public function livestock()
    {
        return $this->hasMany(Livestock::class, 'farm_id');
    }

    public function getTotalActiveParcels()
    {
        return $this->parcels()->where('status', 'active')->count();
    }
}
