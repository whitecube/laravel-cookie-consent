<?php

namespace App\Providers;

use Whitecube\LaravelCookieConsent\CookiesServiceProvider as ServiceProvider;
use Whitecube\LaravelCookieConsent\Facades\Cookies;

class CookiesServiceProvider extends ServiceProvider
{
    /**
     * Define the cookies users should be aware of.
     */
    protected function registerCookies(): void
    {
        // Register Laravel's base cookies under the "required" cookies section:
        Cookies::essentials()
            ->session()
            ->csrf();

        // Register all Analytics cookies at once using one single shorthand method:
        // Don't forget to change the config location to match your config file
        // Cookies::analytics()
        //    ->googleAnalytics(
        //         id: config('your_config.google_analytics.id'),
        //         anonymizeIp: config('your_config.google_analytics.anonymize_ip')
        //    );

        // Cookies::analytics()
        //    ->googleTagManager(
        //        id: config('your_config.google_tag_manager.id'),
        //        config: [
        //            'ad_user_data',
        //            'ad_personalization',
        //            'ad_storage',
        //            'analytics_storage',
        //        ]
        //    );

        // Register custom cookies under the pre-existing "optional" category:
        // Cookies::optional()
        //     ->name('darkmode_enabled')
        //     ->description('This cookie helps us remember your preferences regarding the interface\'s brightness.')
        //     ->duration(120)
        //     ->accepted(fn(Consent $consent, MyDarkmode $darkmode) => $consent->cookie(value: $darkmode->getDefaultValue()));
    }
}