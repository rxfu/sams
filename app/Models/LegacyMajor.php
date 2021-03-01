<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegacyMajor extends Model
{
    public $table = 'lgcy_majors';

    public $primaryKey = '专业号';

    public $incrementing = false;

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('App\Models\LegacyDepartment', '院系号', '院系号');
    }
}
