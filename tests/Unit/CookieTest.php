<?php

use Whitecube\LaravelCookieConsent\Cookie;

it('can set name', function () {
    $cookie = new Cookie();
    
    expect($cookie->name('foo'))->toBe($cookie);
    expect($cookie->name)->toBe('foo');
});

it('can set duration', function () {
    $cookie = new Cookie();
    
    expect($cookie->duration(10))->toBe($cookie);
    expect($cookie->duration)->toBe(10);
});

it('can set custom attributes', function () {
    $cookie = new Cookie();

    $cookie->title = 'foo';

    expect($cookie->label('bar'))->toBe($cookie);

    $attributes = $cookie->getAttributes();
    expect($attributes['title'] ?? null)->toBe('foo');
    expect($attributes['label'] ?? null)->toBe('bar');
});