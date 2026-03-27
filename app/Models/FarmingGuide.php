<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmingGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'crop_type',
        'steps',
        'season',
        'resource_url',
        'pdf_file',
        'posted_by',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
