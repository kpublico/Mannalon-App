<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmWaterResource extends Model
{
    use HasFactory;

    protected $table = 'farm_water_resources';

    protected $fillable = [
        'farm_record_id',
        'irrigation_type',
        'water_source',
        'water_quality_rating',
        'annual_water_cost',
        'water_availability',
        'notes',
    ];

    protected $casts = [
        'annual_water_cost' => 'float',
    ];

    public function farmRecord()
    {
        return $this->belongsTo(FarmRecord::class);
    }

    public function isIrrigated(): bool
    {
        return in_array($this->irrigation_type, ['irrigated', 'mixed']);
    }
}
