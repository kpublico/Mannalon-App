<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'subject',
        'content',
        'message_type',
        'priority',
        'recipient_type',
        'target_group_id',
        'department_id',
        'is_read',
        'read_at',
        'is_archived',
        'attachment_path',
        'metadata',
        'sent_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_archived' => 'boolean',
        'metadata' => 'json',
        'sent_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    /**
     * Get the sender of the message
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the recipient of the message (for direct messages)
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * Get the target group for broadcast messages
     */
    public function targetGroup(): BelongsTo
    {
        return $this->belongsTo(FarmerGroup::class, 'target_group_id');
    }

    /**
     * Get all recipients of this message
     */
    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'message_recipients', 'message_id', 'recipient_id')
            ->withPivot('is_read', 'read_at', 'is_deleted', 'recipient_role')
            ->withTimestamps();
    }

    /**
     * Get all notifications for this message
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the conversation thread if this message belongs to one
     */
    public function thread(): BelongsTo
    {
        return $this->belongsTo(ConversationThread::class);
    }

    /**
     * Mark message as read
     */
    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }

    /**
     * Archive the message
     */
    public function archive(): void
    {
        $this->update(['is_archived' => true]);
    }

    /**
     * Check if sender has permission to send to recipient
     */
    public static function canSend(User $sender, User|string|null $recipient, string $messageType = 'direct'): bool
    {
        $recipientRole = $recipient instanceof User ? $recipient->role->name : $recipient;
        $senderRole = $sender->role->name;

        $permission = CommunicationPermission::where('sender_role', $senderRole)
            ->where('recipient_role', $recipientRole)
            ->where('communication_method', $messageType)
            ->where('is_enabled', true)
            ->first();

        return $permission !== null;
    }

    /**
     * Create and send a message
     */
    public static function sendMessage(
        User $sender,
        string $subject,
        string $content,
        User|string|null $recipient = null,
        array $options = []
    ): ?Message {
        $messageType = $options['message_type'] ?? 'direct';
        $recipientRole = $recipient instanceof User ? null : $recipient;

        // Check permissions
        if (!self::canSend($sender, $recipient, $messageType)) {
            return null;
        }

        $message = self::create([
            'sender_id' => $sender->id,
            'recipient_id' => $recipient instanceof User ? $recipient->id : null,
            'subject' => $subject,
            'content' => $content,
            'message_type' => $messageType,
            'priority' => $options['priority'] ?? 'normal',
            'recipient_type' => $recipientRole,
            'target_group_id' => $options['target_group_id'] ?? null,
            'attachment_path' => $options['attachment_path'] ?? null,
            'metadata' => $options['metadata'] ?? null,
        ]);

        // If broadcast, create recipients
        if ($messageType === 'broadcast' && isset($options['target_group_id'])) {
            self::createBroadcastRecipients($message, $options['target_group_id']);
        }

        return $message;
    }

    /**
     * Create recipient entries for broadcast messages
     */
    private static function createBroadcastRecipients(Message $message, int $groupId): void
    {
        $group = FarmerGroup::findOrFail($groupId);
        $farmers = $group->farmers()->pluck('users.id');

        foreach ($farmers as $farmerId) {
            MessageRecipient::firstOrCreate([
                'message_id' => $message->id,
                'recipient_id' => $farmerId,
            ]);
        }
    }

    /**
     * Get unread count for a user
     */
    public static function unreadCountForUser(User $user): int
    {
        return self::where(function ($query) use ($user) {
            $query->where('recipient_id', $user->id)
                ->orWhereHas('recipients', function ($q) use ($user) {
                    $q->where('users.id', $user->id);
                });
        })
            ->where('is_read', false)
            ->count();
    }
}
