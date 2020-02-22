<?php

namespace Modules\Movie\Filters;

use Modules\Movie\Filters\QueryFilter;


class MovieFilter extends QueryFilter
{
    public function filter_category_id($id)
    {
        // dd($this->builder->where('genre_ids', 'like', '%' . $id . '%')->get());
        return $this->builder->where('genre_ids', 'like', '%' . $id . '%');
    }
    
    public function sort_popular($type)
    {
        return $this->builder->orderBy('popularity', $type);
    }

    public function sort_rated($type)
    {
        return $this->builder->orderBy('vote_count', $type);
    }
}