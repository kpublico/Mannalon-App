<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\RoleMessagingTrait;

class User extends Authenticatable
{
    use HasFactory, Notifiable, RoleMessagingTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'state',
        'role',
        'status',
        'sex',
        'gender',
        'house_number',
        'zone_purok',
        'barangay',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted(): void
    {
        static::saving(function (User $user): void {
            if (!$user->role_id && $user->role) {
                $roleCode = strtoupper($user->role);
                $user->role_id = Role::where('code', $roleCode)->value('id');
            }
        });
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'super_admin'], true);
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if user is farmer
     */
    public function isFarmer(): bool
    {
        return $this->role === 'farmer';
    }

    /**
     * Get user's crops
     */
    public function crops()
    {
        return $this->hasMany(Crop::class);
    }

    /**
     * Get user's livestock
     */
    public function livestock()
    {
        return $this->hasMany(Livestock::class);
    }

    /**
     * Get associated farmer profile record (legacy).
     */
    public function farmerProfile()
    {
        return $this->hasOne(Farmer::class);
    }

    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function supervisedAdmins()
    {
        return $this->hasMany(AdminSupervisorAssignment::class, 'super_admin_user_id');
    }

    public function supervisingSuperAdmins()
    {
        return $this->hasMany(AdminSupervisorAssignment::class, 'admin_user_id');
    }

    public function farmerGroups()
    {
        return $this->hasMany(FarmerGroup::class, 'admin_user_id');
    }

    /**
     * Get the farmer profile (new version).
     */
    public function farmerProfileV2()
    {
        return $this->hasOne(FarmerProfile::class, 'user_id');
    }

    public function createdCropReports()
    {
        return $this->hasMany(CropReport::class, 'reported_by_user_id');
    }

    public function reviewedCropReports()
    {
        return $this->hasMany(CropReport::class, 'reviewed_by_admin_user_id');
    }

    /**
     * Get messages sent by the user
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get messages received by the user (direct messages)
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Get all messages for the user (sent and received)
     */
    public function messages()
    {
        return $this->sentMessages()->union($this->receivedMessages());
    }

    /**
     * Get user's notifications
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get conversation threads initiated by user
     */
    public function initiatedThreads()
    {
        return $this->hasMany(ConversationThread::class, 'initiator_id');
    }

    /**
     * Get all conversation threads user is part of
     */
    public function conversationThreads()
    {
        return $this->belongsToMany(ConversationThread::class, 'thread_participants')
            ->withPivot('is_muted', 'muted_until', 'participant_role')
            ->withTimestamps();
    }

    /**
     * Get role relationship
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
