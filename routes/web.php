<?php

use Illuminate\Support\Facades\Route;
use Whitecube\LaravelCookieConsent\Http\Controllers\ResetController;
use Whitecube\LaravelCookieConsent\Http\Controllers\ScriptController;
use Whitecube\LaravelCookieConsent\Http\Controllers\AcceptAllController;
use Whitecube\LaravelCookieConsent\Http\Controllers\ConfigureController;
use Whitecube\LaravelCookieConsent\Http\Controllers\AcceptEssentialsController;

Route::group([
    'as' => 'cookieconsent.',
    'domain' => config('cookieconsent.url.domain'),
    'prefix' => config('cookieconsent.url.prefix'),
    'middleware' => config('cookieconsent.url.middleware')
], function() {
    Route::get('cookies.js', [ScriptController::class, 'getCookieScript'])
        ->name('script.cookie');

    Route::get('modal.js', [ScriptController::class, 'getModalScript'])
        ->name('script.modal');

    Route::post('accept-all', AcceptAllController::class)
        ->name('accept.all');

    Route::post('accept-essentials', AcceptEssentialsController::class)
        ->name('accept.essentials');

    Route::post('configure', ConfigureController::class)
        ->name('accept.configuration');

    Route::post('reset', ResetController::class)
        ->name('reset');
});
