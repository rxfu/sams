<?php

namespace App\Repositories;

use App\Models\CenterStudent;

class CenterStudentRepository extends Repository
{
    public function __construct(CenterStudent $centerStudent)
    {
        $this->model = $centerStudent;
    }
}
