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
        'archive_id', 'forward', 'reason', 'status', 'receiver', 'phone', 'address', 'zipcode', 'send_at', 'had_receipt', 'creator_id', 'editor_id', 'version', 'remark',
    ];

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
}
