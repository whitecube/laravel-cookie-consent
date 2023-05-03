<?php

use Whitecube\LaravelCookieConsent\Concerns\HasConsentCallback;

it('can define a consent callback', function () {
    $instance = new class() {
        use HasConsentCallback;
    };

    expect($instance->hasConsentCallback())->toBeFalse();
    $instance->accepted(fn() => true);
    expect($instance->hasConsentCallback())->toBeTrue();
});
