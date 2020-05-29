<?php

namespace App\Services;

use App\Repositories\StudentRepository;

class StudentService extends Service
{
    public function __construct(StudentRepository $students)
    {
        $this->repository = $students;
    }

    public function getAllByNoArchive()
    {
        return $this->repository->doesntHaveArchive();
    }
}
