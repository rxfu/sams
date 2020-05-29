<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class DeliveryPresenter extends Presenter
{
    public function hasStatus()
    {
        switch ($this->status) {
            case 0:
                return '未投递';

            case 1:
                return '已投递';

            case 2:
                return '被退回';

            default:
                return '未投递';
        }
    }
}
