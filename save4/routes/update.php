<?php

use App\Http\Controllers\AutoUpdateController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed']], function () {
    Route::get('/software/update', [AutoUpdateController::class, 'index'])
        ->name('auto.update.index');

    Route::get('/software/is-on-fire', [AutoUpdateController::class, 'lets_update_the_monster'])
        ->name('auto.update.fire');
});
