<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ScriptController
{

    public function getCookieScript()
    {
        $content = str_replace('{config:1}', $this->generateConfig(), file_get_contents(LCC_ROOT . '/dist/cookies.js'));
        return response($content)->header('Content-Type', 'application/javascript');
    }

    public function getModalScript(Request $request)
    {
        $locale = $request->query('locale', app()->getLocale());
        app()->setLocale($locale);

        $content = str_replace('{translations:1}', $this->getTranslations(), file_get_contents(LCC_ROOT . '/dist/modal.js'));

        return response($content)->header('Content-Type', 'application/javascript');
    }

    protected function generateConfig(): string
    {
        return json_encode([
            'accept.all' => route('cookieconsent.accept.all'),
            'accept.essentials' => route('cookieconsent.accept.essentials'),
            'accept.configuration' => route('cookieconsent.accept.configuration'),
            'reset' => route('cookieconsent.reset'),
        ]);
    }

    protected function getTranslations(): string
    {
        return json_encode(__('cookieConsent::cookies.details'));
    }
}
