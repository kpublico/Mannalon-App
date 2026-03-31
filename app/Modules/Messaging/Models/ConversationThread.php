<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ConversationThread extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'initiator_id',
        'title',
        'description',
        'last_message_id',
        'is_closed',
        'closed_at',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'closed_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];

    /**
     * Get the user who initiated the thread
     */
    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }

    /**
     * Get all messages in this thread
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'thread_id')->orderBy('created_at');
    }

    /**
     * Get all participants in this thread
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'thread_participants', 'thread_id', 'user_id')
            ->withPivot('is_muted', 'muted_until', 'participant_role')
            ->withTimestamps();
    }

    /**
     * Get the last message in the thread
     */
    public function lastMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }

    /**
     * Add a participant to the thread
     */
    public function addParticipant(User $user, string $role = null): void
    {
        $this->participants()->attach($user->id, [
            'participant_role' => $role ?? $user->role->name,
        ]);
    }

    /**
     * Remove a participant from the thread
     */
    public function removeParticipant(User $user): void
    {
        $this->participants()->detach($user->id);
    }

    /**
     * Close the thread
     */
    public function close(): void
    {
        $this->update([
            'is_closed' => true,
            'closed_at' => now(),
        ]);
    }

    /**
     * Check if a user is a participant
     */
    public function isParticipant(User $user): bool
    {
        return $this->participants()->where('user_id', $user->id)->exists();
    }

    /**
     * Update last activity timestamp
     */
    public function updateLastActivity(): void
    {
        $this->update(['last_activity_at' => now()]);
    }
}
