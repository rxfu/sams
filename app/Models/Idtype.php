<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idtype extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'is_enable', 'description',
    ];

    public $incrementing = false;

    public $timestamps = false;
}
