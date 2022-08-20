<?php

use App\Http\Controllers\InstamojoController;
use Illuminate\Support\Facades\Route;

// The route that the button calls to initialize payment
Route::post('/instamojo/pay', [InstamojoController::class, 'pay'])->name('instamojo.pay');
// The callback url after a payment
Route::get('/instamojo/callback', [InstamojoController::class, 'success'])->name('instamojo.success');

/**
 * BACKEND
 */
Route::get('/dashboard/instamojo', [InstamojoController::class, 'index'])->name('dashboard.instamojo.index');
Route::get('/dashboard/instamojo/store', [InstamojoController::class, 'store'])->name('payment.setup.instamojo.store');
