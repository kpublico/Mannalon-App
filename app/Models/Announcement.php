<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'content',
        'audience_scope',
        'target_group_id',
        'is_published',
        'starts_at',
        'ends_at',
        'expiry_date',
        'posted_by',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function targetGroup()
    {
        return $this->belongsTo(FarmerGroup::class, 'target_group_id');
    }
}
