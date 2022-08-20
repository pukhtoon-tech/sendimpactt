<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\HowToConfigController;

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




Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']],function() {

    /**
     * TEMPLETE BUILDER
     */

    Route::get('/sms-builder', [SmsController::class, 'builder'])
        ->name('builder.sms.create');

    Route::any('/sms-builder/store', [SmsController::class, 'builder_store'])
        ->name('builder.sms.store');

    Route::get('/sms-builder/templates', [SmsController::class, 'templates'])
        ->name('builder.sms.templates');

    Route::get('/sms-builder/template/show/{id}', [SmsController::class, 'show'])
        ->name('builder.sms.template.show');

    Route::get('/sms-builder/template/edit/{id}', [SmsController::class, 'edit'])
        ->name('builder.sms.template.edit');

    Route::any('/sms-builder/template/update/{id}', [SmsController::class, 'update'])
        ->name('builder.sms.template.update');

    Route::get('/sms-builder/template/delete/{id}', [SmsController::class, 'destroy'])
        ->name('builder.sms.template.destroy');

    /**
    * SMS
    */
    
    Route::get('/sms/configure', [SmsController::class, 'index'])
        ->name('sms.index');
    Route::get('/sms/configure/{sms}', [SmsController::class, 'configure'])
        ->name('sms.configure');
    Route::any('/sms/configure/{sms}/store', [SmsController::class, 'store'])
        ->name('sms.configure.store');
    Route::any('/sms/configure/{sms}/set-default', [SmsController::class, 'set_default'])
        ->name('sms.configure.default');
    Route::get('/sms/test-connection/{sms}', [SmsController::class, 'test'])
        ->name('sms.connection.test');

    /**
     * LOGS
     */

    Route::get('/sms/logs', [SmsController::class, 'smsLogs'])
        ->name('log.sms');

    Route::get('/sms/logs/infobip', [SmsController::class, 'infobipLogs'])
        ->name('log.sms.infobip');

    /**
     * CAMPAIGN SMS
     */
    
    Route::get('/campaign/send-sms/campaign-{campaign_id}/{sms_template_id}/{gateway}', [SmsController::class, 'campaignSendSms'])
        ->name('campaign.send.sms');
    
    Route::get('/campaign/sms-template/ajax', [SmsController::class, 'smsCampaignAjax'])
        ->name('sms.campaign.ajax');


    /**
     * VIBER
     */

    Route::post('/viber/new/scenario', [SmsController::class, 'viberScenario'])
        ->name('viber.new.scenario');

    /**
     * WHATSAPP
     */

    Route::post('/whatsapp/new/scenario', [SmsController::class, 'whatsappScenario'])
        ->name('whatsapp.new.scenario');

    /**
     * HOW TO CONFIG
     */

    Route::get('/how/to/config/{provider}', [HowToConfigController::class, 'index'])
        ->name('config.doc');
});