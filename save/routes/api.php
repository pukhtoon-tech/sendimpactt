<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TemplateBuilderApiController;
use Illuminate\Support\Str;
use Auth;
use App\Http\Controllers\API\SmtpController;
use App\Http\Controllers\ApiKeyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('smtp/providers', SmtpController::class);


/**
 * VERSION 5.3.0::STARTS
 */

Route::group(['middleware' => ['check.api']],function() {
    
    // contacts
    Route::get('/contacts', [ApiKeyController::class, 'get_contacts'])->name('api.contacts');
    Route::post('/store/contact', [ApiKeyController::class, 'store_contacts'])->name('api.store.contacts');

    // campaigns
    Route::get('/campaigns', [ApiKeyController::class, 'get_campaigns'])->name('api.campaigns');
    Route::post('/add-emails-to-campaign', [ApiKeyController::class, 'add_emails_to_campaign'])->name('api.add_emails_to_campaign');
    Route::post('/add-mobiles-to-campaign', [ApiKeyController::class, 'add_mobiles_to_campaign'])->name('api.add_mobiles_to_campaign');

    // start campaign
    Route::get('/campaign/send-email', [ApiKeyController::class, 'campaign_send_email'])->name('api.campaign_send_email');
    Route::post('/campaign/schedule-email', [ApiKeyController::class, 'campaign_schedule_email'])->name('api.campaign_schedule_email');
    Route::post('/campaign/schedule-destroy', [ApiKeyController::class, 'campaign_schedule_destroy'])->name('api.campaign_schedule_destroy');

    // subscribe form
    Route::post('/campaign/subscribe-form', [ApiKeyController::class, 'campaign_subscribe_form'])->name('api.campaign_subscribe_form');

});

/**
 * VERSION 5.3.0::ENDS
 */