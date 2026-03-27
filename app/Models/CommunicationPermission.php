<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_role',
        'recipient_role',
        'is_enabled',
        'communication_method',
        'description',
        'conditions',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'conditions' => 'json',
    ];

    /**
     * Check if a specific role pair can communicate using a method
     */
    public static function isAllowed(string $senderRole, string $recipientRole, string $method = 'direct'): bool
    {
        return self::where('sender_role', $senderRole)
            ->where('recipient_role', $recipientRole)
            ->where('communication_method', $method)
            ->where('is_enabled', true)
            ->exists();
    }

    /**
     * Get all available communication methods for a role pair
     */
    public static function getMethods(string $senderRole, string $recipientRole): array
    {
        return self::where('sender_role', $senderRole)
            ->where('recipient_role', $recipientRole)
            ->where('is_enabled', true)
            ->pluck('communication_method')
            ->toArray();
    }
}
