<?php

use App\Http\Controllers\AutoresponderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']], function () {
    Route::get('/autoresponder', [AutoresponderController::class, 'index'])->name('autoresponder.index');

    Route::get('/autoresponder/create/step1', [AutoresponderController::class, 'create_step1'])->name('autoresponder.create_step1');
    Route::get('/autoresponder/builder', [AutoresponderController::class, 'autoresponder_builder'])->name('autoresponder.builder');
    Route::post('/autoresponder/builder/{autoresponder_id}/store', [AutoresponderController::class, 'store'])->name('autoresponder.store');

    Route::get('/autoresponder/edit/step1/{id}', [AutoresponderController::class, 'edit_step1'])->name('autoresponder.edit_step1');
    Route::get('/autoresponder/builder/update/{id}', [AutoresponderController::class, 'autoresponder_builder_edit'])->name('autoresponder.builder.edit');
    Route::post('/autoresponder/builder/{autoresponder_id}/update', [AutoresponderController::class, 'update'])->name('autoresponder.update');

    Route::get('/autoresponder/{autoresponder_id}/destroy', [AutoresponderController::class, 'destroy'])->name('autoresponder.destroy');
});
