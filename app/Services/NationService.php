<?php

namespace App\Services;

use App\Repositories\NationRepository;

class NationService extends Service
{
    public function __construct(NationRepository $nations)
    {
        $this->repository = $nations;
    }
}
