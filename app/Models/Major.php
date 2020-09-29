<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'is_enable', 'department_id', 'description',
    ];

    public $incrementing = false;

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
