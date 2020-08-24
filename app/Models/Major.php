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
        'name', 'is_enable', 'department_id', 'description',
    ];

    public $incrementing = false;

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
