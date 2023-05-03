<?php

namespace Whitecube\LaravelCookieConsent;

class AnalyticCookiesCategory extends CookiesCategory
{
    /**
     * Define Google Analytics cookies all at once.
     */
    public function google(string $id): static
    {
        $this->group(function(CookiesGroup $group) use ($id) {
            // TODO : configure consent callback correctly.
            $group->accepted(fn() => '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $id . '"></script><script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag(\'js\', new Date());gtag(\'config\', \'' . $id . '\');</script>')
                ->cookie(fn(Cookie $cookie) => $cookie->name('_ga')->duration(2 * 365 * 24 * 60 * 60))
                ->cookie(fn(Cookie $cookie) => $cookie->name('_ga_' . strtoupper($id))->duration(2 * 365 * 24 * 60 * 60));
        });

        return $this;
    }
}
