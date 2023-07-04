<?php

use Whitecube\LaravelCookieConsent\Cookie;
use Whitecube\LaravelCookieConsent\CookiesGroup;
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

it('can register and start cookie configuration from cookie method', function () {
    $category = new CookiesCategory('foo');

    expect($category->name('foo-cookie'))->toBeInstanceOf(Cookie::class);
});

it('can register a cookies group', function () {
    $category = new CookiesCategory('foo');

    expect($category->group(fn(CookiesGroup $group) => $group))->toBe($category);

    $results = $category->getDefined();
    expect($results)->toHaveLength(1);
});

it('can return all defined cookies', function () {
    $category = new CookiesCategory('foo');
    $category->cookie(new Cookie());
    $category->cookie(new Cookie());

    $results = $category->getCookies();
    expect($results)->toHaveLength(2);
});
