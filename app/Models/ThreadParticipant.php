<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThreadParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'thread_id',
        'user_id',
        'is_muted',
        'muted_until',
        'participant_role',
    ];

    protected $casts = [
        'is_muted' => 'boolean',
        'muted_until' => 'datetime',
    ];

    /**
     * Get the thread
     */
    public function thread(): BelongsTo
    {
        return $this->belongsTo(ConversationThread::class);
    }

    /**
     * Get the user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mute notifications
     */
    public function mute($duration = null): void
    {
        $this->update([
            'is_muted' => true,
            'muted_until' => $duration ? now()->add($duration) : null,
        ]);
    }

    /**
     * Unmute notifications
     */
    public function unmute(): void
    {
        $this->update([
            'is_muted' => false,
            'muted_until' => null,
        ]);
    }
}
