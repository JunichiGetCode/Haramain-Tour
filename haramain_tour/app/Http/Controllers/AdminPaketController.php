<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPaketController extends Controller
{
    /**
     * Display a listing of the pakets.
     */
    public function index(Request $request)
    {
        $query = Paket::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        }

        $pakets = $query->latest()->paginate(10);
        return view('admin.pakets.index', compact('pakets'));
    }

    /**
     * Show the form for creating a new paket.
     */
    public function create()
    {
        return view('admin.pakets.form');
    }

    /**
     * Store a newly created paket in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validatePaket($request);

        // Upload gambar utama
        if ($request->hasFile('gambar_utama')) {
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('pakets', 'public');
        }

        // Susun fasilitas (JSON)
        $fasilitas = [];
        if ($request->has('fasilitas_icon') && $request->has('fasilitas_text')) {
            foreach ($request->fasilitas_icon as $index => $icon) {
                if (!empty($request->fasilitas_text[$index])) {
                    $fasilitas[] = [
                        'icon' => $icon,
                        'text' => $request->fasilitas_text[$index]
                    ];
                }
            }
        }
        $validated['fasilitas'] = $fasilitas;

        // Upload gambar rincian (slider)
        $gambarRincian = [];
        if ($request->hasFile('gambar_rincian')) {
            foreach ($request->file('gambar_rincian') as $file) {
                $gambarRincian[] = $file->store('pakets', 'public');
            }
        }
        $validated['gambar_rincian'] = $gambarRincian;

        // Checkbox states
        $validated['status_populer'] = $request->has('status_populer');
        $validated['status_premium'] = $request->has('status_premium');

        Paket::create($validated);

        return redirect()->route('admin.pakets.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified paket.
     */
    public function edit(Paket $paket)
    {
        return view('admin.pakets.form', compact('paket'));
    }

    /**
     * Update the specified paket in storage.
     */
    public function update(Request $request, Paket $paket)
    {
        $validated = $this->validatePaket($request, $paket->id);

        // Upload gambar utama baru jika ada
        if ($request->hasFile('gambar_utama')) {
            // Cek apakah bukan path bawaan (bukan .jpeg/.png di folder image yang ada dari seeder)
            if ($paket->gambar_utama && str_starts_with($paket->gambar_utama, 'pakets/')) {
                Storage::disk('public')->delete($paket->gambar_utama);
            }
            $validated['gambar_utama'] = $request->file('gambar_utama')->store('pakets', 'public');
        }

        // Susun fasilitas (JSON)
        $fasilitas = [];
        if ($request->has('fasilitas_icon') && $request->has('fasilitas_text')) {
            foreach ($request->fasilitas_icon as $index => $icon) {
                if (!empty($request->fasilitas_text[$index])) {
                    $fasilitas[] = [
                        'icon' => $icon,
                        'text' => $request->fasilitas_text[$index]
                    ];
                }
            }
        }
        $validated['fasilitas'] = $fasilitas;

        // Upload gambar rincian baru jika di upload ulang
        if ($request->hasFile('gambar_rincian')) {
            // Delete old ones first if they aren't seed images
            if (is_array($paket->gambar_rincian)) {
                foreach ($paket->gambar_rincian as $oldImg) {
                    if (str_starts_with($oldImg, 'pakets/')) {
                         Storage::disk('public')->delete($oldImg);
                    }
                }
            }

            $gambarRincian = [];
            foreach ($request->file('gambar_rincian') as $file) {
                $gambarRincian[] = $file->store('pakets', 'public');
            }
            $validated['gambar_rincian'] = $gambarRincian;
        }

        // Checkbox states
        $validated['status_populer'] = $request->has('status_populer');
        $validated['status_premium'] = $request->has('status_premium');

        $paket->update($validated);

        return redirect()->route('admin.pakets.index')->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified paket from storage.
     */
    public function destroy(Paket $paket)
    {
        // Delete uploaded physical files if they aren't seed images
        if ($paket->gambar_utama && str_starts_with($paket->gambar_utama, 'pakets/')) {
            Storage::disk('public')->delete($paket->gambar_utama);
        }

        if (is_array($paket->gambar_rincian)) {
            foreach ($paket->gambar_rincian as $oldImg) {
                if (str_starts_with($oldImg, 'pakets/')) {
                     Storage::disk('public')->delete($oldImg);
                }
            }
        }

        $paket->delete();
        return redirect()->route('admin.pakets.index')->with('success', 'Paket berhasil dihapus!');
    }

    /**
     * Validas input paket
     */
    private function validatePaket(Request $request, $ignoreId = null)
    {
        return $request->validate([
            'nama' => 'required|string|max:150',
            'kategori' => 'required|in:reguler,plus,furoda,haji_basic,haji_plus',
            'durasi_hari' => 'required|integer|min:1',
            'tanggal_keberangkatan' => 'nullable|date',
            'hotel_makkah' => 'nullable|string|max:150',
            'hotel_madinah' => 'nullable|string|max:150',
            'harga' => 'required|numeric|min:0',
            'harga_label' => 'nullable|string|max:50',
            'rating' => 'required|numeric|min:1|max:5',
            'deskripsi' => 'nullable|string',
            'gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_rincian.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    }
}
