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
        'name', 'is_enable', 'description', 
    ];
}
