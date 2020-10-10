<?php

namespace App\Services;

use App\Repositories\CenterMajorRepository;

class CenterMajorService extends Service
{
    public function __construct(CenterMajorRepository $centerMajors)
    {
        $this->repository = $centerMajors;
    }

    public function getAllLevels()
    {
        return $this->repository->allLevels();
    }

    protected function getSearchQuery($attributes, $relations, $orders, $trashed)
    {
        $fields = [];

        if (!is_null($attributes['name'])) {
            if (is_array($attributes['name'])) {
                $fields['zymc'] = $attributes['name'];
            } elseif (!empty($attributes['name'])) {
                $fields['zymc'] = ['like', '%' . $attributes['name'] . '%'];
            }
        }

        if ('all' !== $attributes['level']) {
            $fields['sjly'] = ($attributes['level'] == 0 ? '教务管理系统' : '研究生系统');
        }

        if ('all' !== $attributes['department']) {
            $fields['dwh'] = $attributes['department'];
        }

        $query = $this->repository->queryBy($fields, $relations, $orders, $trashed);

        return $query;
    }
}
