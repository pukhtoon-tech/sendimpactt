<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ArgonContentController;
use App\Http\Controllers\SaaSController; //version 5.0.0


Route::group(['middleware' => 'installed'], function () {


Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

/**
 * SLIDER
 */
Route::get('/frontend/setup', [FrontendController::class, 'setup'])->name('frontend.setup');
Route::any('/frontend/store', [FrontendController::class, 'store'])->name('frontend.store');

/**
 * PAYMENT
 */

Route::get('payment/{id}/{plan}', [FrontendController::class, 'payment'])->name('frontend.payment');


/**
 * NEW SUBSCRIPTION
 */

 Route::get('subscribe/for/newsletter',[FrontendController::class, 'newSubscriber'])->name('new.subscription');

/**
 * ArgonContentController
 */

 Route::get('content/json/editor',[ArgonContentController::class, 'frontendJsonEditor'])->name('frontend.json.editor'); //version 4.3.0
 Route::any('content/json/upload',[ArgonContentController::class, 'frontendJsonupload'])->name('frontend.json.upload'); //version 4.3.0
 


/**
 * SAAS PAGES
 */

 Route::any('response/message/{message?}',[SaaSController::class, 'index'])->name('saas.response.index'); //version 5.0.0
 
/**
 * SAAS PAGES::ENDS
 */


});


