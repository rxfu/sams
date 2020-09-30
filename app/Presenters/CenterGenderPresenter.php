<?php

namespace App\Presenters;

use App\Models\Gender;
use Laracasts\Presenter\Presenter;

class CenterGenderPresenter extends Presenter
{
    public function id()
    {
        $item = Gender::find($this->dm);

        if ($item && $item->id == $this->dm) {
            return $this->dm;
        } else {
            return '<span class="text-danger">' . $this->dm . '</span>';
        }
    }

    public function name()
    {
        $item = Gender::find($this->dm);

        if ($item && $item->name == $this->mc) {
            return $this->mc;
        } else {
            return '<span class="text-danger">' . $this->mc . '</span>';
        }
    }

    public function is_enable()
    {
        $isEnable = (1 == $this->zt) ? '已启用' : '未启用';
        $item = Gender::find($this->dm);

        if ($item && $item->is_enable == $this->zt) {
            return $isEnable;
        } else {
            return '<span class="text-danger">' . $isEnable . '</span>';
        }
    }

    public function description()
    {
        $item = Gender::find($this->dm);

        return optional($item)->description;
    }
}
