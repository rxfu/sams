<?php

namespace App\Services;

use App\Repositories\CenterMajorRepository;
use App\Repositories\GroupRepository;
use App\Repositories\MajorRepository;
use Illuminate\Support\Facades\Auth;

class MajorService extends Service
{
    protected $centerMajors;

    protected $groups;

    public function __construct(MajorRepository $majors, CenterMajorRepository $centerMajors, GroupRepository $groups)
    {
        $this->repository = $majors;
        $this->centerMajors = $centerMajors;
        $this->groups = $groups;
    }

    public function sync()
    {
        $items = $this->centerMajors->findBy([
            'dwh' => ['not null'],
        ]);

        $levels = [
            '教务管理系统' => $this->groups->slug('bachelor')->id,
            '研究生系统' => $this->groups->slug('master')->id,
        ];

        foreach ($items as $item) {
            $attributes = [
                'id' => $item->zyh,
            ];

            $values = [
                'name' => $item->zymc,
                'is_enable' => true,
                'department_id' => $item->dwh,
                'level' => $levels[$item->sjly],
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
