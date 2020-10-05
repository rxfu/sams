<?php

namespace App\Presenters;

use App\Models\Idtype;
use Laracasts\Presenter\Presenter;

class CenterIdtypePresenter extends Presenter
{
    public function id()
    {
        $item = Idtype::find($this->dm);

        if ($item && $item->id == $this->dm) {
            return $this->dm;
        } else {
            return '<span class="text-danger">' . $this->dm . '</span>';
        }
    }

    public function name()
    {
        $item = Idtype::find($this->dm);

        if ($item && $item->name == $this->mc) {
            return $this->mc;
        } else {
            return '<span class="text-danger">' . $this->mc . '</span>';
        }
    }

    public function is_enable()
    {
        $isEnable = (1 == $this->zt) ? '已启用' : '未启用';
        $item = Idtype::find($this->dm);

        if ($item && $item->is_enable == $this->zt) {
            return $isEnable;
        } else {
            return '<span class="text-danger">' . $isEnable . '</span>';
        }
    }

    public function description()
    {
        $item = Idtype::find($this->dm);

        return optional($item)->description;
    }
}
