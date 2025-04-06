<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\api\UserController; 

Route::post('/users',[UserController::class, 'store' ]);
Route::get('/users',[UserController::class, 'index' ]);


Route::post('/login',[LoginController::class, 'login' ]);