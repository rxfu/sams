<?php

namespace App\Services;

use App\Repositories\CenterMajorRepository;
use App\Repositories\MajorRepository;
use Illuminate\Support\Facades\Auth;

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
                'level' => $item->sjly == '教务管理系统' ? 0 : 1,
            ];

            $this->repository->updateOrCreate($attributes, $values);
        }

        return true;
    }

    public function getEnableItems($isEnable = true)
    {
        if (!Auth::user()->is_super) {
            return $this->repository->findBy([
                'id' => ['in', Auth::user()->majors->pluck('id')->toArray()],
            ]);
        }

        return parent::getEnableItems($isEnable);
    }
}
