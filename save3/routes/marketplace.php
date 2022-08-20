<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']], function () {
    Route::get('/marketplace/dashboard', [MarketplaceController::class, 'index'])->name('marketplace.index')->middleware('can:Admin');

    Route::post('/csv-upload', [MarketplaceController::class, 'csv_upload'])->name('marketplace.csv_upload')->middleware('can:Admin');

    Route::post('/csv-update/{country_code}', [MarketplaceController::class, 'csv_update'])->name('marketplace.csv_update')->middleware('can:Admin');

    Route::get('/csv/downlaoad/{country_code}', [MarketplaceController::class, 'csv_downlaoad'])->name('marketplace.csv.download');

    Route::get('/csv/destroy/{country_code}', [MarketplaceController::class, 'csv_destroy'])->name('marketplace.csv.destroy')->middleware('can:Admin');

    Route::post('/csv-settings', [MarketplaceController::class, 'csv_settings'])->name('marketplace.csv_settings')->middleware('can:Admin');
    Route::post('/csv-settings-update/{country_code}', [MarketplaceController::class, 'csv_settings_update'])->name('marketplace.csv_settings.update')->middleware('can:Admin');

    Route::get('/marketplace/buyers', [MarketplaceController::class, 'marketplace_buyers'])->name('marketplace.buyers')->middleware('can:Admin');

    Route::get('/marketplace/send-file-to-buyer/{sale_id}', [MarketplaceController::class, 'marketplace_send_file_to_buyer'])->name('marketplace.send.file.to.buyer');
});

// FRONTEND
    Route::get('/marketplace', [MarketplaceController::class, 'frontend_index'])->name('marketplace.frontend');
    Route::get('/marketplace/get/country-csv/value', [MarketplaceController::class, 'get_country_csv'])->name('marketplace.get.country.csv');
    Route::get('/marketplace/payment', [MarketplaceController::class, 'marketplace_payment'])->name('marketplace.payment');

    // PayPal
    Route::any('/marketplace/paypal', [MarketplaceController::class, 'postPaymentWithpaypalMarketplace'])->name('postPaymentWithpaypalMarketplace');
    Route::get('/marketplace/paypal', [MarketplaceController::class, 'getPaymentStatusMarketplace'])->name('getPaymentStatusMarketplace');

    // Stripe
    Route::get('/marketplace/stripe-payment/interface', [MarketplaceController::class, 'getPaymentWithStripe'])
        ->name('getPaymentWithStripe.marketplace');

    Route::post('/marketplace/stripe-payment', [MarketplaceController::class, 'handlePost'])
            ->name('stripe.payment.marketplace');

    // CSV Viewer Online
    Route::get('/csv-viewer-online', [MarketplaceController::class, 'csv_viewer'])->name('marketplace.csv.viewer');
