<?php

namespace App\Http\Controllers;

use App\Models\PanduanStep;
use Illuminate\Http\Request;

class AdminPanduanController extends Controller
{
    public function index()
    {
        $steps = PanduanStep::orderBy('order')->get();
        return view('admin.panduan.index', compact('steps'));
    }

    public function edit(PanduanStep $panduan)
    {
        return view('admin.panduan.edit', ['step' => $panduan]);
    }

    public function update(Request $request, PanduanStep $panduan)
    {
        $request->validate([
            'step_label'  => 'required|string|max:50',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'required|string|max:50',
            'sections'    => 'required|string',
        ]);

        $sections = json_decode($request->sections, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['sections' => 'Format JSON sections tidak valid.'])->withInput();
        }

        $panduan->update([
            'step_label'  => $request->step_label,
            'title'       => $request->title,
            'description' => $request->description,
            'icon'        => $request->icon,
            'sections'    => $sections,
        ]);

        return redirect()->route('admin.panduan.index')->with('success', 'Panduan berhasil diperbarui.');
    }
}
