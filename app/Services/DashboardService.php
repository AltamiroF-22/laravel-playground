<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardService
{
    public function getDashboardData(array $filters, int $userId)
    {
        $query = Transaction::where('user_id', $userId);

        // Filtro por datas
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $start = strlen($filters['start_date']) === 7
                ? Carbon::parse($filters['start_date'] . '-01')->startOfMonth()
                : Carbon::parse($filters['start_date']);

            $end = strlen($filters['end_date']) === 7
                ? Carbon::parse($filters['end_date'] . '-01')->endOfMonth()
                : Carbon::parse($filters['end_date']);

            $query->whereBetween('date', [$start, $end]);
        }

        // Filtro por nome da categoria
        if (!empty($filters['category_name'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['category_name'] . '%');
            });
        }

        // Consulta para dados mensais agrupados por categoria
        $monthlyCategoryData = (clone $query)
            ->select(
                DB::raw("DATE_FORMAT(date, '%Y-%m') as month"),
                'category_id',
                DB::raw("SUM(amount) as total")
            )
            ->groupBy('month', 'category_id')
            ->orderBy('month')
            ->with('category') // Caso você precise dos dados da categoria
            ->get();

        // Se ainda quiser manter as agregações separadas
        $monthlyData = (clone $query)
            ->select(
                DB::raw("DATE_FORMAT(date, '%Y-%m') as month"),
                DB::raw("SUM(amount) as total")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $categoryData = (clone $query)
            ->select(
                'category_id',
                DB::raw("SUM(amount) as total")
            )
            ->groupBy('category_id')
            ->with('category')
            ->get();

        return [
            'monthlyCategoryData' => $monthlyCategoryData,
            'monthlyData' => $monthlyData,
            'categoryData' => $categoryData,
        ];
    }
}