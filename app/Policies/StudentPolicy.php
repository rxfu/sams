<?php

namespace App\Policies;

class StudentPolicy extends ModelPolicy
{
    /**
     * Determine whether the student can sync.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function sync(User $user)
    {
        return $this->service->hasPermission($user, 'sync');
    }
}
