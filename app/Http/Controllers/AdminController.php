<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Halaman Dashboard Admin
     */
    public function index(Request $request)
    {
        $packages = Package::all();
        $orders = Order::latest()->get();
        $users = User::all();

        $totalOrders = $orders->count();
        $completedOrders = $orders->whereIn('status', ['Selesai', 'selesai', 'disetujui', 'Disetujui'])->count();
        $pendingOrders = $orders->whereIn('status', ['Menunggu', 'menunggu', 'pending', 'Pending'])->count();
        $totalRevenue = $orders->whereIn('status', ['Selesai', 'selesai', 'disetujui', 'Disetujui'])->sum('total_pembayaran');

        // Wishlists untuk admin yang login
        $adminWishlists = collect();
        $sessionUser = session('user');
        if ($sessionUser) {
            $userObj = null;
            if (!empty($sessionUser['id'])) $userObj = User::find($sessionUser['id']);
            if (!$userObj && !empty($sessionUser['email'])) $userObj = User::where('email', $sessionUser['email'])->first();
            if ($userObj) {
                $adminWishlists = \App\Models\Wishlist::with('package')->where('user_id', $userObj->id)->latest()->get();
            }
        }

        return view('admin', compact(
            'packages', 
            'orders', 
            'users', 
            'totalOrders', 
            'completedOrders', 
            'pendingOrders', 
            'totalRevenue',
            'adminWishlists'
        ));
    }

    /**
     * Tambah Paket Wisata Baru ke Database
     */
    public function storePackage(Request $request)
    {
        // Bersihkan input harga dari format teks mata uang seperti 'Rp. 1.500.000' atau '1.500.000'
        $rawPrice = $request->input('harga');
        if (is_string($rawPrice)) {
            // Bersihkan semua karakter selain angka
            $cleanPrice = preg_replace('/[^0-9]/', '', $rawPrice);
            $request->merge(['harga' => $cleanPrice !== '' ? (float) $cleanPrice : null]);
        }

        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|string|max:255',
            'destinasi' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'makan' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'nama_paket.required' => 'Nama paket wisata wajib diisi.',
            'harga.required' => 'Harga paket wisata wajib diisi.',
            'harga.numeric' => 'Harga paket harus berupa angka valid.',
            'durasi.required' => 'Durasi wisata wajib diisi.',
            'destinasi.required' => 'Destinasi wisata wajib dipilih/diisi.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        try {
            $baseSlug = Str::slug($request->nama_paket);
            $slug = $baseSlug ?: 'paket-' . time();

            // Cegah error Duplicate Entry Slug dengan memberi penanda unik jika sudah ada
            if (Package::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . time();
            }

            // Upload Gambar jika ada
            $gambarPath = 'images/jogja.jpg';
            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('packages', 'public');
                $gambarPath = 'storage/' . $path;
            }

            // Parse itinerary jika dikirim berupa JSON string
            $itinerary = $request->input('itinerary');
            if (is_string($itinerary)) {
                $decoded = json_decode($itinerary, true);
                $itinerary = is_array($decoded) ? $decoded : [];
            } elseif (!is_array($itinerary)) {
                $itinerary = [];
            }

            $numericPrice = (float) $request->input('harga');

            $newPackage = Package::create([
                'nama_paket' => $request->nama_paket,
                'slug' => $slug,
                'harga' => $numericPrice,
                'harga_display' => 'Rp.' . number_format($numericPrice, 0, ',', '.'),
                'durasi' => $request->durasi,
                'destinasi' => $request->destinasi,
                'kategori' => $request->kategori ?: 'Wisata Alam',
                'makan' => $request->makan ?: 'Makan Sesuai Program',
                'deskripsi' => $request->deskripsi ?: 'Deskripsi paket wisata ' . $request->nama_paket,
                'gambar' => $gambarPath,
                'itinerary' => $itinerary,
                'is_active' => true,
            ]);

            return redirect()->route('admin')->with('success', 'Paket wisata "' . $newPackage->nama_paket . '" berhasil disimpan ke database!');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan paket wisata: ' . $e->getMessage());
        }
    }

    /**
     * Update / Ubah Paket Wisata di Database
     */
    public function updatePackage(Request $request, $id)
    {
        // Cari paket berdasarkan ID atau slug
        $package = is_numeric($id) ? Package::find($id) : Package::where('slug', $id)->first();
        if (!$package) {
            $package = Package::where('slug', $request->input('slug'))->firstOrFail();
        }

        // Bersihkan input harga
        $rawPrice = $request->input('harga');
        if (is_string($rawPrice)) {
            $cleanPrice = preg_replace('/[^0-9]/', '', $rawPrice);
            $request->merge(['harga' => $cleanPrice !== '' ? (float) $cleanPrice : null]);
        }

        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|string|max:255',
            'destinasi' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'makan' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            // Upload Gambar baru jika ada file yang diunggah
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika tersimpan di storage/packages/
                if ($package->gambar && str_starts_with($package->gambar, 'storage/packages/')) {
                    $oldRelPath = str_replace('storage/', '', $package->gambar);
                    Storage::disk('public')->delete($oldRelPath);
                }
                $path = $request->file('gambar')->store('packages', 'public');
                $package->gambar = 'storage/' . $path;
            }

            // Parse itinerary jika dikirim dalam bentuk JSON string
            $itinerary = $request->input('itinerary');
            if (is_string($itinerary)) {
                $decoded = json_decode($itinerary, true);
                $itinerary = is_array($decoded) ? $decoded : [];
            } elseif (!is_array($itinerary)) {
                $itinerary = $package->itinerary ?? [];
            }

            $numericPrice = (float) $request->input('harga');

            $package->nama_paket = $request->nama_paket;
            $package->harga = $numericPrice;
            $package->harga_display = 'Rp.' . number_format($numericPrice, 0, ',', '.');
            $package->durasi = $request->durasi;
            $package->destinasi = $request->destinasi;
            if ($request->filled('kategori')) {
                $package->kategori = $request->kategori;
            }
            if ($request->filled('makan')) {
                $package->makan = $request->makan;
            }
            if ($request->filled('deskripsi')) {
                $package->deskripsi = $request->deskripsi;
            }
            $package->itinerary = $itinerary;
            $package->save();

            return redirect()->route('admin')->with('success', 'Paket wisata "' . $package->nama_paket . '" berhasil diperbarui!');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui paket wisata: ' . $e->getMessage());
        }
    }

    /**
     * Hapus Paket Wisata
     */
    public function destroyPackage($id)
    {
        $package = Package::findOrFail($id);
        
        if ($package->gambar && str_starts_with($package->gambar, 'storage/packages/')) {
            $relativePath = str_replace('storage/', '', $package->gambar);
            Storage::disk('public')->delete($relativePath);
        }

        $package->delete();

        return redirect()->back()->with('success', 'Paket wisata berhasil dihapus!');
    }
}