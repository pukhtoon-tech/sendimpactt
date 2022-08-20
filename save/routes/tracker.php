<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailTrackerController;

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


Route::group(['middleware' => ['auth', 'email.verified','installed', 'saas.user.restriction']],function() {

    Route::get('/tracker/emails', [EmailTrackerController::class, 'index'])->name('tracker.emails.index');
    Route::get('/tracker/campaign/{id}', [EmailTrackerController::class, 'campaign'])->name('tracker.campaign'); // img src tracker

});

Route::get('/tracker/emails/store', [EmailTrackerController::class, 'store'])->name('tracker.emails.store'); // img src tracker


