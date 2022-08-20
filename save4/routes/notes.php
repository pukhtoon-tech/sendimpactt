<?php

use App\Http\Controllers\ImportantNoticeController;
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
    Route::get('/notes', [ImportantNoticeController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [ImportantNoticeController::class, 'create'])->name('notes.create')->middleware('can:Admin');
    Route::any('/notes/store', [ImportantNoticeController::class, 'store'])->name('notes.store')->middleware('can:Admin');
    Route::get('/notes/show/{id}', [ImportantNoticeController::class, 'show'])->name('notes.show');
    Route::get('/notes/delete/{id}', [ImportantNoticeController::class, 'delete'])->name('note.delete')->middleware('can:Admin');
    Route::get('/notes/edit/{id}', [ImportantNoticeController::class, 'edit'])->name('notes.edit')->middleware('can:Admin');
    Route::any('/notes/update/{id}', [ImportantNoticeController::class, 'update'])->name('notes.update')->middleware('can:Admin');
});
