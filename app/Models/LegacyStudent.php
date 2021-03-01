<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegacyStudent extends Model
{
    public $table = 'lgcy_students';

    public $primaryKey = '学号';

    public $incrementing = false;

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('App\Models\LegacyDepartment', '院系号', '院系号');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\LegacyMajor', '专业号', '专业号');
    }
}
