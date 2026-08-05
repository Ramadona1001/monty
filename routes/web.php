<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/'.config('locales.default', 'en'));

Route::prefix('{locale}')
    ->whereIn('locale', config('locales.supported', ['en']))
    ->middleware('locale')
    ->group(function (): void {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/about', [PageController::class, 'about'])->name('about');
        Route::get('/services', [PageController::class, 'services'])->name('services');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::post('/contact', [ContactMessageController::class, 'store'])
            ->middleware('throttle:5,1')
            ->name('contact.store');
    });

Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');
