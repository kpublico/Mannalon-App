<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerDocument extends Model
{
    use HasFactory;

    protected $table = 'farmer_documents';

    protected $fillable = [
        'farmer_profile_id',
        'document_type',
        'document_name',
        'file_path',
        'file_mime_type',
        'file_size',
        'document_issue_date',
        'document_expiry_date',
        'verification_status',
        'verified_by',
        'notes',
    ];

    protected $casts = [
        'document_issue_date' => 'date',
        'document_expiry_date' => 'date',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }

    public function isExpired(): bool
    {
        return $this->document_expiry_date && $this->document_expiry_date < now()->toDateString();
    }

    public function getFileSize(): string
    {
        $size = $this->file_size ?? 0;
        $units = ['B', 'KB', 'MB', 'GB'];
        foreach ($units as $unit) {
            if ($size < 1024) {
                return round($size, 2) . ' ' . $unit;
            }
            $size = $size / 1024;
        }

        return round($size, 2) . ' TB';
    }
}
