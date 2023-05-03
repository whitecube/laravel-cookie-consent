<?php

use Whitecube\LaravelCookieConsent\CookiesRegistrar;
use Whitecube\LaravelCookieConsent\OperationalCookiesCategory;

it('provides the cookies registrar singleton', function() {
    app(CookiesRegistrar::class)->operational()->csrf();

    expect($categories = app(CookiesRegistrar::class)->getCategories())->toHaveLength(1);
    expect($category = $categories[0])->toBeInstanceOf(OperationalCookiesCategory::class);
    expect($category->getCookies())->toHaveLength(1);
});