<?php

namespace App\Services;

use App\Repositories\CenterStudentRepository;

class CenterStudentService extends Service
{
    public function __construct(CenterStudentRepository $centerStudents)
    {
        $this->repository = $centerStudents;
    }
}
