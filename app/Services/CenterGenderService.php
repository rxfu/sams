<?php

namespace App\Services;

use App\Repositories\CenterGenderRepository;

class CenterGenderService extends Service
{
    public function __construct(CenterGenderRepository $centerGenders)
    {
        $this->repository = $centerGenders;
    }
}
