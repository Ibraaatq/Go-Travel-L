<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket_slug' => 'required|string',
            'nama_paket' => 'required|string',
            'kota_keberangkatan' => 'required|string',
            'tanggal_keberangkatan' => 'required|string',
            'titik_kumpul' => 'required|string',
            'jumlah_peserta' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
            'nama_pemesan' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:50',
            'email_pemesan' => 'required|email|max:255',
            'nama_instansi' => 'nullable|string|max:255',
            'skema_pembayaran' => 'required|string',
            'total_pembayaran' => 'required',
        ]);

        // Resolve user_id if logged in
        $userId = Auth::id();
        if (!$userId && session()->has('user.email')) {
            $user = User::where('email', session('user.email'))->first();
            if ($user) {
                $userId = $user->id;
            }
        }

        // Clean total_pembayaran to numeric
        $totalRaw = $validated['total_pembayaran'];
        if (is_string($totalRaw)) {
            $totalRaw = preg_replace('/[^0-9]/', '', $totalRaw);
        }
        $total = (float) ($totalRaw ?: 0);

        $order = Order::create([
            'user_id' => $userId,
            'paket_slug' => $validated['paket_slug'],
            'nama_paket' => $validated['nama_paket'],
            'kota_keberangkatan' => $validated['kota_keberangkatan'],
            'tanggal_keberangkatan' => $validated['tanggal_keberangkatan'],
            'titik_kumpul' => $validated['titik_kumpul'],
            'jumlah_peserta' => (int) $validated['jumlah_peserta'],
            'catatan' => $validated['catatan'] ?? null,
            'nama_pemesan' => $validated['nama_pemesan'],
            'nomor_hp' => $validated['nomor_hp'],
            'email_pemesan' => $validated['email_pemesan'],
            'nama_instansi' => $validated['nama_instansi'] ?? null,
            'skema_pembayaran' => $validated['skema_pembayaran'],
            'total_pembayaran' => $total,
            'status' => 'dipending',
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil disimpan ke database!',
                'order' => $order,
            ]);
        }

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Update order status (for admin panel).
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $request->input('status', 'selesai');
        $order->update(['status' => strtolower($status)]);

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diperbarui!',
            'order' => $order,
        ]);
    }
}
