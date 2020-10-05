<?php

namespace App\Models;

class CenterMajor extends CenterModel
{
    protected $presenter = 'App\Presenters\CenterMajorPresenter';

    public $table = 'GXJX_ZYXXSJLB';

    public $primaryKey = 'ZYH';

    public $incrementing = false;

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('App\Models\CenterDepartment', 'dwh', 'dwh');
    }
}
