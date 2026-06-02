<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleSiteMaintenance
{
    public function handle(Request $request, Closure $next): Response
    {
        $setting = SiteSetting::query()->first();

        if (! $setting || ! $setting->is_maintenance_mode) {
            return $next($request);
        }

        if ($this->shouldBypass($request)) {
            return $next($request);
        }

        return response()
            ->view('pages.maintenance', [
                'setting' => $setting,
                'title' => $setting->maintenance_title ?: 'Bendo Jaya Batik Fashion',
                'metaDescription' => $setting->maintenance_description ?: $setting->meta_description,
            ], 200);
    }

    private function shouldBypass(Request $request): bool
    {
        if ($request->is(
            'admin',
            'admin/*',
            'login',
            'logout',
            'storage/*',
            'assets/*',
            'build/*',
            'favicon.ico',
            'robots.txt',
            'sitemap.xml',
            'llms.txt'
        )) {
            return true;
        }

        $user = $request->user();

        return $user && method_exists($user, 'canAccessPanel') && $user->canAccessPanel();
    }
}
