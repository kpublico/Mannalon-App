<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    /**
     * Determine whether the user can view a message
     */
    public function view(User $user, Message $message): bool
    {
        // User can view if they sent it or received it
        return $user->id === $message->sender_id ||
               $user->id === $message->recipient_id ||
               $message->recipients->contains($user->id);
    }

    /**
     * Determine whether the user can update a message
     */
    public function update(User $user, Message $message): bool
    {
        // Only sender can update (only if not sent yet - soft validation)
        return $user->id === $message->sender_id;
    }

    /**
     * Determine whether the user can delete a message
     */
    public function delete(User $user, Message $message): bool
    {
        // Sender can delete, or recipient can delete from their inbox
        return $user->id === $message->sender_id ||
               $user->id === $message->recipient_id ||
               $message->recipients->contains($user->id);
    }
}
