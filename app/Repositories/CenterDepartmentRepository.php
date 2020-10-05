<?php

namespace App\Repositories;

use App\Models\CenterDepartment;

class CenterDepartmentRepository extends Repository
{
    public function __construct(CenterDepartment $centerDepartment)
    {
        $this->model = $centerDepartment;
    }
}
