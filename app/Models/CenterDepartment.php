<?php

namespace App\Models;

class CenterDepartment extends CenterModel
{
    protected $presenter = 'App\Presenters\CenterDepartmentPresenter';

    public $table = 'GXXX_YXSDWJBSJZL';

    public $primaryKey = 'DWH';

    public $incrementing = false;

    public $timestamps = false;
}
