<?php

use Whitecube\LaravelCookieConsent\Cookie;
use Whitecube\LaravelCookieConsent\EssentialCookiesCategory;
use Illuminate\Support\Facades\Config;

it('can register consent cookie', function () {
    Config::shouldReceive('get')->with('app.locale')->andReturn('en');
    Config::shouldReceive('get')->with('app.fallback_locale')->andReturn('en');
    Config::shouldReceive('get')->with('database.default')->andReturn('test');
    Config::shouldReceive('get')->with('database.connections.test')->andReturn(null);
    Config::shouldReceive('get')->once()->with('cookieconsent.cookie.name')->andReturn('foo_consent');
    Config::shouldReceive('get')->once()->with('cookieconsent.cookie.duration')->andReturn(365 * 24 * 60);

    $category = new EssentialCookiesCategory('foo');

    expect($category->consent())->toBe($category);
    expect($cookie = ($category->getCookies()[0] ?? null))->toBeInstanceOf(Cookie::class);
    expect($cookie->name)->toBe('foo_consent');
    expect($cookie->duration)->toBe(365 * 24 * 60);
});

it('can register session cookie', function () {
    Config::shouldReceive('get')->with('app.locale')->andReturn('en');
    Config::shouldReceive('get')->with('app.fallback_locale')->andReturn('en');
    Config::shouldReceive('get')->with('database.default')->andReturn('test');
    Config::shouldReceive('get')->with('database.connections.test')->andReturn(null);
    Config::shouldReceive('get')->once()->with('session.cookie')->andReturn('foo_session');
    Config::shouldReceive('get')->once()->with('session.lifetime')->andReturn(120);

    $category = new EssentialCookiesCategory('foo');

    expect($category->session())->toBe($category);
    expect($cookie = ($category->getCookies()[0] ?? null))->toBeInstanceOf(Cookie::class);
    expect($cookie->name)->toBe('foo_session');
    expect($cookie->duration)->toBe(120);
});

it('can register csrf cookie', function () {
    Config::shouldReceive('get')->with('app.locale')->andReturn('en');
    Config::shouldReceive('get')->with('app.fallback_locale')->andReturn('en');
    Config::shouldReceive('get')->with('database.default')->andReturn('test');
    Config::shouldReceive('get')->with('database.connections.test')->andReturn(null);
    Config::shouldReceive('get')->once()->with('session.lifetime')->andReturn(120);

    $category = new EssentialCookiesCategory('foo');

    expect($category->csrf())->toBe($category);
    expect($cookie = ($category->getCookies()[0] ?? null))->toBeInstanceOf(Cookie::class);
    expect($cookie->name)->toBe('XSRF-TOKEN');
    expect($cookie->duration)->toBe(120);
});
