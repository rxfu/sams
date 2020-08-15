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
        return $this->sfzjh;
    }

    public function getGradeAttribute()
    {
        return $this->dqszj;
    }

    public function archives()
    {
        return $this->hasMany('App\Models\Archive', 'sid', 'xh');
    }
}
