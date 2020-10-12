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

    protected function getSearchQuery($attributes, $relations, $orders, $trashed)
    {
        $fields = [];

        if (!is_null($attributes['sid'])) {
            if (is_array($attributes['sid'])) {
                $fields['xh'] = $attributes['sid'];
            } elseif (!empty($attributes['sid'])) {
                $fields['xh'] = ['like', '%' . $attributes['sid'] . '%'];
            }
        }

        if (!is_null($attributes['name'])) {
            if (is_array($attributes['name'])) {
                $fields['xm'] = $attributes['name'];
            } elseif (!empty($attributes['name'])) {
                $fields['xm'] = ['like', '%' . $attributes['name'] . '%'];
            }
        }

        if ('all' !== $attributes['level']) {
            $fields['sjly'] = $attributes['level'];
        }

        if ('all' !== $attributes['department']) {
            $fields['dwh'] = $attributes['department'];
        }

        if ('all' !== $attributes['major']) {
            $fields['zydm'] = $attributes['major'];
        }

        if ('all' !== $attributes['grade']) {
            $fields['dqszj'] = $attributes['grade'];
        }

        $students = $this->studentRepository->findBy($fields, $relations, $orders, $trashed);

        $query = $this->repository->getAllByStudentsQuery($students->pluck('xh')->toArray());

        return $query;
    }
}
