<?php

namespace App\Services;

use App\Repositories\ArchiveRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\StudentRepository;
use App\Repositories\DeliveryRepository;

class DeliveryService extends Service
{
    protected $studentRepository;

    protected $archiveRepository;

    public function __construct(DeliveryRepository $deliveries, StudentRepository $studentRepository, ArchiveRepository $archiveRepository)
    {
        $this->repository = $deliveries;
        $this->studentRepository = $studentRepository;
        $this->archiveRepository = $archiveRepository;
    }

    public function store($data)
    {
        $data['creator_id'] = Auth::id();
        $data['editor_id'] = Auth::id();
        $data['version'] = $this->repository->maxVersion($data['archive_id']) + 1;

        return $this->repository->save($data);
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

        $archives = $this->archiveRepository->getAllByStudents($students->pluck('id')->toArray());

        $query = $this->repository->getAllByArchives($archives->pluck('id')->toArray());

        return $query;
    }
}
