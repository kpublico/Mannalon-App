<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerAuditLog extends Model
{
    use HasFactory;

    protected $table = 'farmer_audit_log';

    protected $fillable = [
        'farmer_profile_id',
        'admin_user_id',
        'action',
        'entity_type',
        'changes_made',
        'ip_address',
        'notes',
    ];

    protected $casts = [
        'changes_made' => 'array',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function adminUser()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    public static function logAction(FarmerProfile $farmer, string $action, ?int $adminUserId = null, ?string $entityType = null, ?array $changes = null, ?string $notes = null): self
    {
        return self::create([
            'farmer_profile_id' => $farmer->id,
            'admin_user_id' => $adminUserId,
            'action' => $action,
            'entity_type' => $entityType,
            'changes_made' => $changes,
            'ip_address' => request()->ip(),
            'notes' => $notes,
        ]);
    }
}
