<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'email.verified', 'installed']], function () {

    /**
     * Backend
     */
    Route::prefix('dashboard')->group(function () {
        Route::get('/blogs', [BlogController::class, 'index'])->name('dashboard.blog.index');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('dashboard.blog.create');
        Route::get('/blog/final/create/{id}', [BlogController::class, 'final_create'])->name('dashboard.blog.final_create');
        Route::post('/blog/store', [BlogController::class, 'store'])->name('dashboard.blog.store');
        Route::any('/blog/editor/store/{id}/{slug}', [BlogController::class, 'editor_store_update'])->name('dashboard.blog.editorjs.storeorupdate');
        Route::get('/blog/{id}/{slug}', [BlogController::class, 'show'])->name('dashboard.blog.show');
        Route::post('/blog/{id}/{slug}/update', [BlogController::class, 'update'])->name('dashboard.blog.update');
        Route::get('/blog/{id}/{slug}/destroy', [BlogController::class, 'destroy'])->name('dashboard.blog.destroy');
    });
});

/**
 * Frontend
 */
Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'frontend_index'])->name('frontend.blog.index');
    Route::get('/{id}/{slug}', [BlogController::class, 'frontend_show'])->name('frontend.blog.show');
});
