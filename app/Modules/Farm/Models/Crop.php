<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'area',
        'planting_date',
        'expected_harvest_date',
        'status',
        'description',
    ];

    protected $casts = [
        'planting_date' => 'datetime',
        'expected_harvest_date' => 'datetime',
    ];

    /**
     * Get the user that owns the crop
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
