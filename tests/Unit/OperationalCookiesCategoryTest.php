<?php

use Whitecube\LaravelCookieConsent\Cookie;
use Whitecube\LaravelCookieConsent\OperationalCookiesCategory;
use Illuminate\Support\Facades\Config;

it('can register session cookie', function () {
    Config::shouldReceive('get')->once()->with('session.cookie')->andReturn('foo_session');
    Config::shouldReceive('get')->once()->with('session.lifetime')->andReturn(120);

    $category = new OperationalCookiesCategory('foo');

    expect($category->session())->toBe($category);
    expect($cookie = ($category->getCookies()[0] ?? null))->toBeInstanceOf(Cookie::class);
    expect($cookie->name)->toBe('foo_session');
    expect($cookie->duration)->toBe(120);
});

it('can register csrf cookie', function () {
    Config::shouldReceive('get')->once()->with('session.lifetime')->andReturn(120);

    $category = new OperationalCookiesCategory('foo');

    expect($category->csrf())->toBe($category);
    expect($cookie = ($category->getCookies()[0] ?? null))->toBeInstanceOf(Cookie::class);
    expect($cookie->name)->toBe('XSRF-TOKEN');
    expect($cookie->duration)->toBe(120);
});
