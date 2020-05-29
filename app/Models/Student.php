<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $table = 'students';

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = 'xh';

    public function getIdAttribute()
    {
        return $this->xh;
    }

    public function getNameAttribute()
    {
        return $this->xm;
    }

    public function getCardNumberAttribute()
    {
        return $this->sfzh;
    }

    public function getDepartmentAttribute()
    {
        return $this->xy;
    }

    public function getMajorAttribute()
    {
        return $this->zy;
    }

    public function getGradeAttribute()
    {
        return $this->nj;
    }

    public function archives()
    {
        return $this->hasMany('App\Models\Archive', 'sid', 'xh');
    }
}
