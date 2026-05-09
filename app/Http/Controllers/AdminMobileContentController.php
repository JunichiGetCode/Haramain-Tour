<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMobileContentController extends Controller
{
    private $contentPath = 'mobile_content/';

    /**
     * Display the content management page
     */
    public function index()
    {
        $panduan = $this->loadJson('panduan.json');
        $kamus = $this->loadJson('kamus.json');
        $doa = $this->loadJson('doa.json');

        return view('admin.mobile_content', compact('panduan', 'kamus', 'doa'));
    }

    /**
     * Update Panduan content
     */
    public function updatePanduan(Request $request)
    {
        return $this->updateContent($request, 'panduan.json');
    }

    /**
     * Update Kamus content
     */
    public function updateKamus(Request $request)
    {
        return $this->updateContent($request, 'kamus.json');
    }

    /**
     * Update Doa content
     */
    public function updateDoa(Request $request)
    {
        return $this->updateContent($request, 'doa.json');
    }

    /**
     * Helper to update JSON content
     */
    private function updateContent(Request $request, string $filename)
    {
        $request->validate([
            'json_content' => 'required|json',
        ]);

        $data = json_decode($request->json_content, true);
        
        // Update timestamp and version
        $data['updated_at'] = now()->toIso8601String();
        $data['version'] = ($data['version'] ?? 1) + 1;

        Storage::disk('local')->put($this->contentPath . $filename, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin.mobile_content.index')
            ->with('success', "Konten {$filename} berhasil diperbarui.");
    }

    /**
     * Load JSON content file from storage
     */
    private function loadJson(string $filename): string
    {
        $path = $this->contentPath . $filename;
        if (Storage::disk('local')->exists($path)) {
            return Storage::disk('local')->get($path);
        }
        return '{}';
    }
}
