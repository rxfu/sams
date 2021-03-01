<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Delivery extends Model
{
    use PresentableTrait;

    protected $presenter = 'App\Presenters\DeliveryPresenter';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'archive_id', 'receiver', 'employment', 'reason', 'status', 'ems', 'phone', 'address', 'zipcode', 'send_at', 'had_receipt', 'receiver', 'creator_id', 'editor_id', 'version', 'remark',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'send_at' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    public function editor()
    {
        return $this->belongsTo('App\Models\User', 'editor_id');
    }

    public function archive()
    {
        return $this->belongsTo('App\Models\Archive');
    }
}
