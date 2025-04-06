<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\DashboardController;

Route::post('/users',[UserController::class, 'store' ]);
Route::get('/users',[UserController::class, 'index' ]);


Route::post('/login',[LoginController::class, 'login' ]);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
});