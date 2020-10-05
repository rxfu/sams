<?php

namespace App\Services;

use App\Repositories\CenterMajorRepository;
use App\Repositories\MajorRepository;

class MajorService extends Service
{
    protected $centerMajors;
    public function __construct(MajorRepository $majors, CenterMajorRepository $centerMajors)
    {
        $this->repository = $majors;
        $this->centerMajors = $centerMajors;
    }

    public function sync()
    {
        $items = $this->centerMajors->findBy([
            'dwh' => ['not null'],
        ]);

        foreach ($items as $item) {
            $attributes = [
                'id' => $item->zyh,
            ];

            $values = [
                'name' => $item->zymc,
                'is_enable' => true,
                'department_id' => $item->dwh,
            ];

            $this->repository->updateOrCreate($attributes, $values);
        }

        return true;
    }
}
