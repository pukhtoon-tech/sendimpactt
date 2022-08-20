<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']], function () {

    /**
     * QUEUE COUNT
     */
    Route::get('/queue/count', function () {
        return queueCount();
    })->name('queue.count');

    /**
     * TOTAL MAIL COUNT
     */
    Route::get('/total/mail/count', function () {
        return emailCount();
    })->name('total.mail.count');

    /**
     * TOTAL CAMPAIGN COUNT
     */
    Route::get('/total/campaign/count', function () {
        return campaignCount();
    })->name('total.campaign.count');

    /**
     * TOTAL GROUP COUNT
     */
    Route::get('/total/group/count', function () {
        return emailGroupCount();
    })->name('total.group.count');

    /**
     * TOTAL TEMPLATE COUNT
     */
    Route::get('/total/template/count', function () {
        return templateCount();
    })->name('total.template.count');

    /**
     * TOTAL SENT MAIL COUNT
     */
    Route::get('/total/sent/mail/count', function () {
        return totalSentMail();
    })->name('total.sent.mail.count');

    /**
     * TOTAL REACH COUNT
     */
    Route::get('/total/reach/count', function () {
        return mailReach();
    })->name('total.reach.count');

    /**
     * TOTAL NOTREACH COUNT
     */
    Route::get('/total/notreach/count', function () {
        return mailNoReach();
    })->name('total.notreach.count');

    /**
     * TOTAL FAILED COUNT
     */
    Route::get('/total/failed/count', function () {
        return failedJobs();
    })->name('total.failed.count');

    /**
     * TOTAL BOUNCED COUNT
     */
    Route::get('/total/bounced/count', function () {
        return mailBounced();
    })->name('total.bounced.count');

    /**
     * TOTAL TASKS COUNT
     */
    Route::get('/total/tasks/count', function () {
        return totalTasks();
    })->name('total.tasks.count');
});
