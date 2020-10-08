<?php

namespace App\Policies;

use App\Models\User;

class ArchivePolicy extends ModelPolicy
{
    /**
     * Determine whether the user can import archives.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function import(User $user)
    {
        return $this->service->hasPermission($user, 'archive-import');
    }

    /**
     * Determine whether the user can export archives.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function export(User $user)
    {
        return $this->service->hasPermission($user, 'archive-export');
    }

    /**
     * Determine whether the user can search archives.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function search(User $user)
    {
        return $this->service->hasPermission($user, 'archive-search');
    }
}
