<?php

namespace App\Presenters;

use App\Models\Department;
use Laracasts\Presenter\Presenter;

class CenterDepartmentPresenter extends Presenter
{
    public function id()
    {
        $item = Department::find($this->dwh);

        if ($item && $item->id == $this->dwh) {
            return $this->dwh;
        } else {
            return '<span class="text-danger">' . $this->dwh . '</span>';
        }
    }

    public function name()
    {
        $item = Department::find($this->dwh);

        if ($item && $item->name == $this->dwmc) {
            return $this->dwmc;
        } else {
            return '<span class="text-danger">' . $this->dwmc . '</span>';
        }
    }

    public function is_enable()
    {
        $item = Department::find($this->dwh);
        $isEnable = (1 == $this->dwyxbs) ? '已启用' : '未启用';

        if ($item && $item->is_enable == $this->dwyxbs) {
            return $isEnable;
        } else {
            return '<span class="text-danger">' . $isEnable . '</span>';
        }
    }

    public function category()
    {
        $item = Department::find($this->dwh);

        if ($item && config('setting.category.' . $item->category) == $this->dwlbmc) {
            return $this->dwlbmc;
        } else {
            return '<span class="text-danger">' . $this->dwlbmc . '</span>';
        }
    }

    public function description()
    {
        $item = Department::find($this->dwh);

        return optional($item)->description;
    }
}
