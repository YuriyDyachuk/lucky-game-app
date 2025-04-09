<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', [RegisterController::class, 'store'])->name('register.store');

Route::prefix('link')->group(function () {
    Route::middleware([\App\Http\Middleware\CheckValidLink::class])->prefix('{token}')->group(function () {
        Route::get('/', [LinkController::class, 'view'])->name('link.page');
        Route::post('/generate', [LinkController::class, 'generateNewLink'])->name('link.generateNew');
        Route::post('/deactivate', [LinkController::class, 'deactivateLink'])->name('link.deactivate');

        Route::post('/lucky', [LinkController::class, 'feelingLucky'])->name('link.lucky');
        Route::get('/history', [LinkController::class, 'history'])->name('link.history');
    });
});
