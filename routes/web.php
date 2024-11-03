<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DictionaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (config('app.demo_mode', false)) {
        return redirect('/admin');
    }

    return view('home');
})->name('home');

Route::controller(ArticleController::class)
    ->name('articles.')
    ->prefix('articles')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{article:slug}', 'show')->name('show');
    });

Route::controller(DictionaryController::class)
    ->name('dictionaries.')
    ->prefix('dictionaries')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{dictionary:slug}', 'show')->name('show');
    });

Route::post('mass-active', [\App\MoonShine\Controllers\ArticleController::class, 'massActive'])
    ->name('moonshine.articles.mass-active');
