<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | URL configuration
    |--------------------------------------------------------------------------
    |
    | These values determine the package's API route URLs. Both values are
    | nullable and represent the same concepts as Laravel's routing parameters.
    |
    */

    'url' => [
        'domain' => null,
        'middleware' => [],
        'prefix' => 'cookie-consent',
    ],

    /*
    |--------------------------------------------------------------------------
    | Consent cookie configuration
    |--------------------------------------------------------------------------
    |
    | In order to keep track of the user's preferences, this package stores
    | an anonymized cookie. You do not need to register this cookie in the
    | package's cookie manager as it is done automatically (under "essentials").
    |
    | The duration parameter represents the cookie's lifetime in minutes.
    |
    | The domain parameter, when defined, determines the cookie's activity domain.
    | For multiple sub-domains, prefix your domain with "." (eg: ".mydomain.com").
    |
    */

    'cookie' => [
        'name' => Str::slug(env('APP_NAME', 'laravel'), '_').'_cookie_consent',
        'duration' => (60 * 24 * 365),
        'domain' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Legal page configuration
    |--------------------------------------------------------------------------
    |
    | Most cookie notices display a link to a dedicated page explaining
    | the extended cookies usage policy. If your application has such a page
    | you can add its route name here.
    |
    */

    'policy' => null,

    /* Google Analytics configuration
    |--------------------------------------------------------------------------
    |
    | If you use Google Analytics, you can configure the package to automatically
    | load the Google Analytics script when the user gives his consent.
    |
    | The ID parameter is required and represents your Google Analytics ID.
    |
    | The anonymize parameter is optional and determines whether the user's IP
    | address should be anonymized before being sent to Google Analytics.
    |
    */
    'google_analytics' => [
        'id' => env('GOOGLE_ANALYTICS_ID', ""),
        'anonymize_ip' => env('GOOGLE_ANALYTICS_ANONYMIZE_IP', true)
    ],

];
