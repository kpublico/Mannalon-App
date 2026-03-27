<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'message_id',
        'notification_channel',
        'notified_at',
        'is_dismissed',
        'dismissed_at',
    ];

    protected $casts = [
        'is_dismissed' => 'boolean',
        'notified_at' => 'datetime',
        'dismissed_at' => 'datetime',
    ];

    /**
     * Get the user that received this notification
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the message associated with this notification
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }

    /**
     * Mark notification as dismissed
     */
    public function dismiss(): void
    {
        $this->update([
            'is_dismissed' => true,
            'dismissed_at' => now(),
        ]);
    }

    /**
     * Get unread notifications for a user
     */
    public static function unreadForUser(User $user)
    {
        return self::where('user_id', $user->id)
            ->where('is_dismissed', false)
            ->with('message.sender')
            ->orderByDesc('notified_at')
            ->get();
    }
}
