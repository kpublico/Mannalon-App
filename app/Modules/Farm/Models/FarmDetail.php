<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'latitude',
        'longitude',
        'farm_size',
        'land_type',
        'notes',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
