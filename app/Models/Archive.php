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
        'id', 'sid', 'received_at', 'name', 'creator_id', 'editor_id', 'remark', 'is_archived',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['entry'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_archived' => 'boolean',
    ];

    public function entries()
    {
        return $this->belongsToMany('App\Models\Entry')
            ->withPivot('quantity')
            ->withTimestamps()
            ->orderBy('id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'sid', 'id');
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
