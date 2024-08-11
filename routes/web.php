<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\FinanceUser as IsFinance;
use App\Http\Middleware\AdminUser as IsAdmin;

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventPaymentController;
use App\Http\Controllers\PaymentProviderRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', IsAdmin::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', IsFinance::class])->group(function () {
    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::get('/finance/edit-payment/{eventId}', [FinanceController::class, 'editPayment'])->name('finance.edit-payment');
    Route::post('/finance/update-payment/{eventId}', [FinanceController::class, 'updatePayment'])->name('finance.update-payment');
    Route::get('/finance/request-payment-provider', [FinanceController::class, 'requestPaymentProvider'])->name('finance.request-payment-provider');
    Route::post('/finance/store-payment-provider-request', [FinanceController::class, 'storePaymentProviderRequest'])->name('finance.store-payment-provider-request');

    Route::post('/finance/store-event', [EventController::class, 'store_event'])->name('finance.store-event');

    Route::post('/event-payments', [EventPaymentController::class, 'store'])->name('event-payments.store');
    Route::put('/event-payments/{id}', [EventPaymentController::class, 'update'])->name('event-payments.update');
    Route::get('/event-payments/{id}', [EventPaymentController::class, 'show'])->name('event-payments.show');
    Route::delete('/event-payments/{id}', [EventPaymentController::class, 'destroy'])->name('event-payments.destroy');

    Route::post('/payment-provider-request', [PaymentProviderRequestController::class, 'store'])->name('payment-provider-request.store');
});

require __DIR__.'/auth.php';
