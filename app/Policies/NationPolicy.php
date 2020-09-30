<?php

namespace App\Policies;

class NationPolicy extends ModelPolicy
{
    /**
     * Determine whether the nation can sync.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function sync(User $user)
    {
        return $this->service->hasPermission($user, 'sync');
    }
}
