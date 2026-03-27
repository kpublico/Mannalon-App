<?php

namespace App\Policies;

use App\Models\ConversationThread;
use App\Models\User;

class ConversationThreadPolicy
{
    /**
     * Determine whether the user can view the thread
     */
    public function view(User $user, ConversationThread $thread): bool
    {
        // User can view if they're a participant or the initiator
        return $user->id === $thread->initiator_id ||
               $thread->participants()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can update the thread
     */
    public function update(User $user, ConversationThread $thread): bool
    {
        // Only initiator can update thread details
        return $user->id === $thread->initiator_id;
    }

    /**
     * Determine whether the user can delete the thread
     */
    public function delete(User $user, ConversationThread $thread): bool
    {
        // Only initiator can delete
        return $user->id === $thread->initiator_id;
    }

    /**
     * Determine whether the user can reply to the thread
     */
    public function reply(User $user, ConversationThread $thread): bool
    {
        // Any participant can reply (if thread is open)
        return !$thread->is_closed && $thread->participants()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can add participants
     */
    public function addParticipant(User $user, ConversationThread $thread): bool
    {
        // Only initiator can add participants
        return $user->id === $thread->initiator_id;
    }
}
