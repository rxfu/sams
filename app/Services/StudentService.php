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

    public function getAllGrades()
    {
        return $this->repository->allGrades();
    }

    public function getAllLevels()
    {
        return $this->repository->allLevels();
    }
}
