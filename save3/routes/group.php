<?php

use App\Http\Controllers\EmailGroupController;
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
    Route::get('/group', [EmailGroupController::class, 'index'])
        ->name('group.index');

    Route::get('/group/create', [EmailGroupController::class, 'create'])
        ->name('group.create');

    Route::get('/group/create/{type}', [EmailGroupController::class, 'createGroup'])
        ->name('group.create.type');

    Route::any('/group/create/step1/store', [EmailGroupController::class, 'step1Store'])
        ->name('group.store.step1');

    Route::any('/group/emails/store', [EmailGroupController::class, 'emailsStore'])
        ->name('group.emails.store');

    Route::get('/group/emails/destroy/{id}', [EmailGroupController::class, 'destroy'])
        ->name('group.emails.destroy');

    Route::get('/group/show/{id}', [EmailGroupController::class, 'show'])
        ->name('group.show');

    Route::get('/group/edit/{id}', [EmailGroupController::class, 'edit'])
        ->name('group.edit');

    Route::any('/group/update/{id}', [EmailGroupController::class, 'update'])
        ->name('group.update');

    Route::any('/group/add/all/contacts', [EmailGroupController::class, 'add_all_contacts'])
        ->name('group.add.all.contacts');
});
