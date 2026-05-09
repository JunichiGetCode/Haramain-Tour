<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of published news.
     */
    public function index()
    {
        $beritas = Berita::where('status', 'published')
            ->with('user')
            ->latest()
            ->paginate(9);

        return view('berita.index', compact('beritas'));
    }

    /**
     * Display the specified news article.
     */
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Optional: Get 3 related/recent news for sidebar/bottom
        $recentBeritas = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(3)
            ->get();

        return view('berita.show', compact('berita', 'recentBeritas'));
    }
}
