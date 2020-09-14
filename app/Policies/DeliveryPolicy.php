<?php

namespace App\Policies;

use App\Models\User;

class DeliveryPolicy extends ModelPolicy
{
    /**
     * Determine whether the user can import deliveries.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function import(User $user)
    {
        return $this->service->hasPermission($user, 'delivery-import');
    }

    /**
     * Determine whether the user can search deliveries.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function search(User $user)
    {
        return $this->service->hasPermission($user, 'delivery-search');
    }

    /**
     * Determine whether the user can download deliveries.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function download(User $user)
    {
        return $this->service->hasPermission($user, 'delivery-download');
    }

    /**
     * Determine whether the user can export deliveries ems.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function ems(User $user)
    {
        return $this->service->hasPermission($user, 'delivery-ems');
    }

    /**
     * Determine whether the user can export deliveries notice.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function notice(User $user)
    {
        return $this->service->hasPermission($user, 'delivery-notice');
    }
}
