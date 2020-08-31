<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sid', 'card_number', 'received_at', 'name', 'department_id', 'major_id', 'grade', 'creator_id', 'editor_id', 'remark',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['entry'];

    public function entries()
    {
        return $this->belongsToMany('App\Models\Entry')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'sid', 'xh');
    }

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    public function editor()
    {
        return $this->belongsTo('App\Models\User', 'editor_id');
    }

    public function deliveries()
    {
        return $this->hasMany('App\Models\Delivery');
    }
}
