<?php

namespace App\Models;

class CenterGender extends CenterModel
{
    protected $presenter = 'App\Presenters\CenterGenderPresenter';

    public $table = 'DM_GB_B_RDXBDM';

    public $primaryKey = 'DM';

    public $incrementing = false;

    public $timestamps = false;
}
