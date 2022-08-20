<?php

use App\Http\Controllers\CampaignLogController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']], function () {
    Route::get('/campaign/logs', [CampaignLogController::class, 'index'])->name('logs.campaign.index');
    Route::get('/campaign/logs/{id}', [CampaignLogController::class, 'getEmails'])->name('logs.campaign.emails');
});
