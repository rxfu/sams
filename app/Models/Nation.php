<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'slug', 'name', 'is_enable', 'description',
    ];

    public $incrementing = false;

    public $timestamps = false;
}
