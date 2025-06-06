<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostDashboardDataRequest;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function store(PostDashboardDataRequest $request) {
        $userId = Auth::id();
        
        $data = $this->dashboardService->postDashboardData($request->all(), $userId);       
        
        return response()->json($data); 
    }

    public function index(Request $request)
    {
        $userId = Auth::id();

        $data = $this->dashboardService->getDashboardData($request->all(), $userId);

        return response()->json($data);
    }
}