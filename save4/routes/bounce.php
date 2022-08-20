<?php

use App\Http\Controllers\BouncedController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth', 'email.verified', 'saas.user.restriction']], function () {
    Route::get('/bounced/email', [BouncedController::class, 'index'])->name('bounce.emails');
    Route::get('/bounced/check', [BouncedController::class, 'check'])->name('bounce.check');
    Route::get('/bounced/checker', [BouncedController::class, 'checker'])->name('bounce.checker');
});
