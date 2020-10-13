<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\ArchiveRepository;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\DB;

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

    protected function generateId()
    {
        $maxId = DB::table('archives')
            ->select(DB::raw('IFNULL(MAX(RIGHT(id, 4)), 0) AS max_id'))
            ->whereRaw('MID(id, 1, 6) = ?', date('ymd'))
            ->first();

        return date('ymd') . str_pad(1 + $maxId->max_id, 4, '0', STR_PAD_LEFT);
    }

    public function store($data)
    {
        $userId = Auth::id();
        $student = $this->studentRepository->find($data['sid']);
        $data['id'] = $this->generateId();
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
                $fields['id'] = $attributes['sid'];
            } elseif (!empty($attributes['sid'])) {
                $fields['id'] = ['like', '%' . $attributes['sid'] . '%'];
            }
        }

        if (!is_null($attributes['name'])) {
            if (is_array($attributes['name'])) {
                $fields['name'] = $attributes['name'];
            } elseif (!empty($attributes['name'])) {
                $fields['name'] = ['like', '%' . $attributes['name'] . '%'];
            }
        }

        if ('all' !== $attributes['level']) {
            $fields['level'] = $attributes['level'];
        }

        if ('all' !== $attributes['department']) {
            $fields['department_id'] = $attributes['department'];
        }

        if ('all' !== $attributes['major']) {
            $fields['major_id'] = $attributes['major'];
        }

        if ('all' !== $attributes['grade']) {
            $fields['grade'] = $attributes['grade'];
        }

        $students = $this->studentRepository->findBy($fields, $relations, $orders, $trashed);

        $query = $this->repository->getAllByStudentsQuery($students->pluck('id')->toArray());

        return $query;
    }

    public function getAll()
    {
        if (!Auth::user()->is_super) {
            return $this->repository->with(['student' => function ($query) {
                $query->whereIn('major_id', Auth::user()->majors->pluck('id')->toArray());
            }])->get();
        }

        return parent::getAll();
    }
}
