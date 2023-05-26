<?php

use Illuminate\Support\Facades\Route;
use Whitecube\LaravelCookieConsent\Http\Controllers\AcceptAllController;
use Whitecube\LaravelCookieConsent\Http\Controllers\AcceptEssentialsController;
use Whitecube\LaravelCookieConsent\Http\Controllers\ConfigureController;
use Whitecube\LaravelCookieConsent\Http\Controllers\ResetController;

Route::group([
    'as' => 'cookieconsent.',
    'prefix' => 'cookie-consent', // TODO : add config file
    // TODO : add 'domain' => '' config
], function() {
    Route::post('accept-all', AcceptAllController::class)
        ->name('accept.all');

    Route::post('accept-essentials', AcceptEssentialsController::class)
        ->name('accept.essentials');

    Route::post('configure', ConfigureController::class)
        ->name('accept.configuration');

    Route::post('reset', ResetController::class)
        ->name('reset');
});
