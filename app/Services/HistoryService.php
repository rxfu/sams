<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\ArchiveRepository;
use App\Repositories\HistoryRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\Arr;

class HistoryService extends Service
{
    protected $archives;

    protected $students;

    public function __construct(HistoryRepository $histories, ArchiveRepository $archives, StudentRepository $students)
    {
        $this->repository = $histories;
        $this->archives = $archives;
        $this->students = $students;
    }

    public function getDepartments()
    {
        return $this->repository->department();
    }

    public function getMajors()
    {
        return $this->repository->major();
    }

    public function getGrades()
    {
        return $this->repository->grade();
    }

    public function getLevels()
    {
        return $this->repository->level();
    }

    public function store($data)
    {
        $archive = $data['archive'];

        if (is_null($archive)) {
            $data = Arr::escept($data, ['archive']);
            $students = $this->students->allStudentsBy($data, null, null, false);
            $archives = $this->archives->getUnarchivedByStudents($students->pluck('id')->toArray());
        } else {
            $archives = $this->archives->findBy(['id' => $archive->id]);
        }

        foreach ($archives as $archive) {
            $student = $archive->student;

            $attributes = [
                'id' => $student->id,
                'name' => $student->name,
                'idtype_id' => $student->idtype_id,
                'idtype' => optional($student->idtype)->name,
                'idnumber' => $student->idnumber,
                'gender_id' => $student->gender_id,
                'gender' => optional($student->gender)->name,
                'nation_id' => $student->nation_id,
                'nation' => optional($student->nation)->name,
                'department_id' => $student->department_id,
                'department' => optional($student->department)->name,
                'major_id' => $student->major_id,
                'major' => optional($student->major)->name,
                'grade' => $student->grade,
                'duration' => $student->duration,
                'level' => config('setting.level.' . $student->level),
                'archive_id' => $archive->id,
            ];

            if (parent::store($attributes)) {
                $archive->is_archived = true;
                $archive->save();
            }
        }

        return $archives;
    }

    public function delete($model)
    {
        $archive = $this->archives->find($model->archive_id);

        $this->archives->update($archive->id, ['is_archived' => false]);

        return parent::delete($model);
    }

    protected function getSearchQuery($attributes, $relations, $orders, $trashed)
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
            } else {
                $fields['grade'] = $attributes['grade'];
            }
        }

        return $this->repository->queryBy($fields, $relations, $orders, $trashed);
    }
}
