<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    // Fungsi untuk menampilkan halaman daftar paket
    public function index()
    {
        $pakets = Paket::latest()->get();
        return view('paket', compact('pakets'));
    }
}