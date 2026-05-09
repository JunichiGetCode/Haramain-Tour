<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::with('user')->latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'konten' => 'required',
            'status' => 'required|in:published,draft',
        ]);

        $data = $request->except('thumbnail');
        $data['slug'] = Str::slug($request->judul) . '-' . time();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Optional: you can redirect to the public view of the article
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.form', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'konten' => 'required',
            'status' => 'required|in:published,draft',
        ]);

        $data = $request->except('thumbnail');
        
        // Update slug only if title changes significantly (optional). We will just keep the old slug or generate new if requested.
        // For simplicity, we just keep the existing slug.

        if ($request->hasFile('thumbnail')) {
            if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        if ($berita->thumbnail && Storage::disk('public')->exists($berita->thumbnail)) {
            Storage::disk('public')->delete($berita->thumbnail);
        }
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
