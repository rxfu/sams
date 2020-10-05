<?php

namespace App\Services;

use App\Repositories\CenterIdtypeRepository;

class CenterIdtypeService extends Service
{
    public function __construct(CenterIdtypeRepository $centerIdtypes)
    {
        $this->repository = $centerIdtypes;
    }
}
