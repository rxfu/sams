<?php

namespace App\Policies;

class EntryPolicy extends ModelPolicy
{
    /**
     * Determine whether the entry can assign group.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function group(User $user)
    {
        return $this->service->hasPermission($user, 'group-assign');
    }
}
