<?php

namespace App\Repositories;

use App\Models\CenterIdtype;

class CenterIdtypeRepository extends Repository
{
    public function __construct(CenterIdtype $centerIdtype)
    {
        $this->model = $centerIdtype;
    }
}
