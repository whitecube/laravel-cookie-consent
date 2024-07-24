<?php

namespace Whitecube\LaravelCookieConsent;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        if (!defined('LCC_ROOT')) {
            define('LCC_ROOT', realpath(__DIR__ . '/..'));
        }
        
        $this->mergeConfigFrom(LCC_ROOT.'/config/cookieconsent.php', 'cookieconsent');

        $this->app->singleton(CookiesRegistrar::class, function () {
            $registrar = new CookiesRegistrar();
            $registrar->essentials()->consent();
            return $registrar;
        });
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            LCC_ROOT.'/stubs/CookiesServiceProvider.php' => app_path('Providers/CookiesServiceProvider.php'),
        ], 'laravel-cookie-consent-service-provider');

        $this->publishes([
            LCC_ROOT.'/config/cookieconsent.php' => config_path('cookieconsent.php'),
        ], 'laravel-cookie-consent-config');

        $this->loadViewsFrom(
            LCC_ROOT.'/resources/views', 'cookie-consent'
        );

        $this->publishes([
            LCC_ROOT.'/resources/views' => resource_path('views/vendor/cookie-consent'),
        ], 'laravel-cookie-consent-views');

        $this->loadTranslationsFrom(LCC_ROOT.'/resources/lang', 'cookieConsent');

        $this->publishes([
            realpath(LCC_ROOT.'/resources/lang') => $this->app->langPath('vendor/cookieConsent'),
        ], 'laravel-cookie-consent-lang');

        $this->registerBladeDirectives();

        $this->loadRoutesFrom(LCC_ROOT.'/routes/web.php');
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

        Blade::directive('cookieconsentinfo', function () {
            return '<?php echo ' . Facades\Cookies::class . '::renderInfo(); ?>';
        });
    }
}
