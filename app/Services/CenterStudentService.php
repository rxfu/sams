<?php

namespace App\Services;

use App\Repositories\CenterStudentRepository;

class CenterStudentService extends Service
{
    public function __construct(CenterStudentRepository $centerStudents)
    {
        $this->repository = $centerStudents;
    }

    public function getAllGrades()
    {
        return $this->repository->allGrades();
    }

    public function getAllLevels()
    {
        return $this->repository->allLevels();
    }

    protected function getSearchQuery($attributes, $relations, $orders, $trashed)
    {
        $fields = [];

        if (!is_null($attributes['id'])) {
            if (is_array($attributes['id'])) {
                $fields['xh'] = $attributes['id'];
            } elseif (!empty($attributes['id'])) {
                $fields['xh'] = ['like', '%' . $attributes['id'] . '%'];
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
            $fields['sjly'] = ($attributes['level'] == 0 ? '教务管理系统' : '研究生系统');
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

        $query = $this->repository->queryBy($fields, $relations, $orders, $trashed);

        return $query;
    }
}
