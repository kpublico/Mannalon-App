<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAccessLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'service_name',
        'access_count',
        'last_accessed_at',
    ];

    protected $casts = [
        'last_accessed_at' => 'datetime',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
