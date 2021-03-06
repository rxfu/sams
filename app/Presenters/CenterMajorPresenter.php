<?php

namespace App\Presenters;

use App\Models\Major;
use Laracasts\Presenter\Presenter;

class CenterMajorPresenter extends Presenter
{
    public function id()
    {
        $item = Major::find($this->zyh);

        if ($item && $item->id == $this->zyh) {
            return $this->zyh;
        } else {
            return '<span class="text-danger">' . $this->zyh . '</span>';
        }
    }

    public function name()
    {
        $item = Major::find($this->zyh);

        if ($item && $item->name == $this->zymc) {
            return $this->zymc;
        } else {
            return '<span class="text-danger">' . $this->zymc . '</span>';
        }
    }

    public function is_enable()
    {
        $item = Major::find($this->zyh);

        if ($item) {
            return $item->is_enable ? '已启用' : '未启用';
        }
    }

    public function description()
    {
        $item = Major::find($this->zyh);

        return optional($item)->description;
    }

    public function department_name()
    {
        $item = Major::find($this->zyh);

        if ($item && $item->department_id == $this->dwh) {
            return optional($this->department)->dwmc;
        } else {
            return '<span class="text-danger">' . optional($this->department)->dwmc . '</span>';
        }
    }

    public function level()
    {
        $item = Major::find($this->zyh);

        if ('教务管理系统' == $this->sjly) {
            $level = 0;
        } elseif ('研究生系统' == $this->sjly) {
            $level = 1;
        }

        if ($item && $item->level == $level) {
            return config('setting.level.' . $level);
        } else {
            return '<span class="text-danger">' . config('setting.level.' . $level) . '</span>';
        }
    }
}
