<?php

use App\Http\Controllers\UserNotificationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']], function () {
    Route::get('notifications', [UserNotificationController::class, 'index'])->name('notifications.index');
});
