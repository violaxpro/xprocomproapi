<?php
namespace App\Http\Traits;

trait ModelHelper {
    public function scopeSearchQuery($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            foreach ($this->searchable as $column) {
                $query->orWhere($column, 'like', "%{$search}%");
            }
        });
    }
}
