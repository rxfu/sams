<?php

namespace App\Services;

use App\Repositories\CenterStudentRepository;
use App\Repositories\GroupRepository;
use App\Repositories\StudentRepository;

class StudentService extends Service
{
    protected $centerStudent;

    protected $groups;

    public function __construct(StudentRepository $students, CenterStudentRepository $centerStudent, GroupRepository $groups)
    {
        $this->repository = $students;
        $this->centerStudent = $centerStudent;
        $this->groups = $groups;
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

    public function sync()
    {
        $items = $this->centerStudent->necessary();

        $status = [
            '不在校' => 0,
            '在校' => 1,
        ];

        $levels = [
            '教务管理系统' => $this->groups->slug('bachelor')->id,
            '研究生系统' => $this->groups->slug('master')->id,
        ];

        foreach ($items as $item) {
            $attributes = [
                'id' => $item->xh,
            ];

            $values = [
                'name' => $item->xm,
                'idtype_id' => $item->sfzjlxm,
                'name' => $item->xm,
                'idnumber' => $item->sfzjh,
                'gender_id' => $item->xbm,
                'nation_id' => $item->mzm,
                'department_id' => $item->dwh,
                'major_id' => $item->zydm,
                'grade' => $item->dqszj,
                'duration' => $item->xz,
                'status' => $status[$item->sfzx],
                'level' => $levels[$item->sjly],
            ];

            array_walk($values, function (&$v) {
                $v = trim($v);
            });

            $this->repository->updateOrCreate($attributes, $values);
        }

        return true;
    }

    public function list($keyword)
    {
        return $this->repository->doesntHaveArchive($keyword);
    }

    public function getAllStudents($attributes = null, $relations = null, $orders = null, $trashed = false)
    {
        return $this->repository->allStudentsBy($attributes, $relations, $orders, $trashed);
    }
}
