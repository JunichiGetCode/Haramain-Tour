<?php

namespace App\Http\Controllers;

use App\Models\KamusEntry;
use Illuminate\Http\Request;

class AdminKamusController extends Controller
{
    public function index()
    {
        $entries = KamusEntry::orderBy('category')->orderBy('order')->get();
        $categories = [
            'sapaan'  => 'Sapaan & Umum',
            'tempat'  => 'Tempat & Arah',
            'sehari'  => 'Kebutuhan Sehari-hari',
            'angka'   => 'Angka Dasar',
            'darurat' => 'Frasa Darurat',
        ];
        return view('admin.kamus.index', compact('entries', 'categories'));
    }

    public function create()
    {
        $categories = ['sapaan', 'tempat', 'sehari', 'angka', 'darurat'];
        return view('admin.kamus.form', ['entry' => null, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'   => 'required|string',
            'arabic'     => 'required|string',
            'latin'      => 'required|string|max:255',
            'indonesian' => 'required|string|max:255',
        ]);

        $maxOrder = KamusEntry::where('category', $request->category)->max('order') ?? 0;

        KamusEntry::create(array_merge($request->only(['category', 'arabic', 'latin', 'indonesian']), [
            'order' => $maxOrder + 1,
        ]));

        return redirect()->route('admin.kamus.index')->with('success', 'Kosa kata berhasil ditambahkan.');
    }

    public function edit(KamusEntry $kamu)
    {
        $categories = ['sapaan', 'tempat', 'sehari', 'angka', 'darurat'];
        return view('admin.kamus.form', ['entry' => $kamu, 'categories' => $categories]);
    }

    public function update(Request $request, KamusEntry $kamu)
    {
        $request->validate([
            'category'   => 'required|string',
            'arabic'     => 'required|string',
            'latin'      => 'required|string|max:255',
            'indonesian' => 'required|string|max:255',
        ]);

        $kamu->update($request->only(['category', 'arabic', 'latin', 'indonesian']));

        return redirect()->route('admin.kamus.index')->with('success', 'Kosa kata berhasil diperbarui.');
    }

    public function destroy(KamusEntry $kamu)
    {
        $kamu->delete();
        return redirect()->route('admin.kamus.index')->with('success', 'Kosa kata berhasil dihapus.');
    }
}
