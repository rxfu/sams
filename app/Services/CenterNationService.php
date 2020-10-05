<?php

namespace App\Services;

use App\Repositories\CenterNationRepository;

class CenterNationService extends Service
{
    public function __construct(CenterNationRepository $centerNations)
    {
        $this->repository = $centerNations;
    }
}
