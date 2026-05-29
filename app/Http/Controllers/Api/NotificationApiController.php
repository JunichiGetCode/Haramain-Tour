<?php

namespace App\Http\Controllers\Api;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationApiController extends Controller
{
    /**
     * List semua notifikasi user (terbaru duluan)
     */
    public function index(Request $request)
    {
        $notifikasis = Notifikasi::where('user_id', $request->user()->id)
            ->latest()
            ->get()
            ->map(function ($n) {
                return [
                    'id'         => $n->id,
                    'judul'      => $n->judul,
                    'pesan'      => $n->pesan,
                    'tipe'       => $n->tipe,
                    'dibaca'     => $n->dibaca,
                    'created_at' => $n->created_at->toIso8601String(),
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $notifikasis,
        ]);
    }

    /**
     * Tandai satu notifikasi sebagai dibaca
     */
    public function markAsRead(Request $request, $id)
    {
        $notifikasi = Notifikasi::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $notifikasi->update(['dibaca' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Tandai semua notifikasi sebagai dibaca
     */
    public function markAllRead(Request $request)
    {
        Notifikasi::where('user_id', $request->user()->id)
            ->where('dibaca', false)
            ->update(['dibaca' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Jumlah notifikasi yang belum dibaca
     */
    public function unreadCount(Request $request)
    {
        $count = Notifikasi::where('user_id', $request->user()->id)
            ->where('dibaca', false)
            ->count();

        return response()->json([
            'success' => true,
            'count'   => $count,
        ]);
    }
}
