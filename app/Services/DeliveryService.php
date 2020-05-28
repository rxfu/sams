<?php

namespace App\Services;

use App\Repositories\DeliveryRepository;

class DeliveryService extends Service
{
    public function __construct(DeliveryRepository $deliveries)
    {
        $this->repository = $deliveries;
    }
}
