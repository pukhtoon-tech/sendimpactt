<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailContactController;
use Auth;


Route::group(['middleware' => ['auth', 'email.verified', 'installed', 'saas.user.restriction']],function() {

    /**
     * EMAIL List
     */

    Route::any('/email-contacts/store', [EmailContactController::class, 'store'])
        ->name('email.contact.store')->middleware('saas.expiry');

    Route::get('/email-contacts/show/{id}', [EmailContactController::class, 'show'])
        ->name('email.contact.show');

    Route::any('/email-contacts/update/{id}', [EmailContactController::class, 'update'])
        ->name('email.contact.update');

    Route::get('/contacts/list', [EmailContactController::class, 'index'])
        ->name('email.contacts.index');

    Route::get('/email/list', [EmailContactController::class, 'emailList'])
        ->name('email.contacts.list');

    Route::get('/phone/list', [EmailContactController::class, 'phoneList'])
        ->name('phone.contacts.list');

    Route::get('/email-contacts/emails', [EmailContactController::class, 'emails'])
        ->name('email.contacts.emails');

    Route::get('/email-contacts/favourite', [EmailContactController::class, 'favourite'])
        ->name('email.contacts.favourite');

    Route::get('/email-contacts/blocked', [EmailContactController::class, 'blocked'])
        ->name('email.contacts.blocked');

    Route::get('/email-contacts/trashed', [EmailContactController::class, 'trashedBin'])
        ->name('email.contacts.trashed');

    Route::any('/email-contacts/destroy-all', [EmailContactController::class, 'destroyAll'])
        ->name('email.contacts.destroy.all');

    Route::get('/email-contacts/destroy/{id}', [EmailContactController::class, 'destroy'])
        ->name('email.contact.destroy');

    Route::any('/email-contacts/blacklist-all', [EmailContactController::class, 'blacklistAll'])
        ->name('email.contacts.blacklist.all');

    Route::any('/email-contacts/favourite-all', [EmailContactController::class, 'favouriteAll'])
        ->name('email.contacts.favourite.all');

    Route::any('/email-contacts/permanent-delete-all', [EmailContactController::class, 'permanentDestroyAll'])
        ->name('email.contacts.permanent.destroy.all');

    Route::any('/email-contacts/restore-all', [EmailContactController::class, 'restoreAll'])
        ->name('email.contacts.restore.all');

    Route::any('/email-contacts/unblock-all', [EmailContactController::class, 'unblockAll'])
        ->name('email.contacts.unblock.all');

    Route::any('/email-contacts/dislike-all', [EmailContactController::class, 'dislikeAll'])
        ->name('email.contacts.dislike.all');

    Route::get('/email-contacts/search', [EmailContactController::class, 'mailSearch'])
        ->name('email.contacts.search');

    Route::any('/email-contacts/send-email', [EmailContactController::class, 'sendEmail'])
        ->name('email.contacts.send.email');

    Route::get('/email-contacts/export', [EmailContactController::class, 'emailExport'])
        ->name('email.contacts.export');

    Route::get('/email-contacts/bulk/csv', [EmailContactController::class, 'bulkCsv'])
        ->name('email.contacts.bulk.csv');

    Route::post('/email-contacts/bulk/csv/import', [EmailContactController::class, 'importCsv'])
        ->name('bulk.import')->middleware('saas.expiry');

    Route::get('/email-contacts/bulk/csv/export', [EmailContactController::class, 'exportCsv'])
        ->name('bulk.export')->middleware('saas.expiry');

    Route::get('/email-contacts/bulk/csv/sample/csv', [EmailContactController::class, 'sampleCsv'])
        ->name('bulk.sample.csv');

    Route::get('/email-contacts/mark-as-read', [EmailContactController::class, 'markAsRead'])
        ->name('email.contacts.mark.as.read');

    /**PAGINATION */
    Route::get('/pagination/fetch_data', [EmailContactController::class, 'fetch_data'])
        ->name('email.contacts.fetch_data');

    });
