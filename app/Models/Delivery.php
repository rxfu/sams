<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'archive_id', 'forward', 'status', 'receiver', 'phone', 'address', 'had_receipt', 'creator_id', 'editor_id', 'version', 'remark', 
    ];
}
