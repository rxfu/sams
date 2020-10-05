<?php

namespace App\Models;

class CenterNation extends CenterModel
{
    protected $presenter = 'App\Presenters\CenterNationPresenter';

    public $table = 'DM_GB_B_ZGGMZMCDLMZMPXFHDM';

    public $primaryKey = 'DM';

    public $incrementing = false;

    public $timestamps = false;
}
