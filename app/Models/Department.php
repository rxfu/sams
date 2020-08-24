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
        'name', 'is_enable', 'description',
    ];

    public $incrementing = false;

    public function majors()
    {
        return $this->hasMany('App\Models\Major');
    }
}
