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
}
