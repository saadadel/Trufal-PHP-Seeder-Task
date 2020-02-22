<?php

namespace Modules\Movie\Entities;

use Modules\Movie\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use Filterable;

    protected $guarded = [];

}
