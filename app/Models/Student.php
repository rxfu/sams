<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $table = 'students';

    public $incrementing = false;

    protected $primaryKey = 'id';

    public function archive()
    {
        return $this->hasOne('App\Models\Archive', 'sid', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\Major');
    }
}
