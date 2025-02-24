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

We've built this package with flexibility in our mind: you'll be able to customize content, behavior and styling as you wish. Here is what it looks like out of the box:

![Laravel Cookie Consent in action](https://raw.githubusercontent.com/whitecube/laravel-cookie-consent/main/laravel-cookie-consent.gif)

## Table of contents

1. [Installation](#installation)
2. [Usage](#usage)
3. [Registering cookies](#registering-cookies)
    - [Choosing a cookie category](#choosing-a-cookie-category)
    - [Cookie definition](#cookie-definition)
4. [Checking for consent](#checking-for-consent)
    - [Using the Cookies facade](#using-the-cookies-facade)
    - [Using dependency injection](#using-dependency-injection)
5. [Customization](#customization)
    - [The views](#the-views)
    - [Styling](#styling)
    - [Javascript](#javascript)
    - [Textual content and translations](#textual-content-and-translations)
6. [A few useful tips](#a-few-useful-tips)
    - [Cookie Policy Details Page](#cookie-policy-details-page)
    - [Let your users change their mind](#let-your-users-change-their-mind)
    - [Storing user preferences for multiple sub-domains](#storing-user-preferences-for-multiple-sub-domains)
    - [Keep it accessible](#keep-it-accessible)

## Installation

```bash
composer require whitecube/laravel-cookie-consent
```

This package will auto-register its service provider.

## Usage

First, publish the package's files:

1. Publish the `CookiesServiceProvider` file: `php artisan vendor:publish --tag=laravel-cookie-consent-service-provider`
2. Register the Service Provider in your application. For applications using Laravel 9 or 10, add the Service Provider to the `providers` array in `config/app.php`:
    ```php
    'providers' => ServiceProvider::defaultProviders()->merge([
        // ...
        App\Providers\RouteServiceProvider::class,
        // IMPORTANT: add the following line AFTER "App\Providers\RouteServiceProvider::class,"
        App\Providers\CookiesServiceProvider::class,
    ])->toArray(),
    ```

    For applications running Laravel 11 and above, add the Service Provider to the array in `bootstrap/providers.php`:
    ```php
    return [
        App\Providers\AppServiceProvider::class,
        App\Providers\CookiesServiceProvider::class,
    ];
    ```
3. Publish the configuration file: `php artisan vendor:publish --tag=laravel-cookie-consent-config`

If you want to customize the consent modal's views:

1. Publish the customizable views: `php artisan vendor:publish --tag=laravel-cookie-consent-views`
2. Publish the translation files: `php artisan vendor:publish --tag=laravel-cookie-consent-lang`

More on [customization](#customization) below.

Now, we'll have to register and configure the used cookies in the freshly published `App\Providers\CookiesServiceProvider::registerCookies()` method:

```php
namespace App\Providers;

use Whitecube\LaravelCookieConsent\Consent;
use Whitecube\LaravelCookieConsent\Facades\Cookies;
use Whitecube\LaravelCookieConsent\CookiesServiceProvider as ServiceProvider;

class CookiesServiceProvider extends ServiceProvider
{
    /**
     * Define the cookies users should be aware of.
     */
    protected function registerCookies(): void
    {
        if (app()->environment() === 'production') {
            // Register Laravel's base cookies under the "required" cookies section:
            Cookies::essentials()
                ->session()
                ->csrf();
    
            // Register all Analytics cookies at once using one single shorthand method:
            Cookies::analytics()
                ->google(
                    id: env('GOOGLE_ANALYTICS_ID')
                    anonymizeIp: env('GOOGLE_ANALYTICS_ANONYMIZE_IP')
                );
        
            // Register custom cookies under the pre-existing "optional" category:
            Cookies::optional()
                ->name('darkmode_enabled')
                ->description('This cookie helps us remember your preferences regarding the interface\'s brightness.')
                ->duration(120)
                ->accepted(fn(Consent $consent, MyDarkmode $darkmode) => $consent->cookie(value: $darkmode->getDefaultValue()));
        }
    }
}
```

More details on the available [cookie registration](#registering-cookies) methods below.

Then, let's add consent scripts and modals to the application's views using the following blade directives:

- `@cookieconsentscripts`: used to add the package's default JavaScript and any third-party scripts you need to get the end-user's consent for.
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

## Registering cookies

This package aims to centralize cookie declaration and documentation at the same place in order to keep projects maintainable. However, the suggested methodology is not mandatory. If you wish to queue cookies or execute code upon consent somewhere else in your app's codebase, feel free to do so: we have a few available methods that can come in handy when you'll need to [check if consent has been granted](#checking-for-consent) during the request's lifecycle.

### Choosing a cookie category

All registered cookies are attached to a Cookie Category, which is a convenient way to group cookies under similar topics. The aimed objective is to add usability to the detailed information views by providing understandable and summarized sections.

Instead of consenting each cookie individually, users grant consent to those categories. All cookies included in such a consented category will automatically be considered as given explicit consent to.

There are 3 base categories included in this package:

1. `Cookies::essentials()`: lists all cookies that add required functionality to the app. This category cannot be opted-out and automatically contains the package's consent cookie.
    - `Cookies::essentials()->session()`: registers Laravel's "session" cookie (defined in your app's `session.cookie` configuration) ;
    - `Cookies::essentials()->csrf()`: registers [Laravel's "XSRF-TOKEN"](https://laravel.com/docs/10.x/csrf) cookie.
2. `Cookies::analytics()`: lists all cookies used for statistics and data collection.
    - `Cookies::analytics()->google(string $trackingId, bool $anonymizeIp)`: automatically lists all Google Analytics' cookies. **This will also automatically register Google Analytics' JS scripts and inject them to the layout's `<head>` only when consent is granted.** Convenient, huh?
3. `Cookies::optional()`: lists all cookies that serve some kind of utility feature. Since this category can ben opted-out, linked features should always check if consent has been granted before queuing or relying on their cookies.

You are free to add as many custom categories as you want. To do so, simply call the `category(string $key, ?Closure $maker = null)` method on the `Cookies` facade:

```php
use Whitecube\LaravelCookieConsent\Facades\Cookies;

$category = Cookies::category(key: 'my-custom-category');
```

The optional second parameter, `Closure $maker`, can be used to define a custom `CookiesCategory` instance:

```php
use Whitecube\LaravelCookieConsent\Facades\Cookies;

$category = Cookies::category(key: 'my-custom-category', maker: function(string $key) {
    return new MyCustomCategory($key);
});
```

Custom category classes should extend `Whitecube\LaravelCookieConsent\CookiesCategory`.

Once defined, custom categories can be accessed using their own camel-case method:

```php
use Whitecube\LaravelCookieConsent\Facades\Cookies;

$category = Cookies::myCustomCategory();
```

In order to add human-readable titles and descriptions to categories, you should insert new lines to the `cookieConsent::cookies.categories.[category-key]` translations. More information on [translations](#textual-content-and-translations) below.

```php
return [
    // ...
    'categories' => [
        // ...
        'my-custom-category' => [
            'title' => 'My custom category of cookies',
            'description' => 'A short description of what these cookies are meant for.',
        ],
        // ...
    ],
];
```

### Cookie definition

Once a category has been targetted, you can start defining cookies in it using the following methods:

```php
Cookies::essentials()               // Targetting a category
    ->name('darkmode_enabled')      // Defining a cookie
    ->description('Lorem ipsum')    // Adding the cookie's description for display
    ->duration(120);                // Adding the cookie's lifetime in minutes
```

Using these methods you'll have to define each cookie by calling a category each time. For convenience it is also possible to chain cookie definitions using the chainable `cookie(Closure|Cookie $cookie)` method:

```php
use Whitecube\LaravelCookieConsent\Cookie;

Cookies::essentials()               // Targetting a category
    ->cookie(function(Cookie $cookie) {
        $cookie->name('darkmode_enabled')       // Defining a cookie
            ->description('Lorem ipsum')        // Adding the cookie's description for display
            ->duration(120);                    // Adding the cookie's lifetime in minutes
    })
    ->cookie(function(Cookie $cookie) {
        $cookie->name('high_contrast_enabled')  // Defining a cookie
            ->description('Lorem ipsum')        // Adding the cookie's description for display
            ->duration(60 * 24 * 365);          // Adding the cookie's lifetime in minutes
    });
```

#### `name(string $name)`

Required. Defines the cookie name. It is used for display and as the actual cookie "key" when setting the cookie.

#### `description(string $description)`

Optional. Adds a textual description for the cookie. It is used for display only.

#### `duration(int $minutes)`

Required. Defines the cookie's lifetime in minutes. It is used for display and for the actual cookie expiration date when setting the cookie.

#### `accepted(Closure $callback)`

The optional "accepted" callback gets invoked when consent is granted to the category a cookie is attached to. This happens once the user configures their cookie preferences but also each time an incoming request is handled afterwards.

The callback receives at least one parameter, `Consent $consent`, which is an object used to configure consent output:

- `script(string $tag)`: defines a script tag that will be added to the layout's `<head>` only when consent has been granted ;
- `cookie(string $value, ?string $path = null, ?string $domain = null, ?bool $secure = null, bool $httpOnly = true, bool $raw = false, ?string $sameSite = null)`: defines a cookie that will be added to the response when consent has been granted. Note that it doesn't need a name and a duration anymore since those settings have already been defined using the `name()` and `duration()` methods described above.

```php
use Whitecube\LaravelCookieConsent\Consent;

$cookie->accepted(function(Consent $consent) {
    $consent->cookie(value: 'off')->script('<script src="' . asset('js/darkmode.js') . '"></script>');
});
```

Other parameters can be type-hinted and will be resolved by Laravel's Service Container:

```php
use App\Services\MyDependencyService;
use Whitecube\LaravelCookieConsent\Consent;

$cookie->accepted(function(Consent $consent, MyDependencyService $service) {
    $consent->script($service->getScriptTag());
});
```

#### Custom cookie attributes

When building your own cookie notice designs, you might need extra attributes on the `Cookie` instances. We've got you covered!

```php
$cookie->color = 'warning';

echo $cookie->color; // "warning"
```

Behind the scenes, these magic attributes use the `setAttribute` and `getAttribute` methods:

```php
$cookie->setAttribute('icon', 'brightness');

echo $cookie->getAttribute('icon'); // "brightness"
```

But since all other cookie definition methods are chainable, you can also call custom attributes as chainable methods:

```php
$cookie->subtitle('Darkmode preferences')->checkmark(true);

echo $cookie->subtitle; // "brightness"
echo $cookie->checkmark ? 'on' : 'off'; // "on"
```

## Checking for consent

There are several ways to check for explicit user consent, each of them being useful in different contexts.

### Using the `Cookies` facade

The `Cookies` facade is automatically discovered when installing this package.

```php
use Whitecube\LaravelCookieConsent\Facades\Cookies;

if(Cookies::hasConsentFor('my_cookie_name')) {
    // ...
}
```

### Using dependency injection

Useful when working with methods resolved by Laravel's Service Container:

```php
use Whitecube\LaravelCookieConsent\CookiesManager;

class FooController
{
    public function __invoke(CookiesManager $cookies)
    {
        if($cookies->hasConsentFor('my_cookie_name')) {
            // ...
        }
    }
}
```

## Customization

Cookie notices are boring and this package's default design is no different. It has been built in a robust, accessible and neutral way so it could serve as many situations as possible.

However, this world shouldn't be a boring place and even if cookie notices are part of a project's legal requirements, why not use it as an opportunity to bring a smile to your audience's face? Cookie modals are now integrated in every digital platform's user experience and therefore they should blend in accordingly: that's why we've built this package with full flexibility in our mind.

### The views

A good starting point is to take a look at this package's default markup. If not already published, you can access the views using `php artisan vendor:publish --tag=laravel-cookie-consent-views`, this will copy our blade files to your app's `resources/views/vendor/cookie-consent` directory.

Here you can express your unlimited creativity and push the boundaries of conventionnal Cookie notices or popups. 

When rendered, the view has access to these variables:

- `$policy`: the URL to your app's Cookie Policy page when defined. To do so, take a look at the package's `cookieconsent.php` configuration file.
- `$cookies`: the registered cookie categories with their attached cookie definitions.

In order to add buttons, we'd recommend using the package's `@cookieconsentbutton()` blade directive:

- `@cookieconsentbutton('accept.all')`: renders a button targetting this package's "consent to all cookies" API route ;
- `@cookieconsentbutton('accept.essentials')`: renders a button targetting this package's "consent to essential cookies only" API route ;
- `@cookieconsentbutton('accept.configuration')`: renders a button targetting this package's "consent to custom cookies selection" API route. Beware that this route requires the selected cookie categories as the request's payload ;
- `@cookieconsentbutton('reset')`: renders a button targetting this package's "reset cookie configuration" API route.

### Styling

As you probably noticed, we've included our design's CSS directly in the `cookies.blade.php` view using a `<style>` tag. You can move, remove or replace it if needed. In fact, we'd recommend adding your own styles using a proper CSS file loaded in the layout's `<head>` using a `<link>` tag or by adding Tailwind classes to the HTML markup.

Our CSS is compiled from a SASS file included in this package's `resources/scss` directory. If that fits your workflow, feel free to use it as a starting point for your own implementation.

### Javascript

Keep in mind that cookie notices are supposed to work when Javascript is disabled. This package's base design only uses Javascript as an extra layer for a smoother User Experience, but its features do not rely on it. 

Since most implementations have the same needs, we've separated our Javascript code into two parts: 

1. A reusable Javascript library: automatically loaded via the `@cookieconsentscripts` blade directive, it is used to perform AJAX requests (using Axios) for all the existing API routes:
    - `LaravelCookieConsent.acceptAll()`
    - `LaravelCookieConsent.acceptEssentials()`
    - `LaravelCookieConsent.configure(data)`
    - `LaravelCookieConsent.reset()`
2. A script implementing said library for our base design. Like our basic styling tag, this script is directly included in the `cookies.blade.php` view using a `<script>` tag. Feel free to remove it and add your own interactivity logic.

### Textual content and translations

Most of the displayed strings are defined in the `cookieConsent::cookies` translation files. The package ships with a few supported locales, but if yours is not yet included we would greatly appreciate a PR.

If not already published, you can edit or fill the translation files using `php artisan vendor:publish --tag=laravel-cookie-consent-lang`, this will copy our translation files to your app's `vendor/cookieConsent` "lang" path.

## A few useful tips

> **Disclaimer**: We are not lawyers. Always check with your legal partners which rules may apply to your project.

### Cookie Policy Details Page

Your website will need a dedicated "Cookie Policy" page containing extensive information about cookies, how and why they're used, etc. These pages also explain in detail which cookies are included. In order to keep these pages automatically up-to-date, keep in mind that this package can be used anywhere in your application using the `Whitecube\LaravelCookieConsent\Facades\Cookies` facade:

```blade
<h1>Cookie Policy</h1>

<p>...</p>

<h2>How do we use cookies?</h2>

@foreach(Cookies::getCategories() as $category)
<table>
    <caption>{{ $category->title }}</caption>
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

A side note on `Carbon\CarbonInterval`'s `cascade` method: when working with years, some unexpected results could appear. By default, the `CarbonInterval` "year" factor will return 336 days instead of 365. It is possible to change this by defining your own factors (for instance in `App\Providers\AppServiceProvider`):

```php
$factors = \Carbon\CarbonInterval::getCascadeFactors();
$factors['years'] = [365, 'dayz'];
\Carbon\CarbonInterval::setCascadeFactors($factors);
```

More information on CarbonInterval's gotchas in [Constantin's blog post on chasingcode.dev](https://chasingcode.dev/blog/carbon-php-practical-examples/).

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

### Storing user preferences for multiple sub-domains

By default, this package will store the user's preferences for the current domain. If you wish to prompt for consent only once and keep the user's choice across multiple sub-domains, you'll have to configure the `cookieconsent.cookie.domain` setting (located in `config/cookieconsent.php`) as follows:

```php
'cookie' => [
    // ...
    'domain' => '.mydomain.com', // notice the leading "."
],
```

### Injecting the cookies inside a legal page

To provide detailed cookie information within a legal page, such as a terms of service or privacy policy page, you can inject a formatted table listing cookie names, descriptions, and durations. 

This can be done using the `@cookieconsentinfo` Blade directive, or you can place the directive directly within a WYSIWYG editor and later replace it using the following method:
```blade
{!! Cookies::replaceInfoTag($wysiwyg) !!}
```
This will automatically generate and insert the required cookie information, ensuring your legal documentation remains up-to-date and compliant.


### Keep it accessible

When defining your own views & styles, keep in mind that cookie notices are obstacles for the application's overall accessibility. Also, they should work even when JavaScript is not enabled, that's why this package mainly works using API routes and AJAX calls in order to enhance user experience.

---

## Development roadmap

We have a few ideas to further improve this package in the future. If you wish to add useful features, feel free to open a PR or an issue on this repository.

- Add a `reset` callback on the Cookies definition instances in order to handle consent withdrawal ;
- Add blade conditions for easier consent and feature availability checking.

## 🔥 Sponsorships 

If you are reliant on this package in your production applications, consider [sponsoring us](https://github.com/sponsors/whitecube)! It is the best way to help us keep doing what we love to do: making great open source software.

## Contributing

Feel free to suggest changes, ask for new features or fix bugs yourself. We're sure there are still a lot of improvements that could be made, and we would be very happy to merge useful pull requests. Thanks!

## Made with ❤️ for open source

At [Whitecube](https://www.whitecube.be) we use a lot of open source software as part of our daily work.
So when we have an opportunity to give something back, we're super excited!

We hope you will enjoy this small contribution from us and would love to [hear from you](mailto:hello@whitecube.be) if you find it useful in your projects. Follow us on [Twitter](https://twitter.com/whitecube_be) for more updates!
