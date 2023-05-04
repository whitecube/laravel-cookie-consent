# Laravel Cookie Consent

Under the [EU’s GDPR](http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm#section_2), cookies that are not strictly necessary for the basic function of your website must only be activated after your end-users have given their explicit consent to the specific purpose of their operation and collection of personal data. Despite some crazy arbitrary requirements decided by non-technical lawmakers, overall **this is a good thing** since it pushes our profession to a more respectful and user-friendly direction. More and more non-EU citizens are expecting websites to ask for their consent, potentially including your website's target audience too.

Let's face it, most of the time you _could_ find alternatives for services using cookies. The most common case being Analytics tools, such as Google Analytics, which can easily be replaced by tools such as :

- [Fathom](https://usefathom.com/): built by some fellow Laravel community members!
- [Plausible](https://plausible.io/): made and hosted in the EU.
- [Pirsch](https://pirsch.io/): made and hosted in the EU (Germany).
- ... want to add a useful competitor to this list? Open an issue!

The main advantage of using these alternatives is that you could avoid asking for explicit consent altogether since you would not use any cookies that aren't strictly necessary, which is and will always be the most appreciated and accessible method.

Nevertheless, this package provides all the tools you'll need to cover a proper EU-compliant cookies policy:

- Cookies registration & configuration
- Blade views & translation files for consent alerts & pop-ups
- Blade directives & Facade methods making your life easier
- JavaScript code that will enhance front-end user experience

As always, we've built this package with flexibility in our mind: you'll be able to customize content, behavior and styling as you wish.

## Installation

```bash
composer require whitecube/laravel-cookie-consent
```

This package will auto-register its service provider.

## Usage

First, let's publish the package's files:

1. Publish the assets: `php artisan vendor:publish --tag=laravel-cookie-consent-assets`
2. Publish the views: `php artisan vendor:publish --tag=laravel-cookie-consent-views`

More on view customization below.

Now, we'll have to register and configure the used cookies. A good place to do so is in the `App\Providers\AppServiceProvider`'s `boot` method, but feel free to create your own `CookiesServiceProvider`.

```php
use Whitecube\LaravelCookieConsent\Facades\Cookies;

public function boot()
{
    Cookies::operational()
        ->session()
        ->csrf();

    Cookies::analytics()
        ->google(env('GOOGLE_ANALYTICS_ID'));

    Cookies::optional()->name('my_cookie')->duration(120);
}
```

More details on the available cookie registration methods below.

We can now add the consent scripts and modals to the application's layouts or views using the following blade directives:

- `@cookieconsentscripts`: used to add the package's default JavaScript and any third-party script you need to get the end-user's consent for.
- `@cookieconsentview`: used to render the alert or pop-up view.

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... -->
    @cookieconsentscripts
</head>
<body>
    <!-- ... -->
    @cookieconsentview
</body>
</html>
```

### Registering cookies

TBD.

### Views customization

TBD.

## 🔥 Sponsorships 

If you are reliant on this package in your production applications, consider [sponsoring us](https://github.com/sponsors/whitecube)! It is the best way to help us keep doing what we love to do: making great open source software.

## Contributing

Feel free to suggest changes, ask for new features or fix bugs yourself. We're sure there are still a lot of improvements that could be made, and we would be very happy to merge useful pull requests. Thanks!

## Made with ❤️ for open source

At [Whitecube](https://www.whitecube.be) we use a lot of open source software as part of our daily work.
So when we have an opportunity to give something back, we're super excited!

We hope you will enjoy this small contribution from us and would love to [hear from you](mailto:hello@whitecube.be) if you find it useful in your projects. Follow us on [Twitter](https://twitter.com/whitecube_be) for more updates!