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

        return view('admin', compact(
            'packages', 
            'orders', 
            'users', 
            'totalOrders', 
            'completedOrders', 
            'pendingOrders', 
            'totalRevenue'
        ));
    }

    /**
     * Tambah Paket Wisata Baru ke Database
     */
    public function storePackage(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'durasi' => 'required|string',
            'destinasi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $baseSlug = Str::slug($request->nama_paket);
        $slug = $baseSlug;

        // Cegah error Duplicate Entry Slug dengan memberi penanda unik jika sudah ada
        if (Package::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . time();
        }

        // Upload Gambar
        $gambarPath = 'images/jogja.jpg';
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('packages', 'public');
            $gambarPath = 'storage/' . $path;
        }

        Package::create([
            'nama_paket' => $request->nama_paket,
            'slug' => $slug,
            'harga' => $request->harga,
            'harga_display' => 'Rp.' . number_format($request->harga, 0, ',', '.'),
            'durasi' => $request->durasi,
            'destinasi' => $request->destinasi,
            'kategori' => $request->kategori ?? 'jawa',
            'makan' => $request->makan ?? 'Makan Sesuai Program',
            'deskripsi' => $request->deskripsi ?? 'Deskripsi paket wisata.',
            'gambar' => $gambarPath,
            'itinerary' => $request->itinerary ?? [],
        ]);

        return redirect()->back()->with('success', 'Paket wisata berhasil ditambahkan!');
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