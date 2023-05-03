<?php

use Whitecube\LaravelCookieConsent\Concerns\HasAttributes;

it('can magically set & get an attribute', function () {
    $instance = new class() {
        use HasAttributes;
    };

    $instance->foo = 'bar';

    expect($instance->foo)->toBe('bar');
    expect($instance->undefined)->toBeNull();
});

it('can methodolically set & get an attribute', function () {
    $instance = new class() {
        use HasAttributes;
    };

    $instance->setAttribute('foo', 'bar');

    expect($instance->getAttribute('foo'))->toBe('bar');
    expect($instance->getAttribute('undefined'))->toBeNull();
});

it('can set & get all attributes', function () {
    $instance = new class() {
        use HasAttributes;
    };

    $instance->setAttributes(['foo' => 'bar']);

    expect($results = $instance->getAttributes())->toBeArray();
    expect($results['foo'])->toBe('bar');
});
