<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class OrchestraTestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            \Whitecube\LaravelCookieConsent\ServiceProvider::class,
        ];
    }
}