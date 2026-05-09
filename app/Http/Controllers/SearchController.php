<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Berita;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        
        $pakets = collect();
        $beritas = collect();
        $pages = collect();

        if (strlen($query) >= 2) {
            // Cari Paket
            $pakets = Paket::where(function($q) use ($query) {
                    $q->where('nama', 'like', "%{$query}%")
                      ->orWhere('kategori', 'like', "%{$query}%")
                      ->orWhere('deskripsi', 'like', "%{$query}%")
                      ->orWhere('hotel_makkah', 'like', "%{$query}%");
                })
                ->limit(5)
                ->get();

            // Cari Berita
            $beritas = Berita::where('status', 'published')
                ->where(function($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%")
                      ->orWhere('konten', 'like', "%{$query}%");
                })
                ->with('user')
                ->limit(5)
                ->get();

            // Halaman statis yang cocok
            $staticPages = [
                ['title' => 'Panduan Ibadah Umroh', 'desc' => 'Panduan lengkap tata cara umroh step by step', 'icon' => 'fa-book', 'route' => 'panduan', 'tags' => 'panduan ibadah umroh haji tata cara'],
                ['title' => 'Doa-Doa Penting', 'desc' => 'Kumpulan doa saat tawaf, sa\'i, dan ibadah di tanah suci', 'icon' => 'fa-hands-praying', 'route' => 'doa', 'tags' => 'doa penting tawaf sai ihram masjid zamzam'],
                ['title' => 'Kamus Bahasa Arab', 'desc' => 'Kosakata dan frasa Arab untuk jamaah di tanah suci', 'icon' => 'fa-language', 'route' => 'kamus', 'tags' => 'kamus bahasa arab kosakata frasa sapaan angka darurat'],
                ['title' => 'Paket Umroh & Haji', 'desc' => 'Lihat semua paket umroh dan haji tersedia', 'icon' => 'fa-file-lines', 'route' => 'paket', 'tags' => 'paket umroh haji reguler premium plus turki'],
                ['title' => 'Berita & Informasi', 'desc' => 'Berita terbaru dan pengumuman seputar ibadah', 'icon' => 'fa-newspaper', 'route' => 'berita.index', 'tags' => 'berita informasi pengumuman artikel'],
                ['title' => 'Notifikasi', 'desc' => 'Pemberitahuan dan update status pendaftaran', 'icon' => 'fa-bell', 'route' => 'notifikasi', 'tags' => 'notifikasi pemberitahuan status pendaftaran'],
                ['title' => 'Profil Saya', 'desc' => 'Lihat dan edit data profil akun Anda', 'icon' => 'fa-user-circle', 'route' => 'profile', 'tags' => 'profil akun data diri edit'],
                ['title' => 'Pengaturan', 'desc' => 'Kelola preferensi dan keamanaan akun', 'icon' => 'fa-gear', 'route' => 'settings', 'tags' => 'pengaturan setting keamanan password akun'],
            ];

            $pages = collect($staticPages)->filter(function($page) use ($query) {
                $searchable = strtolower($page['title'] . ' ' . $page['desc'] . ' ' . $page['tags']);
                return str_contains($searchable, strtolower($query));
            })->values();
        }

        $totalResults = $pakets->count() + $beritas->count() + $pages->count();

        return view('search', compact('query', 'pakets', 'beritas', 'pages', 'totalResults'));
    }

    /**
     * AJAX quick search – returns JSON for live dropdown
     */
    public function ajax(Request $request)
    {
        $query = $request->get('q', '');
        $results = [];

        if (strlen($query) >= 2) {
            // Paket
            $pakets = Paket::where('nama', 'like', "%{$query}%")
                ->orWhere('kategori', 'like', "%{$query}%")
                ->limit(3)->get();
            foreach ($pakets as $p) {
                $results[] = ['type' => 'paket', 'title' => $p->nama, 'sub' => $p->kategori . ' · ' . $p->harga_rupiah, 'url' => route('paket'), 'icon' => 'fa-file-lines'];
            }

            // Berita
            $beritas = Berita::where('status', 'published')
                ->where(function($q) use ($query) {
                    $q->where('judul', 'like', "%{$query}%");
                })
                ->limit(3)->get();
            foreach ($beritas as $b) {
                $results[] = ['type' => 'berita', 'title' => $b->judul, 'sub' => 'Berita · ' . $b->created_at->format('d M Y'), 'url' => route('berita.show', $b->slug), 'icon' => 'fa-newspaper'];
            }

            // Halaman statis
            $staticPages = [
                ['title' => 'Panduan Ibadah', 'sub' => 'Tata cara umroh lengkap', 'url' => route('panduan'), 'icon' => 'fa-book', 'tags' => 'panduan ibadah umroh'],
                ['title' => 'Doa Penting', 'sub' => 'Kumpulan doa umroh & haji', 'url' => route('doa'), 'icon' => 'fa-hands-praying', 'tags' => 'doa tawaf sai zamzam'],
                ['title' => 'Kamus Arab', 'sub' => 'Kosakata bahasa Arab', 'url' => route('kamus'), 'icon' => 'fa-language', 'tags' => 'kamus arab kata frasa'],
                ['title' => 'Paket Umroh', 'sub' => 'Semua paket tersedia', 'url' => route('paket'), 'icon' => 'fa-file-lines', 'tags' => 'paket umroh haji reguler'],
                ['title' => 'Berita & Info', 'sub' => 'Informasi terbaru', 'url' => route('berita.index'), 'icon' => 'fa-newspaper', 'tags' => 'berita informasi artikel'],
            ];
            foreach ($staticPages as $sp) {
                if (str_contains(strtolower($sp['title'] . ' ' . $sp['tags']), strtolower($query))) {
                    $results[] = ['type' => 'page', 'title' => $sp['title'], 'sub' => $sp['sub'], 'url' => $sp['url'], 'icon' => $sp['icon']];
                }
            }
        }

        return response()->json(['results' => $results, 'query' => $query]);
    }
}
