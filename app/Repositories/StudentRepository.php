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

    public function searchBy($sid, $name, $level, $department, $major, $grade)
    {
        try {
            $query = $this->model->with('archive');

            if (!empty($sid)) {
                $query = $query->where('xh', 'like', '%' . $sid . '%');
            }

            if (!empty($name)) {
                $query = $query->where('xm', 'like', '%' . $name . '%');
            }

            if ('all' !== $level) {
                $query = $query->where('sjly', '=', $level);
            }

            if ('all' !== $department) {
                $query = $query->where('dwh', '=', $department);
            }

            if ('all' !== $major) {
                $query = $query->where('zydm', '=', $major);
            }

            if ('all' !== $grade) {
                $query = $query->where('dqszj', '=', $grade);
            }

            return $query->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}
