<?php

use App\Http\Controllers\PayStackController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed']], function () {
    Route::get('/paystack', [PayStackController::class, 'index'])->name('paystack.index');
    Route::get('/paystack/store', [PayStackController::class, 'store'])->name('paystack.store');
});

Route::post('/paystack/pay', [PayStackController::class, 'redirectToGateway'])->name('paystack.pay');
Route::get('/paystack/callback', [PayStackController::class, 'handleGatewayCallback'])->name('paystack.callback');
