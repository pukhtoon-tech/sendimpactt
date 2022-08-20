<?php

use App\Http\Controllers\KhaltiController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['installed', 'saas.user.restriction']], function () {
    Route::get('/khalti-payment/verfication', [KhaltiController::class, 'verficationKhalti'])
        ->name('getPaymentWithKhalti');

    Route::post('/khalti-payment', [KhaltiController::class, 'handlePost'])
        ->name('khalti.payment');
});
