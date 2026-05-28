<?php

namespace Whitecube\LaravelCookieConsent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool shouldDisplayNotice()
 * @method static bool hasConsentFor(string $key)
 * @method static \Whitecube\LaravelCookieConsent\ConsentResponse accept(string|array $categories = '*')
 * @method static string renderScripts(bool $withDefault = true)
 * @method static string getNoticeScripts(bool $withDefault)
 * @method static string renderView()
 * @method static string getNoticeMarkup()
 * @method static string renderButton(string $action, ?string $label = null, array $attributes = [])
 * @method static string renderInfo()
 * @method static string replaceInfoTag(string $wysiwyg)
 * @method static \Whitecube\LaravelCookieConsent\EssentialCookiesCategory essentials()
 * @method static \Whitecube\LaravelCookieConsent\AnalyticCookiesCategory analytics()
 * @method static \Whitecube\LaravelCookieConsent\CookiesCategory optional()
 * @method static \Whitecube\LaravelCookieConsent\CookiesRegistrar category(string $key, ?\Closure $maker = null)
 * @method static array getCategories()
 * @method static bool hasCategory(string $key)
 *
 * @see \Whitecube\LaravelCookieConsent\CookiesManager
 * @see \Whitecube\LaravelCookieConsent\CookiesRegistrar
 */
class Cookies extends Facade
{
    public static function getFacadeAccessor()
    {
        return \Whitecube\LaravelCookieConsent\CookiesManager::class;
    }
}
