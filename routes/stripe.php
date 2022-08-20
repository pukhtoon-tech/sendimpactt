<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

Route::group(['middleware' => ['installed', 'saas.user.restriction']],function() {

Route::get('/stripe-payment/interface', [StripeController::class, 'getPaymentWithStripe'])
        ->name('getPaymentWithStripe');

Route::post('/stripe-payment', [StripeController::class, 'handlePost'])
        ->name('stripe.payment');
});
