<?php

namespace App\Services;

use App\Repositories\CenterDepartmentRepository;
use App\Repositories\DepartmentRepository;

class DepartmentService extends Service
{
    protected $centerDepartments;

    public function __construct(DepartmentRepository $departments, CenterDepartmentRepository $centerDepartments)
    {
        $this->repository = $departments;
        $this->centerDepartments = $centerDepartments;
    }

    public function sync()
    {
        $items = $this->centerDepartments->findAll();

        foreach ($items as $item) {
            $attributes = [
                'id' => $item->dwh,
            ];

            $values = [
                'name' => $item->dwmc,
                'is_enable' => $item->dwyxbs == 1 ? true : false,
            ];

            $this->repository->updateOrCreate($attributes, $values);
        }

        return true;
    }
}
