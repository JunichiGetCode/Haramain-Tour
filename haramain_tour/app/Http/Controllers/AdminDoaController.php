<?php

namespace App\Http\Controllers;

use App\Models\Doa;
use Illuminate\Http\Request;

class AdminDoaController extends Controller
{
    public function index()
    {
        $doas = Doa::orderBy('category')->orderBy('order')->get();
        $categories = [
            'masjid'  => 'Doa di Masjidil Haram',
            'tawaf'   => 'Doa saat Tawaf',
            'sai'     => "Doa saat Sa'i",
            'arafah'  => 'Doa Arafah & Talbiyah',
        ];
        return view('admin.doa.index', compact('doas', 'categories'));
    }

    public function create()
    {
        $categories = ['masjid', 'tawaf', 'sai', 'arafah'];
        return view('admin.doa.form', ['doa' => null, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'    => 'required|string',
            'title'       => 'required|string|max:255',
            'arabic'      => 'required|string',
            'latin'       => 'required|string',
            'translation' => 'required|string',
        ]);

        $maxOrder = Doa::where('category', $request->category)->max('order') ?? 0;

        Doa::create(array_merge($request->only(['category', 'title', 'arabic', 'latin', 'translation']), [
            'order' => $maxOrder + 1,
        ]));

        return redirect()->route('admin.doa.index')->with('success', 'Doa berhasil ditambahkan.');
    }

    public function edit(Doa $doa)
    {
        $categories = ['masjid', 'tawaf', 'sai', 'arafah'];
        return view('admin.doa.form', compact('doa', 'categories'));
    }

    public function update(Request $request, Doa $doa)
    {
        $request->validate([
            'category'    => 'required|string',
            'title'       => 'required|string|max:255',
            'arabic'      => 'required|string',
            'latin'       => 'required|string',
            'translation' => 'required|string',
        ]);

        $doa->update($request->only(['category', 'title', 'arabic', 'latin', 'translation']));

        return redirect()->route('admin.doa.index')->with('success', 'Doa berhasil diperbarui.');
    }

    public function destroy(Doa $doa)
    {
        $doa->delete();
        return redirect()->route('admin.doa.index')->with('success', 'Doa berhasil dihapus.');
    }
}
