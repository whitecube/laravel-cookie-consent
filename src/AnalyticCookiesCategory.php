<?php

namespace Whitecube\LaravelCookieConsent;

class AnalyticCookiesCategory extends CookiesCategory
{
    const GOOGLE_ANALYTICS = 'ga';

    /**
     * Define Google Analytics cookies all at once.
     */
    public function google(string $id, bool $anonymizeIp = true): static
    {
        $this->group(function (CookiesGroup $group) use ($anonymizeIp, $id) {
            $key = str_starts_with($id, 'G-') ? substr($id, 2) : $id;
            $anonymizeIp = $anonymizeIp === true ? 'true' : false;

            $group->name(static::GOOGLE_ANALYTICS)
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
                )
                ->accepted(fn(Consent $consent) => $consent
                    ->script('<script async src="https://www.googletagmanager.com/gtag/js?id=' . $id . '"></script>')
                    ->script(
                        '<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag(\'js\',new Date());gtag(\'config\',\'' . $id . '\', {\'anonymize_ip\':' . $anonymizeIp . '});</script>'
                    )
                );
        });

        return $this;
    }
}
