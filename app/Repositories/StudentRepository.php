<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
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
            if (!Auth::user()->is_super) {
                return $this->model->whereIn('major_id', Auth::user()->majors->pluck('id')->toArray())
                    ->whereDoesntHave('archive')->get();
            }

            return $this->model->whereDoesntHave('archive')->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function allGrades()
    {
        try {
            return $this->model->distinct()
                ->select('grade')
                ->orderBy('grade')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function allLevels()
    {
        try {
            return $this->model->distinct()
                ->select('level')
                ->orderBy('level')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}
