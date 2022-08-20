<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']], function () {
    Route::get('/mail/activities', [MailLogController::class, 'index'])->name('mail.activity.index');
    Route::get('/mail/logs', [MailLogController::class, 'logs'])->name('mail.log.index');

    // version 2.1
    Route::get('/campaign/logs/{id}/delete', [CampaignLogController::class, 'destroy'])->name('logs.campaign.email.destroy');
    Route::get('/sms/logs/{id}/delete', [CampaignLogController::class, 'smsDestroy'])->name('logs.campaign.sms.destroy');
    Route::get('/email/logs/{id}/delete', [CampaignLogController::class, 'emailDestroy'])->name('logs.email.destroy');
    Route::get('/email/bounce/logs/{id}/delete', [CampaignLogController::class, 'bounceEmailDestroy'])->name('logs.bounce.email.destroy');
    // version 2.1::END
});
