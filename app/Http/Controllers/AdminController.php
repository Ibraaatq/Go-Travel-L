<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan data Orders, Packages, dan Users dari MySQL.
     */
    public function index()
    {
        try {
            $orders = Order::latest()->get();
            $totalOrders    = $orders->count();
            $completedOrders = $orders->filter(function ($o) {
                return in_array(strtolower($o->status), ['selesai', 'disetujui']);
            })->count();
            $pendingOrders = $orders->filter(function ($o) {
                return in_array(strtolower($o->status), ['dipending', 'pending']);
            })->count();
        } catch (\Throwable $e) {
            $orders          = collect();
            $totalOrders     = 0;
            $completedOrders = 0;
            $pendingOrders   = 0;
        }

        try {
            $packages = Package::latest()->get();
        } catch (\Throwable $e) {
            $packages = collect();
        }

        try {
            $users = User::latest()->get();
        } catch (\Throwable $e) {
            $users = collect();
        }

        return view('admin', compact(
            'orders',
            'totalOrders',
            'completedOrders',
            'pendingOrders',
            'packages',
            'users'
        ));
    }

    /**
     * Simpan paket wisata baru ke database MySQL.
     * Route: POST /admin/packages
     */
    public function storePackage(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_paket'  => 'required|string|max:255',
            'harga'       => 'required|string|max:100',
            'destinasi'   => 'required|string|max:100',
            'kategori'    => 'required|string|max:100',
            'durasi'      => 'required|string|max:100',
            'makan'       => 'nullable|string|max:255',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'itinerary'   => 'nullable|string', // JSON string dari JS
        ], [
            'nama_paket.required' => 'Nama paket wisata wajib diisi.',
            'harga.required'      => 'Harga paket wajib diisi.',
            'destinasi.required'  => 'Destinasi wajib dipilih.',
            'kategori.required'   => 'Kategori paket wajib dipilih.',
            'durasi.required'     => 'Durasi wajib diisi.',
            'gambar.image'        => 'File gambar harus berformat JPG, PNG, atau WEBP.',
            'gambar.max'          => 'Ukuran gambar maksimal 2MB.',
        ]);

        // --- Normalkan harga ---
        $hargaRaw     = $request->input('harga', '0');
        $hargaDisplay = $hargaRaw;
        // Hapus prefix "Rp", "Rp.", titik sebagai pemisah ribuan, lalu simpan angka
        $hargaNumeric = preg_replace('/[^0-9]/', '', $hargaRaw);
        $hargaNumeric = $hargaNumeric ?: 0;

        // Buat format display yang rapi
        if (!Str::startsWith(strtolower($hargaDisplay), 'rp')) {
            $hargaDisplay = 'Rp. ' . number_format((int) $hargaNumeric, 0, ',', '.');
        }

        // --- Proses upload gambar ---
        $gambarPath = null;
        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            // Simpan ke storage/app/public/packages/
            $gambarPath = $request->file('gambar')->store('packages', 'public');
        }

        // --- Parse itinerary JSON ---
        $itinerary = null;
        if ($request->filled('itinerary')) {
            $decoded = json_decode($request->input('itinerary'), true);
            $itinerary = is_array($decoded) ? $decoded : null;
        }

        // --- Generate slug unik ---
        $baseSlug = Str::slug($request->input('nama_paket'));
        $slug     = $baseSlug ?: 'paket-' . now()->timestamp;
        // Pastikan slug unik
        $count = 1;
        while (Package::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        // --- Simpan ke database ---
        $userSession = session('user');
        $userId      = $userSession['id'] ?? null;

        $package = Package::create([
            'nama_paket'   => $request->input('nama_paket'),
            'slug'         => $slug,
            'destinasi'    => $request->input('destinasi'),
            'kategori'     => $request->input('kategori'),
            'durasi'       => $request->input('durasi'),
            'makan'        => $request->input('makan'),
            'deskripsi'    => $request->input('deskripsi'),
            'harga'        => $hargaNumeric,
            'harga_display'=> $hargaDisplay,
            'gambar'       => $gambarPath,
            'itinerary'    => $itinerary,
            'is_active'    => true,
            'created_by'   => $userId,
        ]);

        return redirect()->route('admin')
            ->with('success', "Paket wisata \"{$package->nama_paket}\" berhasil disimpan ke database!");
    }

    /**
     * Hapus paket wisata dari database.
     * Route: DELETE /admin/packages/{id}
     */
    public function destroyPackage(int $id)
    {
        try {
            $package = Package::findOrFail($id);
            $nama    = $package->nama_paket;

            // Hapus file gambar dari storage jika ada
            if ($package->gambar) {
                Storage::disk('public')->delete($package->gambar);
            }

            $package->delete();

            return redirect()->route('admin')
                ->with('success', "Paket wisata \"{$nama}\" berhasil dihapus.");
        } catch (\Throwable $e) {
            return redirect()->route('admin')
                ->with('error', 'Gagal menghapus paket wisata.');
        }
    }
}
