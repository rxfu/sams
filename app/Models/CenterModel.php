<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class CenterModel extends Model
{
    use PresentableTrait;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'oracle';
}
