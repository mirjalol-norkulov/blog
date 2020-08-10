<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

/**
 * Trait Searchable
 * @package App\Traits
 */
trait Searchable
{
    /**
     * @param Builder $query
     * @param $q
     * @return Builder
     */
    public function scopeSearch(Builder $query, $q)
    {
        $match = implode(",", $this->searchableFields);
        return $query->whereRaw("MATCH($match) AGAINST(?)", $q);
    }
}
