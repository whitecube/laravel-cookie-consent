<?php

use Whitecube\LaravelCookieConsent\Facades\Cookies;

it('serves the built consent script with configured endpoints', function() {
    $response = $this->get(route('cookieconsent.script'));

    $response->assertOk();
    $response->assertHeader('content-type', 'application/javascript');

    $script = $response->getContent();
    $config = [
        'accept.all' => route('cookieconsent.accept.all'),
        'accept.essentials' => route('cookieconsent.accept.essentials'),
        'accept.configuration' => route('cookieconsent.accept.configuration'),
        'reset' => route('cookieconsent.reset'),
    ];

    expect($script)
        ->toContain(json_encode($config))
        ->not->toContain('__LARAVEL_COOKIE_CONSENT_CONFIG__');

    foreach (['acceptAll', 'acceptEssentials', 'configure', 'reset'] as $method) {
        expect($script)->toContain($method);
    }
});

it('inlines the built script and stylesheet in the consent view', function() {
    $markup = Cookies::renderView();

    expect($markup)
        ->toContain('<script data-cookie-consent>')
        ->toContain(file_get_contents(LCC_ROOT . '/dist/script.js'))
        ->toContain('<style data-cookie-consent>')
        ->toContain(file_get_contents(LCC_ROOT . '/dist/style.css'));
});