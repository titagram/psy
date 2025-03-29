<?php

namespace App\Policies;

use App\Models\User;

class ScheduledSessionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, ScheduledSession $scheduledSession)
    {
        return $user->id === $scheduledSession->therapist_id;
    }

}
