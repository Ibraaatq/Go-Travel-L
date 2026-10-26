<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Wishlist;
use App\Models\User;

class WishlistController extends Controller
{
    /**
     * Dapatkan user yang sedang aktif dari session (buat otomatis jika belum ada di DB)
     */
    private function resolveCurrentUser()
    {
        $sessionUser = session('user');
        if (!$sessionUser) {
            return null;
        }

        if (!empty($sessionUser['id'])) {
            $user = User::find($sessionUser['id']);
            if ($user) return $user;
        }

        if (!empty($sessionUser['email'])) {
            $user = User::where('email', $sessionUser['email'])->first();
            if ($user) {
                // Update session dengan user id jika sebelumnya null
                if (empty($sessionUser['id'])) {
                    $sessionUser['id'] = $user->id;
                    session(['user' => $sessionUser]);
                }
                return $user;
            }

            // Jika user ada di session tetapi belum ada record-nya di DB (misal login Google/sosmed/testing)
            // Simpan record ke database agar wishlist memiliki user_id yang valid
            try {
                $name = !empty($sessionUser['name']) ? $sessionUser['name'] : 'Pengguna Go Travel';
                $role = !empty($sessionUser['role']) ? $sessionUser['role'] : 'user';
                $newUser = User::create([
                    'name'     => $name,
                    'email'    => $sessionUser['email'],
                    'password' => \Illuminate\Support\Facades\Hash::make('secret123'),
                    'role'     => $role,
                ]);

                $sessionUser['id'] = $newUser->id;
                session(['user' => $sessionUser]);

                return $newUser;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Wishlist resolveCurrentUser error: ' . $e->getMessage());
            }
        }

        return null;
    }

    /**
     * Toggle status Wishlist (Tambah atau Hapus)
     */
    public function toggle(Request $request)
    {
        $user = $this->resolveCurrentUser();
        if (!$user) {
            return response()->json([
                'success' => false,
                'logged_in' => false,
                'message' => 'Silakan masuk (login) terlebih dahulu untuk menyimpan paket ke wishlist.',
            ], 401);
        }

        $packageIdentifier = $request->input('package_id') ?: $request->input('slug');
        if (!$packageIdentifier) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter paket wisata tidak ditemukan.',
            ], 400);
        }

        $package = is_numeric($packageIdentifier) 
            ? Package::find($packageIdentifier) 
            : Package::where('slug', $packageIdentifier)->first();

        if (!$package) {
            return response()->json([
                'success' => false,
                'message' => 'Paket wisata tidak ditemukan di database.',
            ], 404);
        }

        $existing = Wishlist::where('user_id', $user->id)
            ->where('package_id', $package->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $status = 'removed';
            $message = 'Paket wisata "' . $package->nama_paket . '" berhasil dihapus dari Wishlist.';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
            ]);
            $status = 'added';
            $message = 'Paket wisata "' . $package->nama_paket . '" berhasil ditambahkan ke Wishlist!';
        }

        $totalWishlist = Wishlist::where('user_id', $user->id)->count();

        return response()->json([
            'success' => true,
            'status' => $status,
            'message' => $message,
            'package_id' => $package->id,
            'slug' => $package->slug,
            'total_wishlist' => $totalWishlist,
        ]);
    }

    /**
     * Dapatkan daftar slug/id paket yang sudah di-wishlist oleh user
     */
    public function userWishlistIds()
    {
        $user = $this->resolveCurrentUser();
        if (!$user) {
            return response()->json([
                'logged_in' => false,
                'wishlist_slugs' => [],
                'wishlist_ids' => [],
            ]);
        }

        $wishlists = Wishlist::with('package')->where('user_id', $user->id)->get();
        $slugs = $wishlists->pluck('package.slug')->filter()->values();
        $ids = $wishlists->pluck('package_id')->values();

        return response()->json([
            'logged_in' => true,
            'wishlist_slugs' => $slugs,
            'wishlist_ids' => $ids,
            'total' => $wishlists->count(),
        ]);
    }
}
