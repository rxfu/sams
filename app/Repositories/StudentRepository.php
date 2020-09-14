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
            return $this->model->whereDoesntHave('archive')->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function allGrades()
    {
        try {
            return $this->model->distinct()
                ->select('dqszj')
                ->orderBy('dqszj')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function allLevels()
    {
        return ['教务管理系统', '研究生系统'];
    }
}
