<?php

namespace Whitecube\LaravelCookieConsent;

class AnalyticCookiesCategory extends CookiesCategory
{
    const GOOGLE_ANALYTICS = 'ga';
    const GOOGLE_TAG_MANAGER = 'gtm';

    protected function getGroupCookies($group, $name, $id)
    {
        $key = str_starts_with($id, 'G-') ? substr($id, 2) : $id;

        return $group->name($name)
            ->cookie(fn(Cookie $cookie) => $cookie->name('_ga')
                ->duration(2 * 365 * 24 * 60)
                ->description(__('cookieConsent::cookies.defaults._ga'))
            )
            ->cookie(fn(Cookie $cookie) => $cookie->name('_ga_' . strtoupper($key))
                ->duration(2 * 365 * 24 * 60)
                ->description(__('cookieConsent::cookies.defaults._ga_ID'))
            )
            ->cookie(fn(Cookie $cookie) => $cookie->name('_gid')
                ->duration(24 * 60)
                ->description(__('cookieConsent::cookies.defaults._gid'))
            )
            ->cookie(fn(Cookie $cookie) => $cookie->name('_gat')
                ->duration(1)
                ->description(__('cookieConsent::cookies.defaults._gat'))
            );
    }

    /**
     * Define Google Analytics cookies all at once.
     */
    public function google(string $id, bool $anonymizeIp = true): static
    {
        $this->group(function (CookiesGroup $group) use ($anonymizeIp, $id) {
            $anonymizeIp = $anonymizeIp === true ? 'true' : 'false';

            $this->getGroupCookies(group: $group, name: static::GOOGLE_ANALYTICS, id: $id)
                ->accepted(fn(Consent $consent) => $consent
                    ->script('<script async src="https://www.googletagmanager.com/gtag/js?id=' . $id . '"></script>')
                    ->script(
                        '<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag(\'js\',new Date());gtag(\'config\',\'' . $id . '\', {\'anonymize_ip\':' . $anonymizeIp . '});</script>'
                    )
                );
        });

        return $this;
    }

    public function gtm(string $id): static
    {
        $consentSettings = config('cookieconsent.gtm_consent', [
            'ad_user_data',
            'ad_personalization',
            'ad_storage',
            'analytics_storage',
        ]);
        $consentSettings = array_fill_keys($consentSettings, 'granted');

        $consentJson = json_encode($consentSettings, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $this->group(function (CookiesGroup $group) use ($consentJson, $id) {
            $this->getGroupCookies(group: $group, name: static::GOOGLE_TAG_MANAGER, id: $id)
                ->accepted(fn(Consent $consent) => $consent
                    ->script('<script async src="https://www.googletagmanager.com/gtag/js?id=' . $id . '"></script>')
                    ->script(
                    '<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=\'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);})(window,document,\'script\',\'dataLayer\',\''. $id .'\');</script>'
                    )
                    ->script(
                        '<script>function loadGoogleTagManagerScript() {window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);} gtag(\'consent\', \'update\', ' . $consentJson . ');} loadGoogleTagManagerScript()</script>'
                    )
                );
        });


        return $this;
    }
}
