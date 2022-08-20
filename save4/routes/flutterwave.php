<?php

use App\Http\Controllers\FlutterwaveController;
use Illuminate\Support\Facades\Route;

// The route that the button calls to initialize payment
Route::post('/rave/pay', [FlutterwaveController::class, 'initialize'])->name('rave.pay');
// The callback url after a payment
Route::get('/rave/callback', [FlutterwaveController::class, 'callback'])->name('rave.callback');

/**
 * BACKEND
 */
Route::get('/dashboard/flutterwave', [FlutterwaveController::class, 'index'])->name('dashboard.flutterwave.index');
Route::get('/dashboard/flutterwave/store', [FlutterwaveController::class, 'store'])->name('payment.setup.flutterwave.store');
