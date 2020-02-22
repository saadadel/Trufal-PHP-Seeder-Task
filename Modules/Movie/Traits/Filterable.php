<?php

namespace Modules\Movie\Traits;

use Modules\Movie\Filters\QueryFilter;

Trait Filterable
{
    public function scopeFilter($builder, QueryFilter $filters)
    {
        $filters->applyFilters($builder);
    }
}