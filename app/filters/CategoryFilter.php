<?php

namespace App\Filters;

class CategoryFilter
{
    public static function apply($query, $categoryName)
    {
        if ($categoryName) {
            return $query->whereHas('category', function ($q) use ($categoryName) {
                $q->where('name', 'like', '%' . $categoryName . '%');
            });
        }

        return $query;
    }
}