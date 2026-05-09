<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ApplyUserSettings
{
    private function getDefaults()
    {
        return [
            'notif_promo'         => true,
            'notif_update_paket'  => true,
            'notif_keberangkatan' => true,
            'bahasa'              => 'id',
            'dark_mode'           => false,
            'show_email'          => true,
            'show_phone'          => false,
        ];
    }

    public function handle(Request $request, Closure $next)
    {
        $settings = $this->getDefaults();

        if (Auth::check()) {
            $settings = array_merge($settings, Auth::user()->settings ?? []);
        }

        // Session locale takes priority (set by language switcher)
        $locale = session('locale', $settings['bahasa']);
        App::setLocale($locale);

        // Sync session locale to settings for views
        $settings['bahasa'] = $locale;

        // Share settings ke semua views
        View::share('userSettings', $settings);

        return $next($request);
    }
}
