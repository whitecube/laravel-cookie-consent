<?php

use Whitecube\LaravelCookieConsent\CookiesRegistrar;
use Whitecube\LaravelCookieConsent\EssentialCookiesCategory;
use Whitecube\LaravelCookieConsent\Facades\Cookies;

it('transfers method calls to the registrar', function() {
    Cookies::essentials()->csrf();
    Cookies::essentials()->name('foo')->duration(120);

    expect($categories = app(CookiesRegistrar::class)->getCategories())->toHaveLength(1);
    expect($category = $categories[0])->toBeInstanceOf(EssentialCookiesCategory::class);
    expect($category->getCookies())->toHaveLength(3);
});
