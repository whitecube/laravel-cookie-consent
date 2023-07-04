<?php

use Whitecube\LaravelCookieConsent\CookiesRegistrar;
use Whitecube\LaravelCookieConsent\CookiesCategory;
use Whitecube\LaravelCookieConsent\EssentialCookiesCategory;
use Whitecube\LaravelCookieConsent\AnalyticCookiesCategory;

it('can create and access consent categories', function () {
    $registrar = new CookiesRegistrar();

    expect($essentials = $registrar->essentials())->toBeInstanceOf(EssentialCookiesCategory::class);
    expect($essentials->key())->toBe('essentials');

    expect($analytics = $registrar->analytics())->toBeInstanceOf(AnalyticCookiesCategory::class);
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
    $registrar->essentials();
    $registrar->category('custom');
    $registrar->analytics();

    $results = $registrar->getCategories();
    expect($results)->toHaveLength(3);
    expect($results[0]->key())->toBe('essentials');
    expect($results[1]->key())->toBe('custom');
    expect($results[2]->key())->toBe('analytics');
});
