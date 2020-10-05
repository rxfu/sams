<?php

namespace App\Models;

class CenterIdtype extends CenterModel
{
    protected $presenter = 'App\Presenters\CenterIdtypePresenter';

    public $table = 'DM_TB_SFZJLXDMB';

    public $primaryKey = 'DM';

    public $incrementing = false;

    public $timestamps = false;
}
