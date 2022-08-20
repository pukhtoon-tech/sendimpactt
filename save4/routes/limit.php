<?php

use App\Http\Controllers\UserRateLimitController;
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

Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']], function () {
    Route::any('/user/rate/limit/create', [UserRateLimitController::class, 'create'])
    ->middleware('can:Admin')
    ->name('limit.create');

    Route::get('/user/rate/limit', [UserRateLimitController::class, 'index'])
    ->middleware('can:Admin')
    ->name('limit.index');
    Route::get('/user/rate/manage/{id}', [UserRateLimitController::class, 'manage'])
    ->middleware('can:Admin')
    ->name('limit.manage');
    Route::any('/user/rate/update/{id}', [UserRateLimitController::class, 'update'])
    ->middleware('can:Admin')
    ->name('limit.update');

    Route::get('/user/rate/destroy/{id}', [UserRateLimitController::class, 'destroy'])
    ->middleware('can:Admin')
    ->name('limit.destroy');

    Route::get('/user/login/as/{id}', [UserRateLimitController::class, 'login_as'])
    ->middleware('can:Admin')
    ->name('login.as.customer');
});
