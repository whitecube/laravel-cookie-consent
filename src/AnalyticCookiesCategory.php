<?php

namespace Whitecube\LaravelCookieConsent;

class AnalyticCookiesCategory extends CookiesCategory
{
    const GOOGLE_ANALYTICS = 'ga';

    /**
     * Define Google Analytics cookies all at once.
     */
    public function google(string $id): static
    {
        $this->group(function(CookiesGroup $group) use ($id) {
            $group->name(static::GOOGLE_ANALYTICS)
                ->cookie(fn(Cookie $cookie) => $cookie->name('_ga')->duration(2 * 365 * 24 * 60))
                ->cookie(fn(Cookie $cookie) => $cookie->name('_ga_' . strtoupper($id))->duration(2 * 365 * 24 * 60))
                ->accepted(function(Consent $consent) use ($id) {
                    $consent->script('<script async src="https://www.googletagmanager.com/gtag/js?id='.$id.'"></script>')
                        ->script('<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag(\'js\',new Date());gtag(\'config\',\''.$id.'\');</script>');
                });
        });

        return $this;
    }
}
