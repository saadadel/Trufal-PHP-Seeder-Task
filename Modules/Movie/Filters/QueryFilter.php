<?php

namespace Modules\Movie\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


abstract Class QueryFilter
{

    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function applyFilters(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->queries() as $key => $value) 
        {
            // Sort query
            if (strpos($key, '|'))
            {
                $key = explode('|', $key);
                method_exists($this, 'sort_' . $key[0]) ? call_user_func_array([$this, 'sort_' . $key[0]], array_filter([$key[1]])) : '';
            }
            // Fitler query
            else
            {
                method_exists($this, 'filter_' . $key) ? call_user_func_array([$this, 'filter_' . $key], array_filter([$value])) : '';
            }
        }
        
        return $this->builder;
    }

    public function queries()
    {
        return $this->request->all();
    }
}