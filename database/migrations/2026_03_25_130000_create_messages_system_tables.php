<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates tables for inter-role communication system in Mannalon App
     *
     * @return void
     */
    public function up(): void
    {
        // Messages table - Core messaging between roles
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('recipient_id')->nullable(); // Null for broadcast messages
            $table->string('subject');
            $table->longText('content');
            $table->enum('message_type', ['direct', 'broadcast', 'announcement', 'alert'])->default('direct');
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            
            // Targeting & Scope
            $table->string('recipient_type')->nullable(); // Specific role type (farmer, admin, coordinator)
            $table->unsignedBigInteger('target_group_id')->nullable(); // Target FarmerGroup for broadcasts
            $table->unsignedBigInteger('department_id')->nullable(); // Department-level messages
            
            // Status & Metadata
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_archived')->default(false);
            $table->string('attachment_path')->nullable();
            $table->json('metadata')->nullable(); // Store additional context (location, crop type, etc.)
            
            // Timestamps
            $table->timestamp('sent_at')->useCurrent();
            $table->softDeletes();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('target_group_id')->references('id')->on('farmer_groups')->onDelete('set null');
        });

        // Notifications table - Track which users have been notified
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('message_id');
            $table->enum('notification_channel', ['in_app', 'email', 'sms'])->default('in_app');
            $table->timestamp('notified_at')->useCurrent();
            $table->boolean('is_dismissed')->default(false);
            $table->timestamp('dismissed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
        });

        // Message Recipients - For messages sent to multiple users
        Schema::create('message_recipients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('recipient_id');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->string('recipient_role')->nullable(); // Track role at time of send
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
            
            // Unique constraint - prevent duplicates
            $table->unique(['message_id', 'recipient_id']);
        });

        // Communication Permissions - Define which roles can communicate with which roles
        Schema::create('communication_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('sender_role'); // Role that sends messages
            $table->string('recipient_role'); // Role that receives messages
            $table->boolean('is_enabled')->default(true);
            $table->string('communication_method'); // 'direct', 'group', 'broadcast', 'announcement'
            $table->text('description')->nullable(); // E.g., "Admins can send announcements to farmers"
            $table->json('conditions')->nullable(); // Additional conditions if needed
            $table->timestamps();
            
            // Unique constraint
            $table->unique(['sender_role', 'recipient_role', 'communication_method'], 'comm_permissions_unique');
        });

        // Conversation Threads - Group related messages
        Schema::create('conversation_threads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('initiator_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('last_message_id')->nullable();
            $table->timestamp('last_activity_at')->useCurrent()->useCurrentOnUpdate();
            $table->boolean('is_closed')->default(false);
            $table->timestamp('closed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('initiator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('last_message_id')->references('id')->on('messages')->onDelete('set null');
        });

        // Thread Participants - Track who's in each conversation
        Schema::create('thread_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thread_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_muted')->default(false);
            $table->timestamp('muted_until')->nullable();
            $table->string('participant_role')->nullable(); // Role at time of joining
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('thread_id')->references('id')->on('conversation_threads')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Unique constraint
            $table->unique(['thread_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_participants');
        Schema::dropIfExists('conversation_threads');
        Schema::dropIfExists('communication_permissions');
        Schema::dropIfExists('message_recipients');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('messages');
    }
};
