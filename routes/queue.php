<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Auth;
use Artisan;
use App\Http\Controllers\QueueTrackerController;


Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']],function() {

    Route::get('/queue/work', [QueueTrackerController::class, 'queueWork'])->name('queue.work');
    Route::get('/queue/retry', [QueueTrackerController::class, 'queueRetry'])->name('queue.retry');
    
    Route::get('/queue/failed', [QueueTrackerController::class, 'queueFailed'])->name('queue.failed');
    Route::get('/queue/proccessed', [QueueTrackerController::class, 'queueProccessed'])->name('queue.proccessed');

});

// Queue Monitor

Route::prefix('jobs')->group(function () {
    Route::queueMonitor();
});
