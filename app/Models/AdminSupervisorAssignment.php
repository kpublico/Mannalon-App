<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSupervisorAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'super_admin_user_id',
        'admin_user_id',
        'assigned_at',
        'ended_at',
        'is_active',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'ended_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function superAdmin()
    {
        return $this->belongsTo(User::class, 'super_admin_user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }
}
