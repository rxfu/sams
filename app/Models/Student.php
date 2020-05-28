<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $table = 'students';

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = 'xh';
}
