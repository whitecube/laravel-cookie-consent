<?php

use Whitecube\LaravelCookieConsent\CookiesGroup;
use Whitecube\LaravelCookieConsent\AnalyticCookiesCategory;

it('can register Google Analytics configuration', function () {
    $category = new AnalyticCookiesCategory('foo');

    expect($category->google('g-foo'))->toBe($category);
    expect($group = ($category->getDefined()[0] ?? null))->toBeInstanceOf(CookiesGroup::class);

    expect($group->hasConsentCallback())->toBeTrue();
    expect($group->getCookies())->toHaveLength(4);
});
