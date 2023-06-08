# Laravel Cookie Consent

> ✅ 100% GDPR compliant  
> ✅ Fully customizable  
> ✅ Works with and without JS

Under the [EU’s GDPR](http://ec.europa.eu/ipg/basics/legal/cookies/index_en.htm#section_2), cookies that are not strictly necessary for the basic function of your website must only be activated after your end-users have given their explicit consent to the specific purpose of their operation and collection of personal data. Despite some crazy arbitrary requirements decided by non-technical lawmakers, overall **this is a good thing** since it pushes our profession to a more respectful and user-friendly direction. More and more non-EU citizens are expecting websites to ask for their consent, potentially including your website's target audience too.

Let's face it, most of the time you _could_ use alternatives for services requiring cookie usage. The most common cases being analytics tools, such as Google Analytics, which can easily be replaced by:

- [Fathom](https://usefathom.com/): built by some fellow Laravel community members!
- [Plausible](https://plausible.io/): made and hosted in the EU.
- [Pirsch](https://pirsch.io/): made and hosted in the EU (Germany).
- ... want to add a useful competitor to this list? Open an issue!

The main advantage of using these alternatives is that you could avoid asking for explicit consent altogether since you would not use any cookies that aren't strictly necessary. This will always be better for your application's accessibility and user experience.

Nevertheless, this package provides all the tools you'll need to cover a proper EU-compliant cookies policy:

- Cookies registration & configuration
- Blade views & translation files for consent alerts & pop-ups
- Blade directives & Facade methods making your life easier
- JavaScript code that will enhance front-end user experience

We've built this package with flexibility in our mind: you'll be able to customize content, behavior and styling as you wish.

## Installation

```bash
composer require whitecube/laravel-cookie-consent
```

This package will auto-register its service provider.

## Usage

First, publish the package's files:

1. Publish the configuration file: `php artisan vendor:publish --tag=laravel-cookie-consent-config`
2. Publish the JavaScript library: `php artisan vendor:publish --tag=laravel-cookie-consent-assets`
3. Publish the customizable views: `php artisan vendor:publish --tag=laravel-cookie-consent-views`

More on customization below.

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

Then, let's add consent scripts and modals to the application's layouts or views using the following blade directives:

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

### Customizing views

TBD.

## A few useful tips

> **Disclaimer**: We are not lawyers. Always check with your legal partners which rules may apply to your project.

TBD.

### Cookie Policy Details Page

Your website will need a dedicated "Cookie Policy" page containing extensive information about cookies, how and why they're used, etc. These pages also explain in detail which cookies are included. In order to keep these pages automatically up-to-date, keep in mind that this package can be used anywhere in your application using the `Whitecube\LaravelCookieConsent\Facades\Cookies` facade:

```blade
<p>...</p>

@foreach(Cookies::getCategories() as $category)
<table>
    <caption>{{ $category->label }}</caption>
    <thead>
        <tr>
            <th>Cookie</th>
            <th>Description</th>
            <th>Duration</th>
        </tr>
    </thead>
    <tbody>
        @foreach($category->getCookies() as $cookie)
        <tr>
            <td>{{ $cookie->name }}</td>
            <td>{{ $cookie->description }}</td>
            <td>{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endforeach

<p>...</p>
```

### Let your users change their mind

Users should be able to change their consent settings at any time. No worries, with this package it is quite simple to achieve: generate a button that will reset the user's cookies and show the consent modal again.

```blade
@cookieconsentbutton('reset')
```

This will output a fully functional consent reset button. If you wish to customize it, you can pass it the following parameters:

```blade
@cookieconsentbutton(action: 'reset', label: 'Manage cookies', attributes: ['id' => 'reset-button', 'class' => 'btn'])
```

Or, for even more customization, you can change its template situated in `resources/views/vendor/cookie-consent/button.blade.php` (you'll have to publish the package's views first). Keep in mind that this template is used for all button components in this package, including the "Accept all", "Accept essentials" and "Save configuration" buttons.

If you're wondering why these buttons are wrapped in a `form` element: this way they'll work when JavaScript is disabled whilst preventing browser link prefetching.

### Store user preferences for multiple sub-domains

By default, this package will store the user's preferences for the current domain. If you wish to prompt for consent only once and keep the user's choice across multiple sub-domains, you'll have to configure the `cookieconsent.cookie.domain` setting (located in `config/cookieconsent.php`) as follows:

```php
'cookie' => [
    // ...
    'domain' => '.mydomain.com', // notice de leading "."
],
```

### Keep it accessible

When defining your own views & styles, keep in mind that cookie notices are obstacles for the application's overall accessibility. Also, they should work even when JavaScript is not enabled, that's why this package mainly works using API routes and AJAX calls in order to enhance user experience.

## 🔥 Sponsorships 

If you are reliant on this package in your production applications, consider [sponsoring us](https://github.com/sponsors/whitecube)! It is the best way to help us keep doing what we love to do: making great open source software.

## Contributing

Feel free to suggest changes, ask for new features or fix bugs yourself. We're sure there are still a lot of improvements that could be made, and we would be very happy to merge useful pull requests. Thanks!

## Made with ❤️ for open source

At [Whitecube](https://www.whitecube.be) we use a lot of open source software as part of our daily work.
So when we have an opportunity to give something back, we're super excited!

We hope you will enjoy this small contribution from us and would love to [hear from you](mailto:hello@whitecube.be) if you find it useful in your projects. Follow us on [Twitter](https://twitter.com/whitecube_be) for more updates!