<?php

use App\Http\Controllers\CampaignController;
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

    /**
     * CAMPAIGN
     */
    Route::get('/campaign', [CampaignController::class, 'index'])
        ->name('campaign.index');

    Route::get('/campaign/type/{type}', [CampaignController::class, 'type'])
        ->name('campaign.type');

    Route::get('/campaign/create', [CampaignController::class, 'create'])
        ->name('campaign.create');

    Route::get('/campaign/create/{type}', [CampaignController::class, 'createType'])
        ->name('campaign.create.type')->middleware('saas.expiry');

    Route::any('/campaign/create/step1/store', [CampaignController::class, 'step1Store'])
        ->name('campaign.store.step1')->middleware('saas.expiry');

    Route::get('/campaign/create/step2', [CampaignController::class, 'step2'])
        ->name('campaign.store2')->middleware('saas.expiry');

    Route::any('/campaign/create/step2/store', [CampaignController::class, 'step2Store'])
        ->name('campaign.store.store2')->middleware('saas.expiry');

    Route::get('/campaign/create/step3', [CampaignController::class, 'step3'])
        ->name('campaign.store3')->middleware('saas.expiry');

    Route::get('/campaign/emails', [CampaignController::class, 'emails'])
        ->name('campaign.emails');

    Route::any('/campaign/emails/store', [CampaignController::class, 'emailsStore'])
        ->name('campaign.emails.store');

    Route::get('/campaign/emails/destroy/{id}', [CampaignController::class, 'destroy'])
        ->name('campaign.emails.destroy');

    Route::get('/campaign/emails/edit/{id}', [CampaignController::class, 'edit'])
        ->name('campaign.emails.edit');

    Route::any('/campaign/emails/update/{id}', [CampaignController::class, 'update'])
        ->name('campaign.emails.update');

    Route::get('/campaign/send-email/campaign-{campaign_id}/template-{template_id}/', [CampaignController::class, 'campaignSendEmail'])
        ->name('campaign.send.email')->middleware(['saas.expiry', 'saas.email.limit.check']);

    // version 2.0
    Route::get('/campaign/schedule-email/campaign-{campaign_id}/template-{template_id}/', [CampaignController::class, 'scheduleSendEmail'])
        ->name('campaign.schedule.email')->middleware('saas.expiry');
    Route::post('/campaign/schedule-email/campaign-{campaign_id}/template-{template_id}/store', [CampaignController::class, 'scheduleSendEmailStore'])
        ->name('campaign.schedule.email.store')->middleware('saas.expiry');

    Route::get('/campaign/schedule-emails', [CampaignController::class, 'scheduleSendEmails'])
        ->name('campaign.schedule.emails');

    Route::get('/campaign/schedule-email/delete/{schedule_id}', [CampaignController::class, 'scheduleSendEmailDelete'])
        ->name('campaign.schedule.email.delete');

    Route::get('/campaign/schedule-email/edit/{schedule_id}', [CampaignController::class, 'scheduleSendEmailEdit'])
        ->name('campaign.schedule.email.edit');

    Route::post('/campaign/schedule-email/update/{schedule_id}', [CampaignController::class, 'scheduleSendEmailUpdate'])
        ->name('campaign.schedule.email.update');
    // version 2.0

    /**
     * version 4.2
     */
    Route::get('/campaign/email/contacts', [CampaignController::class, 'contactsEmails'])
        ->name('campaign.contacts.emails');
    Route::get('/campaign/email/contacts/edit/{id}', [CampaignController::class, 'contactsEmailsEdit'])
        ->name('campaign.contacts.emails.edit');
    Route::get('/campaign/email/contacts/fetch_data/edit/{id}', [CampaignController::class, 'contactsFetchDataEdit'])
        ->name('campaign.contacts.fetch_data.edit');
    Route::get('/campaign/email/contacts/fetch_data', [CampaignController::class, 'contactsFetchData'])
        ->name('campaign.contacts.fetch_data');

    Route::any('/campaign/sms/contacts', [CampaignController::class, 'contactsSMS'])
        ->name('campaign.contacts.sms');
    Route::get('/campaign/sms/contacts/edit/{id}', [CampaignController::class, 'contactsSMSEdit'])
        ->name('campaign.contacts.sms.edit');

    Route::get('/campaign/remove/pdf/{id}', [CampaignController::class, 'pdf_remove'])
        ->name('campaign.remove.pdf');
});

/**
 * VERSION 5.2.0
 */
Route::get('/campaign/email/contacts/unsubscribe/{campaign_id}/{email_id}', [CampaignController::class, 'contactsUnsubscribe'])
    ->name('campaign.contacts.unsubscribe');
