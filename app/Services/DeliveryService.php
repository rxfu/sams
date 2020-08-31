<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\StudentRepository;
use App\Repositories\DeliveryRepository;

class DeliveryService extends Service
{
    protected $studentRepository;

    public function __construct(DeliveryRepository $deliveries, StudentRepository $studentRepository)
    {
        $this->repository = $deliveries;
        $this->studentRepository = $studentRepository;
    }

    public function store($data)
    {
        $data['creator_id'] = Auth::id();
        $data['editor_id'] = Auth::id();
        $data['version'] = $this->repository->maxVersion($data['archive_id']) + 1;

        return $this->repository->save($data);
    }

    protected function getSearchQuery($attributes, $relations, $order, $direction, $trashed)
    {
        return $this->repository->queryBy($attributes, $relations, $order, $direction, $trashed);
    }
}
