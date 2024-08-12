<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\FinanceUser as IsFinance;
use App\Http\Middleware\AdminUser as IsAdmin;

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\FinanceController;

Route::post('/api/v1/register', [AuthController::class, 'register']);
Route::post('/api/v1/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/api/v1/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/api/v1/profile', [AuthController::class, 'profile']);

Route::middleware(['auth:sanctum', IsFinance::class])->group(function () {
    Route::get('/api/events', [FinanceController::class, 'index']);
    Route::get('/api/payment-methods', [FinanceController::class, 'payement_methods']);
    Route::get('/api/companies', [FinanceController::class, 'companies']);
    Route::get('/api/payment-provider-requests', [FinanceController::class, 'payment_provider_requests']);
});

