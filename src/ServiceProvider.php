<?php

namespace Whitecube\LaravelCookieConsent;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__ . '/../dist') => public_path('vendor/laravel-cookie-consent'),
        ], 'laravel-cookie-consent-assets');

        $this->loadViewsFrom(
            realpath(__DIR__ . '/../resources/views'), 'cookie-consent'
        );

        $this->publishes([
            realpath(__DIR__ . '/../resources/views') => resource_path('views/vendor/cookie-consent'),
        ], 'laravel-cookie-consent-views');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'cookieConsent');

        $this->publishes([
            realpath(__DIR__ . '/../resources/lang') => $this->app->langPath('vendor/cookieConsent'),
        ], 'laravel-cookie-consent-lang');

        $this->registerBladeDirectives();

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(CookiesRegistrar::class, function () {
            return new CookiesRegistrar();
        });
    }

    /**
     * Define the cookie-consent blade directives.
     */
    protected function registerBladeDirectives()
    {
        Blade::directive('cookieconsentscripts', function (string $expression) {
            return '<?php echo ' . Facades\Cookies::class . '::renderScripts(' . $expression . '); ?>';
        });

        Blade::directive('cookieconsentview', function (string $expression) {
            return '<?php echo ' . Facades\Cookies::class . '::renderView(); ?>';
        });

        Blade::directive('cookieconsentbutton', function (string $expression) {
            return '<?php echo ' . Facades\Cookies::class . '::renderButton(' . $expression . '); ?>';
        });
    }
}