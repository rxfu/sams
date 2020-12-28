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
        'id', 'name', 'is_enable', 'department_id', 'level', 'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_enable' => 'boolean',
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

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'level');
    }
}
