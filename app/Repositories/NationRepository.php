<?php

namespace App\Repositories;

use App\Models\Nation;

class NationRepository extends Repository
{
    public function __construct(Nation $nation)
    {
        $this->model = $nation;
    }
}
