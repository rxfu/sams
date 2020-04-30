<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'name', 'parent_id', 'description',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Role', 'parent_id');
    }
}
