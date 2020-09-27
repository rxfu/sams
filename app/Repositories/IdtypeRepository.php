<?php

namespace App\Repositories;

use App\Models\Idtype;

class IdtypeRepository extends Repository
{
    public function __construct(Idtype $idtype)
    {
        $this->model = $idtype;
    }
}
