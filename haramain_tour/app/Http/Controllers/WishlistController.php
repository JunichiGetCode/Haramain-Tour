<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Halaman Wishlist
    public function index()
    {
        $user = Auth::user();
        $wishlistIds = $user->settings['wishlist'] ?? [];
        
        $wishlistPackages = [];
        if (!empty($wishlistIds)) {
            $wishlistPackages = Paket::whereIn('id', $wishlistIds)->get();
        }

        return view('wishlist', compact('wishlistPackages'));
    }

    // Toggle wishlist (tambah/hapus)
    public function toggle(Request $request)
    {
        $request->validate(['package_id' => 'required']);

        $user = Auth::user();
        $settings = $user->settings ?? [];
        $wishlist = $settings['wishlist'] ?? [];
        $packageId = $request->package_id;

        if (in_array($packageId, $wishlist)) {
            $wishlist = array_values(array_diff($wishlist, [$packageId]));
            $action = 'removed';
        } else {
            $wishlist[] = $packageId;
            $action = 'added';
        }

        $settings['wishlist'] = $wishlist;
        $user->settings = $settings;
        $user->save();

        return response()->json([
            'success' => true,
            'action' => $action,
            'wishlist' => $wishlist,
        ]);
    }

    // Hapus dari wishlist
    public function remove(Request $request)
    {
        $request->validate(['package_id' => 'required']);

        $user = Auth::user();
        $settings = $user->settings ?? [];
        $wishlist = $settings['wishlist'] ?? [];

        $wishlist = array_values(array_diff($wishlist, [$request->package_id]));

        $settings['wishlist'] = $wishlist;
        $user->settings = $settings;
        $user->save();

        return redirect()->route('wishlist')->with('success', 'Paket dihapus dari wishlist.');
    }
}
