<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class EntryPresenter extends Presenter
{
    public function isEnable()
    {
        return $this->is_enable ? '是' : '否';
    }
}
