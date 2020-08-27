<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\ArchiveRepository;
use App\Repositories\StudentRepository;

class ArchiveService extends Service
{
    protected $studentRepository;

    public function __construct(ArchiveRepository $archives, StudentRepository $studentRepository)
    {
        $this->repository = $archives;
        $this->studentRepository = $studentRepository;
    }

    public function getBySid($sid)
    {
        return $this->repository->findBySid($sid);
    }

    public function store($data)
    {
        $userId = Auth::id();
        $student = $this->studentRepository->find($data['sid']);
        $data['id'] = date('Y') . $student->dwh . substr($student->id, -4);
        $data['creator_id'] = $userId;
        $data['editor_id'] = $userId;

        $entries = array_map(function ($number) use ($userId) {
            return [
                'quantity' => $number ?? 0,
                'creator_id' => $userId,
                'editor_id' => $userId,
            ];
        }, $data['entry']);

        $archive = $this->repository->save($data);
        $archive->entries()->sync($entries);

        return $archive;
    }

    public function update($model, $data)
    {
        $userId = Auth::id();
        $data['editor_id'] = $userId;

        $entries = array_map(function ($number) use ($userId) {
            return [
                'quantity' => $number ?? 0,
                'editor_id' => $userId,
            ];
        }, $data['entry']);

        $archive = $this->repository->update($model->getKey(), $data);
        $archive->entries()->sync($entries);

        return $archive;
    }

    public function search($sid, $name, $level, $department, $major, $grade)
    {
        return $this->studentRepository->searchBy($sid, $name, $level, $department, $major, $grade);
    }
}
