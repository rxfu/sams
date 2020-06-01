<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\DeliveryRepository;

class DeliveryService extends Service
{
    public function __construct(DeliveryRepository $deliveries)
    {
        $this->repository = $deliveries;
    }

    public function store($data)
    {
        $data['creator_id'] = Auth::id();
        $data['editor_id'] = Auth::id();
        $data['version'] = $this->repository->maxVersion($data['archive_id']) + 1;

        return $this->repository->save($data);
    }
}
