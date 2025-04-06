<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Filters\DateFilter;
use App\Filters\CategoryFilter;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Transaction::where('user_id', $userId);

        // Aplicando o filtro de data
        $query = DateFilter::apply($query, $request->input('start_date'), $request->input('end_date'));

        // Aplicando o filtro de categoria
        $query = CategoryFilter::apply($query, $request->input('category_name'));

        // Agrupamento por mês
        $monthlyData = (clone $query)
            ->select(
                DB::raw("DATE_FORMAT(date, '%Y-%m') as month"),
                DB::raw("SUM(amount) as total")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Agrupamento por categoria
        $categoryData = (clone $query)
            ->select(
                'category_id',
                DB::raw("SUM(amount) as total")
            )
            ->groupBy('category_id')
            ->with('category')
            ->get();

        return response()->json([
            'monthlyData' => $monthlyData,
            'categoryData' => $categoryData,
        ]);
    }
}