<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegacyDepartment extends Model
{
    public $table = 'lgcy_departments';

    public $primaryKey = '院系号';

    public $incrementing = false;

    public $timestamps = false;
}
