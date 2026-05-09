<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Doa;
use App\Models\KamusEntry;
use App\Models\PanduanStep;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobileContentController extends Controller
{
    /**
     * GET /api/content/panduan  OR  /api/ibadah/panduan
     */
    public function panduan(): JsonResponse
    {
        $steps = PanduanStep::orderBy('order')->get()->map(function ($step) {
            $details = [];
            $sections = is_array($step->sections) ? $step->sections : json_decode($step->sections, true) ?? [];
            foreach ($sections as $sec) {
                $desc = '';
                if (!empty($sec['items'])) {
                    $desc = '• ' . implode("\n• ", $sec['items']);
                }
                $details[] = [
                    'number'      => $sec['number'] ?? 1,
                    'title'       => $sec['title'] ?? '',
                    'description' => $desc,
                    'arabic_text' => $sec['doa']['arabic'] ?? null,
                    'translation' => $sec['doa']['arti'] ?? null,
                ];
            }

            return [
                'id'       => $step->step_id,
                'title'    => $step->title,
                'subtitle' => $step->description, // Map description to subtitle
                'icon'     => $step->icon,
                'order'    => $step->order,
                'steps'    => $details, // Map to 'steps' as expected by Flutter
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $steps,
        ]);
    }

    /**
     * GET /api/ibadah/panduan/{id}
     */
    public function panduanDetail(string $id): JsonResponse
    {
        $step = PanduanStep::where('step_id', $id)->first();

        if (!$step) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        $details = [];
        $sections = is_array($step->sections) ? $step->sections : json_decode($step->sections, true) ?? [];
        foreach ($sections as $sec) {
            $desc = '';
            if (!empty($sec['items'])) {
                $desc = '• ' . implode("\n• ", $sec['items']);
            }
            $details[] = [
                'number'      => $sec['number'] ?? 1,
                'title'       => $sec['title'] ?? '',
                'description' => $desc,
                'arabic_text' => $sec['doa']['arabic'] ?? null,
                'translation' => $sec['doa']['arti'] ?? null,
            ];
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'id'       => $step->step_id,
                'title'    => $step->title,
                'subtitle' => $step->description,
                'icon'     => $step->icon,
                'order'    => $step->order,
                'steps'    => $details,
            ],
        ]);
    }

    /**
     * GET /api/content/kamus  OR  /api/kamus
     */
    public function kamus(Request $request): JsonResponse
    {
        $query = KamusEntry::orderBy('category')->orderBy('order');

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        if ($request->has('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('arabic', 'like', "%{$s}%")
                  ->orWhere('latin', 'like', "%{$s}%")
                  ->orWhere('indonesian', 'like', "%{$s}%");
            });
        }

        $entries = $query->get()->map(function ($e) {
            return [
                'id'         => $e->id,
                'arabic'     => $e->arabic,
                'latin'      => $e->latin,
                'indonesian' => $e->indonesian,
                'category'   => $e->category,
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $entries,
        ]);
    }

    /**
     * GET /api/content/doa  OR  /api/doa
     */
    public function doa(Request $request): JsonResponse
    {
        $query = Doa::orderBy('category')->orderBy('order');

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $doas = $query->get()->map(function ($d) {
            return [
                'id'          => $d->id,
                'title'       => $d->title,
                'arabic'      => $d->arabic,
                'latin'       => $d->latin,
                'translation' => $d->translation,
                'category'    => $d->category,
                'order'       => $d->order,
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $doas,
        ]);
    }

    /**
     * GET /api/content/berita
     */
    public function berita(): JsonResponse
    {
        $beritas = Berita::where('status', 'published')
            ->latest()
            ->get()
            ->map(function ($berita) {
                return [
                    'id'        => $berita->id,
                    'judul'     => $berita->judul,
                    'slug'      => $berita->slug,
                    'thumbnail' => $berita->thumbnail ? asset('storage/' . $berita->thumbnail) : null,
                    'konten'    => $berita->konten,
                    'created_at'=> $berita->created_at->toIso8601String(),
                    'author'    => $berita->user?->name ?? 'Admin',
                ];
            });

        return response()->json(['success' => true, 'data' => $beritas]);
    }

    /**
     * GET /api/content/sync
     */
    public function sync(): JsonResponse
    {
        $latestDoa    = Doa::latest('updated_at')->first();
        $latestKamus  = KamusEntry::latest('updated_at')->first();
        $latestPanduan = PanduanStep::latest('updated_at')->first();
        $latestBerita = Berita::where('status', 'published')->latest()->first();

        return response()->json([
            'success' => true,
            'data'    => [
                'doa'     => $latestDoa?->updated_at?->toIso8601String(),
                'kamus'   => $latestKamus?->updated_at?->toIso8601String(),
                'panduan' => $latestPanduan?->updated_at?->toIso8601String(),
                'berita'  => $latestBerita?->updated_at?->toIso8601String(),
            ],
        ]);
    }

    /**
     * GET /api/content/settings
     */
    public function settings(): JsonResponse
    {
        $config = [];
        if (Storage::disk('local')->exists('mobile_app_config.json')) {
            $config = json_decode(Storage::disk('local')->get('mobile_app_config.json'), true) ?? [];
        }

        return response()->json([
            'success' => true,
            'data' => [
                'app_name'         => $config['app_name'] ?? 'HaramainQu',
                'min_version'      => $config['min_version'] ?? '1.0.0',
                'primary_color'    => $config['primary_color'] ?? '#0d1130',
                'secondary_color'  => $config['secondary_color'] ?? '#c9a84c',
                'welcome_message'  => $config['welcome_message'] ?? 'Selamat datang di HaramainQu',
                'banner_url'       => !empty($config['banner_promo']) ? asset('storage/' . $config['banner_promo']) : null,
                'features' => [
                    'panduan'       => $config['feature_panduan'] ?? true,
                    'kamus'         => $config['feature_kamus'] ?? true,
                    'doa'           => $config['feature_doa'] ?? true,
                    'berita'        => $config['feature_berita'] ?? true,
                    'push_notif'    => $config['feature_push_notif'] ?? true,
                ],
                'google_login_enabled' => $config['google_login_enabled'] ?? true,
                'require_active_package' => $config['require_active_package'] ?? true,
                'emergency_contacts' => [
                    'pembimbing'   => $config['emergency_phone_1'] ?? null,
                    'kantor'       => $config['emergency_phone_2'] ?? null,
                    'lokal_saudi'  => $config['emergency_phone_3'] ?? null,
                    'whatsapp_group' => $config['whatsapp_group_link'] ?? null,
                ],
            ],
        ]);
    }
}
