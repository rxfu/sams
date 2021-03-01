<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegacyDelivery extends Model
{
    public $table = 'lgcy_deliveries';

    public $primaryKey = '学号';

    public $incrementing = false;

    public $timestamps = false;
}
