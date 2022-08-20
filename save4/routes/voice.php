<?php

use App\Http\Controllers\VoiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed']], function () {
    Route::get('/voice/servers', [VoiceController::class, 'index'])->name('twilio.voice.index');
    Route::post('/voice/server/store', [VoiceController::class, 'store'])->name('twilio.voice.store');
    Route::any('/test/call/{id}/{provider}', [VoiceController::class, 'initiateTestCall'])->name('test.initiate_call');
});
