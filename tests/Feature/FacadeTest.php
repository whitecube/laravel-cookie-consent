<?php

use Whitecube\LaravelCookieConsent\CookiesRegistrar;
use Whitecube\LaravelCookieConsent\OperationalCookiesCategory;
use Whitecube\LaravelCookieConsent\Facades\Cookies;

it('transfers method calls to the registrar', function() {
    Cookies::operational()->csrf();
    Cookies::operational()->name('foo')->duration(120);

    expect($categories = app(CookiesRegistrar::class)->getCategories())->toHaveLength(1);
    expect($category = $categories[0])->toBeInstanceOf(OperationalCookiesCategory::class);
    expect($category->getCookies())->toHaveLength(2);
});
