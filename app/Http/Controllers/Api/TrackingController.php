<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tracking;

class TrackingController extends Controller
{

    public function index(Request $request)
    {
        $trackings = Tracking::where('user_id', $request->user()->id)->get();
        return response()->json([
            'success' => true,
            'data' => $trackings,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'current' => 'required|integer',
            'target' => 'required|integer',
        ]);

        $tracking = Tracking::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'type' => $request->type,
                'date' => date('Y-m-d'), // Save today's date for daily tracking
            ],
            [
                'current' => $request->current,
                'target' => $request->target,
            ]
        );

        return response()->json([
            'success' => true,
            'data' => $tracking,
            'message' => 'Tracking data saved successfully',
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
        ]);

        Tracking::where('user_id', $request->user()->id)
            ->where('type', $request->type)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tracking data reset successfully',
        ]);
    }
}
