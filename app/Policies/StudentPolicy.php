<?php

namespace App\Policies;

use App\Models\User;

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

    /**
     * Determine whether the user can search archives.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function search(User $user)
    {
        return $this->service->hasPermission($user, 'student-search');
    }
}
