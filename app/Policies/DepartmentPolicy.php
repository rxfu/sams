<?php

namespace App\Policies;

class DepartmentPolicy extends ModelPolicy
{
    /**
     * Determine whether the department can sync.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function sync(User $user)
    {
        return $this->service->hasPermission($user, 'sync');
    }
}
