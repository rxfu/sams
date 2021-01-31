<?php

namespace App\Services;

use App\Repositories\ArchiveRepository;
use App\Repositories\HistoryRepository;

class HistoryService extends Service
{
    protected $archives;

    public function __construct(HistoryRepository $histories, ArchiveRepository $archives)
    {
        $this->repository = $histories;
        $this->archives = $archives;
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
        $archives = $this->archives->findBy($data, ['student', 'student.idtype', 'student.department', 'student.major', 'student.grade', 'student.level', 'student.nation']);

        foreach ($archives as $archive) {
            $student = $archive->student;

            $attributes = [
                'id' => $student->id,
                'name' => $student->name,
                'idtype_id' => $student->idtype_id,
                'idtype' => optional($student->idtype)->name,
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

        $this->archives->update($archive, ['is_archived' => false]);

        return parent::delete($model);
    }
}
