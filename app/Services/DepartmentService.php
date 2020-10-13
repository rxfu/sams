<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\DepartmentRepository;
use App\Repositories\CenterDepartmentRepository;

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
                'category' => array_search($item->dwlbmc, config('setting.category')),
            ];

            $this->repository->updateOrCreate($attributes, $values);
        }

        return true;
    }

    public function getCollege()
    {
        $attributes = [
            'is_enable' => true,
            'category' => 0,
        ];

        if (!Auth::user()->is_super) {
            $attributes['id'] = Auth::user()->department_id;
        }

        return $this->repository->findBy($attributes);
    }
}
