<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sid', 'card_number', 'received_at', 'name', 'department_id', 'major_id', 'grade', 'creator_id', 'editor_id', 'remark', 
    ];
}
