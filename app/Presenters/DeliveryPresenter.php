<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class DeliveryPresenter extends Presenter
{
    public function hasStatus()
    {
        switch ($this->status) {
            case 0:
                return '未寄送';

            case 1:
                return '已寄送';

            case 2:
                return '被退回';

            default:
                return '未寄送';
        }
    }

    public function hadReceipt()
    {
        return $this->had_receipt ? '是' : '否';
    }
}
