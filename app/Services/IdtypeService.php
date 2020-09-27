<?php

namespace App\Services;

use App\Repositories\IdtypeRepository;

class IdtypeService extends Service
{
    public function __construct(IdtypeRepository $idtypes)
    {
        $this->repository = $idtypes;
    }
}
