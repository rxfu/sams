<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'is_enable', 'category', 'description',
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

    public function majors()
    {
        return $this->hasMany('App\Models\Major');
    }

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
