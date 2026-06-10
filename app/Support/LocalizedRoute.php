<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class LocalizedRoute
{
    public static function name(string $name): string
    {
        if (app()->getLocale() === 'en' && Route::has('en.'.$name)) {
            return 'en.'.$name;
        }

        return $name;
    }

    public static function route(string $name, mixed $parameters = [], bool $absolute = true): string
    {
        return route(self::name($name), $parameters, $absolute);
    }

    public static function url(?string $url, string $fallbackRoute = 'home'): string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return self::route($fallbackRoute);
        }

        if (
            Str::startsWith($url, 'http://')
            || Str::startsWith($url, 'https://')
            || Str::startsWith($url, 'mailto:')
            || Str::startsWith($url, 'tel:')
            || Str::startsWith($url, 'https://wa.me/')
            || Str::startsWith($url, 'http://wa.me/')
        ) {
            return self::localizeSameDomainUrl($url);
        }

        if (Str::startsWith($url, '#')) {
            return self::route('home').$url;
        }

        if (app()->getLocale() === 'en') {
            if ($url === '/en' || $url === 'en') {
                return url('/en');
            }

            if (Str::startsWith($url, '/en/')) {
                return url($url);
            }

            if (Str::startsWith($url, 'en/')) {
                return url('/'.$url);
            }

            if (Str::startsWith($url, '/')) {
                return url('/en'.$url);
            }

            return url('/en/'.ltrim($url, '/'));
        }

        $url = preg_replace('#^/?en(/|$)#', '/', $url);

        return Str::startsWith($url, '/')
            ? url($url)
            : url('/'.ltrim($url, '/'));
    }

    private static function localizeSameDomainUrl(string $url): string
    {
        $baseUrl = rtrim(url('/'), '/');

        if (! Str::startsWith($url, $baseUrl)) {
            return $url;
        }

        $path = Str::after($url, $baseUrl);
        $path = $path === '' ? '/' : $path;

        return self::url($path);
    }
}
