<?php

namespace App\Models;

class CenterStudent extends CenterModel
{
    protected $presenter = 'App\Presenters\CenterStudentPresenter';

    public $table = 'GXXS_XSJBSJZL';

    public $primaryKey = 'XH';

    public $incrementing = false;

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('App\Models\CenterDepartment', 'dwh', 'dwh');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\CenterMajor', 'zydm', 'zyh');
    }

    public function idtype()
    {
        return $this->belongsTo('App\Models\CenterIdtype', 'sfzjlxm', 'dm');
    }

    public function nation()
    {
        return $this->belongsTo('App\Models\CenterNation', 'mzm', 'dm');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\CenterGender', 'xbm', 'dm');
    }
}
