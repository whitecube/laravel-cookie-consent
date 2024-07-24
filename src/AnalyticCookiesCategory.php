<?php

namespace Whitecube\LaravelCookieConsent;

class AnalyticCookiesCategory extends CookiesCategory
{
    const GOOGLE_ANALYTICS = 'ga';
    const FACEBOOK_PIXEL = 'fbpx';

    /**
     * Define Google Analytics cookies all at once.
     */
    public function google(string $id): static
    {
        $this->group(function (CookiesGroup $group) use ($id) {
            $key = (strpos($id, 'G-') === 0) ? substr($id, 2) : $id;
            $group->name(static::GOOGLE_ANALYTICS)
                ->cookie(function (Cookie $cookie) {
                    $cookie->name('_ga')
                        ->duration(2 * 365 * 24 * 60)
                        ->description(__('cookieConsent::cookies.defaults._ga'));
                })
                ->cookie(function (Cookie $cookie) {
                    $cookie->name('_ga_' . strtoupper($key))
                        ->duration(2 * 365 * 24 * 60)
                        ->description(__('cookieConsent::cookies.defaults._ga_ID'));
                })
                ->cookie(function (Cookie $cookie) {
                    $cookie->name('_gid')
                        ->duration(24 * 60)
                        ->description(__('cookieConsent::cookies.defaults._gid'));
                })
                ->cookie(function (Cookie $cookie) {
                    $cookie->name('_gat')
                        ->duration(1)
                        ->description(__('cookieConsent::cookies.defaults._gat'));
                })
                ->accepted(function (Consent $consent) use ($id) {
                    $consent->script('<script async src="https://www.googletagmanager.com/gtag/js?id='.$id.'"></script>')
                        ->script('<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag(\'js\',new Date());gtag(\'config\',\''.$id.'\');</script>');
                });
        });

        return $this;
    }

    /**
     * Define the Meta Pixel (formerly Facebook Pixel) cookie.
     */
    public function facebook(string $key): static
    {
        return $this->cookie(function (Cookie $cookie) use ($key) {
            $cookie->name(static::FACEBOOK_PIXEL)
                ->duration(2 * 365 * 24 * 60)
                ->description(__('cookieConsent::cookies.defaults.fbpx'))
                ->accepted(function (Consent $consent) use ($key) {
                    $consent->script('<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,\'script\',\'https://connect.facebook.net/en_US/fbevents.js\');fbq(\'init\', \''.$key.'\');fbq(\'track\', \'PageView\');</script>');
                });
        });

        return $this;
    }
}
