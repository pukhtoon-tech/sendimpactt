<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['installed', 'saas.user.restriction']], function () {
    Route::get('/stripe-payment/interface', [StripeController::class, 'getPaymentWithStripe'])
        ->name('getPaymentWithStripe');

    Route::post('/stripe-payment', [StripeController::class, 'handlePost'])
        ->name('stripe.payment');
});
