<?php

namespace App\Policies;

use App\Models\User;

class IdtypePolicy extends ModelPolicy
{
    /**
     * Determine whether the idtype can sync.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function sync(User $user)
    {
        return $this->service->hasPermission($user, 'sync');
    }
}
