<?php

namespace App\Repositories;

use App\Models\Delivery;

class DeliveryRepository extends Repository
{
    public function __construct(Delivery $delivery)
    {
        $this->model = $delivery;
    }
}
