<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IbadahProgress;
use Illuminate\Http\Request;

class IbadahProgressController extends Controller
{
    /**
     * Retrieve all progress for the authenticated user
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        $progress = IbadahProgress::where('user_id', $user->id)
            ->get()
            ->map(function ($item) {
                return [
                    'ibadah_id' => $item->ibadah_id,
                    'hari_ke' => $item->hari_ke,
                    'status' => $item->status,
                    'updated_at' => $item->updated_at->toIso8601String(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $progress
        ]);
    }

    /**
     * Store or update a progress
     */
    public function update(Request $request)
    {
        $request->validate([
            'ibadah_id' => 'required|string',
            'status' => 'required|string|in:belum,sedang,selesai',
            'hari_ke' => 'required|integer',
        ]);

        $user = $request->user();
        
        $progress = IbadahProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'ibadah_id' => $request->ibadah_id,
                'hari_ke' => $request->hari_ke,
            ],
            [
                'status' => $request->status,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Progress updated successfully',
            'data' => [
                'ibadah_id' => $progress->ibadah_id,
                'hari_ke' => $progress->hari_ke,
                'status' => $progress->status,
                'updated_at' => $progress->updated_at->toIso8601String(),
            ]
        ]);
    }
}
