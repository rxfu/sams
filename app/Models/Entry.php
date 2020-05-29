<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Entry extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\EntryPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_enable', 'description', 'order',
    ];

    public function archives()
    {
        return $this->belongsToMany('App\Models\Archive')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
