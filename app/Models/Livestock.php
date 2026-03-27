<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;

    protected $table = 'livestock';

    protected $fillable = [
        'user_id',
        'type',
        'count',
        'health_status',
        'last_checkup',
        'notes',
    ];

    protected $casts = [
        'last_checkup' => 'datetime',
    ];

    /**
     * Get the user that owns the livestock
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
