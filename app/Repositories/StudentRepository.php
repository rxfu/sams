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

    public function doesntHaveArchive($keyword, $limit = 5)
    {
        try {
            $model = $this->model->whereDoesntHave('archive')
                ->join('departments', 'department_id', 'departments.id')
                ->join('majors', 'major_id', 'majors.id')
                ->where('students.id', 'like', '%' . $keyword . '%')
                ->orderBy('students.id')
                ->select('students.id AS id', 'students.name AS name', 'idnumber', 'departments.name AS department', 'majors.name AS major', 'grade')
                ->limit($limit);

            if (!Auth::user()->is_super) {
                $model = $model->whereIn('major_id', Auth::user()->majors->pluck('id')->toArray())
                    ->whereIn('grade', explode(',', Auth::user()->grade));
            }

            return $model->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function haveArchive($keyword, $limit = 5)
    {
        try {
            $model = $this->model->join('departments', 'department_id', 'departments.id')
                ->join('majors', 'major_id', 'majors.id')
                ->join('archives', 'students.id', 'archives.sid')
                ->where('students.id', 'like', '%' . $keyword . '%')
                ->orderBy('students.id')
                ->select('students.id AS id', 'students.name AS name', 'idnumber', 'departments.name AS department', 'majors.name AS major', 'grade', 'archives.id AS aid')
                ->limit($limit);

            if (!Auth::user()->is_super) {
                $model = $model->whereIn('major_id', Auth::user()->majors->pluck('id')->toArray())
                    ->whereIn('grade', explode(',', Auth::user()->grade));
            }

            return $model->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function allGrades()
    {
        try {
            $model = $this->model->distinct();

            if (!Auth::user()->is_super) {
                $model = $model->whereIn('grade', explode(',', Auth::user()->grade));
            }

            return $model->select('grade')
                ->orderBy('grade', 'desc')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function allLevels()
    {
        try {
            $model = $this->model->distinct();

            if (!Auth::user()->is_super) {
                $model = $model->whereIn('level', Auth::user()->groups->pluck('id')->toArray());
            }

            return $model->select('level')
                ->orderBy('level')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function allStudentsBy($attributes, $relations, $orders, $trashed)
    {
        $fields = [];

        if (isset($attributes['sid']) && !is_null($attributes['sid'])) {
            if (is_array($attributes['sid'])) {
                $fields['id'] = $attributes['sid'];
            } elseif (!empty($attributes['sid'])) {
                $fields['id'] = ['like', '%' . $attributes['sid'] . '%'];
            }
        }

        if (isset($attributes['name']) && !is_null($attributes['name'])) {
            if (is_array($attributes['name'])) {
                $fields['name'] = $attributes['name'];
            } elseif (!empty($attributes['name'])) {
                $fields['name'] = ['like', '%' . $attributes['name'] . '%'];
            }
        }

        if (isset($attributes['level'])) {
            if ('all' === $attributes['level']) {
                if (!Auth::user()->is_super) {
                    $levels = Auth::user()->groups->pluck('id')->toArray();
                    $fields['level'] = ['in', $levels];
                }
            } else {
                $fields['level'] = $attributes['level'];
            }
        }

        if (isset($attributes['department'])) {
            if ('all' === $attributes['department']) {
                if (!Auth::user()->is_super) {
                    $fields['department_id'] = Auth::user()->department_id;
                }
            } else {
                $fields['department_id'] = $attributes['department'];
            }
        }

        if (isset($attributes['major'])) {
            if ('all' === $attributes['major']) {
                if (!Auth::user()->is_super) {
                    $majors = Auth::user()->majors->pluck('id')->toArray();
                    $fields['major_id'] = ['in', $majors];
                }
            } else {
                $fields['major_id'] = $attributes['major'];
            }
        }

        if (isset($attributes['grade'])) {
            if ('all' === $attributes['grade']) {
                if (!Auth::user()->is_super) {
                    $grades = explode(',', Auth::user()->grade);
                    $fields['grade'] = ['in', $grades];
                }
            }
        } else {
            $fields['grade'] = $attributes['grade'];
        }

        return $this->findBy($fields, $relations, $orders, $trashed);
    }
}
