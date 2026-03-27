<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'service_type',
        'program_name',
        'aid_amount',
        'ayuda_status',
        'distributed_at',
        'notes',
    ];

    protected $casts = [
        'distributed_at' => 'datetime',
        'aid_amount' => 'decimal:2',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
