<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class EntryPresenter extends Presenter
{
    public function isEnable()
    {
        return $this->is_enable ? '是' : '否';
    }

    public function allGroups()
    {
        $groups = [];

        foreach ($this->groups as $group) {
            $groups[] = $group->name;
        }

        return implode(',', $groups);
    }
}
