<?php

namespace App\Repositories;

use App\Models\Student;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class StudentRepository extends Repository
{
    public function __construct(Student $student)
    {
        $this->model = $student;
    }

    public function doesntHaveArchive()
    {
        try {
            return $this->model->whereDoesntHave('archives')->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}
