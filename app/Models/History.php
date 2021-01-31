<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'idtype_id', 'idtype', 'idnumber', 'gender_id', 'gender', 'nation_id', 'nation', 'department_id', 'department', 'major_id', 'major', 'grade', 'duration', 'level', 'archive_id',
    ];
}
