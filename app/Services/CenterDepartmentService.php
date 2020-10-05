<?php

namespace App\Services;

use App\Repositories\CenterDepartmentRepository;

class CenterDepartmentService extends Service
{
    public function __construct(CenterDepartmentRepository $centerDepartments)
    {
        $this->repository = $centerDepartments;
    }
}
