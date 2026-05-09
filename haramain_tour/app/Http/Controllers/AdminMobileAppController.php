<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMobileAppController extends Controller
{
    private $configPath = 'mobile_app_config.json';

    public function index()
    {
        $config = $this->getConfig();
        return view('admin.mobile_settings', compact('config'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_link' => 'nullable|url',
            'show_barcode' => 'boolean',
            'app_name' => 'nullable|string|max:50',
            'min_version' => 'nullable|string|max:10',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'welcome_message' => 'nullable|string|max:255',
            'emergency_phone_1' => 'nullable|string|max:20',
            'emergency_phone_2' => 'nullable|string|max:20',
            'emergency_phone_3' => 'nullable|string|max:20',
            'whatsapp_group_link' => 'nullable|url',
        ]);

        $config = [
            'app_link' => $request->app_link,
            'show_barcode' => $request->has('show_barcode'),
            'app_name' => $request->app_name ?? 'HaramainQu',
            'min_version' => $request->min_version ?? '1.0.0',
            'primary_color' => $request->primary_color ?? '#0d1130',
            'secondary_color' => $request->secondary_color ?? '#c9a84c',
            'welcome_message' => $request->welcome_message ?? 'Selamat datang di HaramainQu',
            
            // Feature toggles
            'feature_panduan' => $request->has('feature_panduan'),
            'feature_kamus' => $request->has('feature_kamus'),
            'feature_doa' => $request->has('feature_doa'),
            'feature_berita' => $request->has('feature_berita'),
            'feature_push_notif' => $request->has('feature_push_notif'),

            
            // Auth toggles
            'google_login_enabled' => $request->has('google_login_enabled'),
            'require_active_package' => $request->has('require_active_package'),
            
            // Emergency
            'emergency_phone_1' => $request->emergency_phone_1,
            'emergency_phone_2' => $request->emergency_phone_2,
            'emergency_phone_3' => $request->emergency_phone_3,
            'whatsapp_group_link' => $request->whatsapp_group_link,
            
            'updated_at' => now()->toDateTimeString(),
        ];

        Storage::disk('local')->put($this->configPath, json_encode($config, JSON_PRETTY_PRINT));

        return redirect()->route('admin.mobile_app.index')
            ->with('success', 'Pengaturan Mobile App berhasil disimpan.');
    }


    public static function getConfigStatic()
    {
        if (Storage::disk('local')->exists('mobile_app_config.json')) {
            return json_decode(Storage::disk('local')->get('mobile_app_config.json'), true);
        }
        return ['app_link' => null, 'show_barcode' => false];
    }

    private function getConfig()
    {
        return self::getConfigStatic();
    }
}
