<?php

namespace App\Repositories;

use App\Models\CenterGender;

class CenterGenderRepository extends Repository
{
    public function __construct(CenterGender $centerGender)
    {
        $this->model = $centerGender;
    }
}
