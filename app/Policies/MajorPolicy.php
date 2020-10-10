<?php

namespace App\Policies;

use App\Models\User;

class MajorPolicy extends ModelPolicy
{
    /**
     * Determine whether the major can sync.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function sync(User $user)
    {
        return $this->service->hasPermission($user, 'sync');
    }

    /**
     * Determine whether the user can search majors.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function search(User $user)
    {
        return $this->service->hasPermission($user, 'major-search');
    }
}
