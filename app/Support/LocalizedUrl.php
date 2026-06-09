<?php

namespace App\Support;

class LocalizedUrl
{
    public static function switchTo(string $locale): string
    {
        $path = request()->path();

        if ($path === '/') {
            $path = '';
        }

        $path = preg_replace('#^en(/|$)#', '', $path);
        $path = trim($path ?? '', '/');

        if ($locale === 'en') {
            return url(trim('en/'.$path, '/'));
        }

        return url($path ?: '/');
    }

    public static function currentLocaleLabel(): string
    {
        return app()->getLocale() === 'en' ? 'English' : 'Indonesia';
    }
}
