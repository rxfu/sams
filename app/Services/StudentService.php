<?php

namespace App\Services;

use App\Repositories\CenterStudentRepository;
use App\Repositories\StudentRepository;

class StudentService extends Service
{
    protected $centerStudent;

    public function __construct(StudentRepository $students, CenterStudentRepository $centerStudent)
    {
        $this->repository = $students;
        $this->centerStudent = $centerStudent;
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
        $items = $this->centerStudent->findAll();

        foreach ($items as $item) {
            $attributes = [
                'id' => $item->xh,
            ];

            $values = [
                'name' => $item->xm,
                'idtype' => $item->sfzjlxm,
                'name' => $item->xm,
                'idnumber' => $item->sfzjh,
                'gender_id' => $item->xbm,
                'nation_id' => $item->mzm,
                'department_id' => $item->dwh,
                'major_id' => $item->zydm,
                'grade' => $item->dqszj,
                'duration' => $item->xz,
                'status' => $item->sfzx == '在校' ? 1 : 0,
                'level' => $item->sjly == '教务管理系统' ? 1 : 0,
            ];

            $this->repository->updateOrCreate($attributes, $values);
        }

        return true;
    }
}
