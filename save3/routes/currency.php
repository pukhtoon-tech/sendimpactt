<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed']], function () {
    //Currency Setting
    Route::get('currency', [CurrencyController::class, 'index'])->name('currencies.index')->middleware('can:Admin');
    Route::get('currency/create', [CurrencyController::class, 'create'])->name('currencies.create')->middleware('can:Admin');
    Route::any('currency/store', [CurrencyController::class, 'store'])->name('currencies.store')->middleware('can:Admin');
    Route::get('currency/delete/{id}', [CurrencyController::class, 'destroy'])->name('currencies.destroy')->middleware('can:Admin');
    Route::get('currency/edit/{id}', [CurrencyController::class, 'edit'])->name('currencies.edit')->middleware('can:Admin');
    Route::any('currency/update/{id}', [CurrencyController::class, 'update'])->name('currencies.update')->middleware('can:Admin');
    Route::get('currency/published', [CurrencyController::class, 'published'])->name('currencies.published')->middleware('can:Admin');
    Route::get('currency/align', [CurrencyController::class, 'alignment'])->name('currencies.align')->middleware('can:Admin');
    Route::any('currency/change', [CurrencyController::class, 'change'])->name('currencies.change');
});
