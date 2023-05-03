<?php

use Whitecube\LaravelCookieConsent\Cookie;
use Whitecube\LaravelCookieConsent\CookiesCategory;

it('can create and access category key', function () {
    $category = new CookiesCategory('foo');
    expect($category->key())->toBe('foo');
});

it('can set custom attributes', function () {
    $category = new CookiesCategory('foo');
    $category->title = 'foo';

    $attributes = $category->getAttributes();
    expect($attributes['title'] ?? null)->toBe('foo');
});

it('can register a cookie instance', function () {
    $category = new CookiesCategory('foo');

    expect($category->register(new Cookie()))->toBe($category);
});

it('can register and start cookie configuration from cookie method', function () {
    $category = new CookiesCategory('foo');

    expect($category->name('foo-cookie'))->toBeInstanceOf(Cookie::class);
});

it('can return all defined cookies', function () {
    $category = new CookiesCategory('foo');
    $category->register(new Cookie());
    $category->register(new Cookie());

    $results = $category->getCookies();
    expect($results)->toHaveLength(2);
});
