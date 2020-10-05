<?php

namespace App\Presenters;

use App\Models\Nation;
use Laracasts\Presenter\Presenter;

class CenterNationPresenter extends Presenter
{
    public function id()
    {
        $item = Nation::find($this->dm);

        if ($item && $item->id == $this->dm) {
            return $this->dm;
        } else {
            return '<span class="text-danger">' . $this->dm . '</span>';
        }
    }

    public function name()
    {
        $item = Nation::find($this->dm);

        if ($item && $item->name == $this->mc) {
            return $this->mc;
        } else {
            return '<span class="text-danger">' . $this->mc . '</span>';
        }
    }

    public function slug()
    {
        $item = Nation::find($this->dm);

        if ($item && $item->slug == $this->zmdm) {
            return $this->zmdm;
        } else {
            return '<span class="text-danger">' . $this->zmdm . '</span>';
        }
    }

    public function is_enable()
    {
        $item = Nation::find($this->dm);
        $isEnable = (1 == $this->zt) ? '已启用' : '未启用';

        if ($item && $item->is_enable == $this->zt) {
            return $isEnable;
        } else {
            return '<span class="text-danger">' . $isEnable . '</span>';
        }
    }

    public function description()
    {
        $item = Nation::find($this->dm);

        return optional($item)->description;
    }
}
