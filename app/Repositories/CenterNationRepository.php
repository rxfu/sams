<?php

namespace App\Repositories;

use App\Models\CenterNation;

class CenterNationRepository extends Repository
{
    public function __construct(CenterNation $centerNation)
    {
        $this->model = $centerNation;
    }
}
