<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'idtype', 'idnumber', 'gender_id', 'nation_id', 'department_id', 'major_id', 'grade', 'duration', 'stauts', 'level',
    ];

    public $incrementing = false;

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\Major');
    }

    public function nation()
    {
        return $this->belongsTo('App\Models\Nation');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function idtype()
    {
        return $this->belongsTo('App\Models\Idtype');
    }

    public function archive()
    {
        return $this->hasOne('App\Models\Archive', 'sid', 'id');
    }
}
