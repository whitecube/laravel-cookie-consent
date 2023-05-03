<?php

use Whitecube\LaravelCookieConsent\CookiesRegistrar;
use Whitecube\LaravelCookieConsent\CookiesCategory;

it('can create and access consent categories', function () {
    $registrar = new CookiesRegistrar();

    expect($operational = $registrar->operational())->toBeInstanceOf(CookiesCategory::class);
    expect($operational->key())->toBe('operational');

    // TODO : update specific class expectancy 
    expect($analytics = $registrar->analytics())->toBeInstanceOf(CookiesCategory::class);
    expect($analytics->key())->toBe('analytics');

    expect($optional = $registrar->optional())->toBeInstanceOf(CookiesCategory::class);
    expect($optional->key())->toBe('optional');
});

it('can create and access custom consent categories', function () {
    $registrar = new CookiesRegistrar();

    $result = $registrar->category('simple');
    expect($result)->toBe($registrar);
    expect($simple = $registrar->simple())->toBeInstanceOf(CookiesCategory::class);
    expect($simple->key())->toBe('simple');

    $result = $registrar->category('with-key', fn(string $key) => new CookiesCategory($key));
    expect($result)->toBe($registrar);
    expect($withKey = $registrar->withKey())->toBeInstanceOf(CookiesCategory::class);
    expect($withKey->key())->toBe('with-key');

    $result = $registrar->category('with-instance', fn(CookiesCategory $category) => $category);
    expect($result)->toBe($registrar);
    expect($withInstance = $registrar->withInstance())->toBeInstanceOf(CookiesCategory::class);
    expect($withInstance->key())->toBe('with-instance');
});

it('cannot return an undefined consent category', function() {
    $registrar = new CookiesRegistrar();
    $registrar->custom();
})->throws(\BadMethodCallException::class);

it('can return all defined consent categories', function() {
    $registrar = new CookiesRegistrar();
    $registrar->operational();
    $registrar->category('custom');
    $registrar->analytics();

    $results = $registrar->getCategories();
    expect($results)->toHaveLength(3);
    expect($results[0]->key())->toBe('operational');
    expect($results[1]->key())->toBe('custom');
    expect($results[2]->key())->toBe('analytics');
});
