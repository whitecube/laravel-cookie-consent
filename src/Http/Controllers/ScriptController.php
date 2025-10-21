<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ScriptController
{
    public function __invoke()
    {
        $content = str_replace('{config:1}', $this->generateConfig(), file_get_contents(LCC_ROOT . '/dist/cookies.js'));
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
}
