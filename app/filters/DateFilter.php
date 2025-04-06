<?php

namespace App\Filters;

use Carbon\Carbon;

class DateFilter
{
    public static function apply($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            // Adapta se for só "YYYY-MM"
            if (strlen($startDate) === 7) {
                $startDate = Carbon::parse($startDate . '-01')->startOfMonth()->toDateString();
            } else {
                $startDate = Carbon::parse($startDate)->toDateString();
            }

            if (strlen($endDate) === 7) {
                $endDate = Carbon::parse($endDate . '-01')->endOfMonth()->toDateString();
            } else {
                $endDate = Carbon::parse($endDate)->toDateString();
            }

            return $query->whereBetween('date', [$startDate, $endDate]);
        }

        return $query;
    }
}