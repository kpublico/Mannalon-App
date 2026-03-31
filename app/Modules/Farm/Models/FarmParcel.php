<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmParcel extends Model
{
    use HasFactory;

    protected $table = 'farm_parcels';

    protected $fillable = [
        'farm_record_id',
        'parcel_name',
        'parcel_size_hectares',
        'soil_type',
        'terrain_type',
        'latitude',
        'longitude',
        'status',
    ];

    protected $casts = [
        'parcel_size_hectares' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function farmRecord()
    {
        return $this->belongsTo(FarmRecord::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
