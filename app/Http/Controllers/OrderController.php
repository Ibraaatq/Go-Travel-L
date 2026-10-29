<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paket_slug'           => 'required|string',
            'nama_paket'           => 'required|string',
            'kota_keberangkatan'   => 'required|string',
            'tanggal_keberangkatan'=> 'required|string',
            'titik_kumpul'         => 'required|string',
            'jumlah_peserta'       => 'required|integer|min:1',
            'catatan'              => 'nullable|string',
            'nama_pemesan'         => 'required|string|max:255',
            'nomor_hp'             => 'required|string|max:50',
            'email_pemesan'        => 'required|email|max:255',
            'nama_instansi'        => 'nullable|string|max:255',
            'skema_pembayaran'     => 'required|string',
            'total_pembayaran'     => 'required',
            'bukti_pembayaran'     => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
        ], [
            'bukti_pembayaran.max'   => 'Ukuran file bukti pembayaran maksimal adalah 10MB.',
            'bukti_pembayaran.mimes' => 'Format file bukti pembayaran harus JPG, PNG, WEBP, atau PDF.',
        ]);

        // Resolve user_id jika sudah login
        $userId = Auth::id();
        if (!$userId && session()->has('user.email')) {
            $user = User::where('email', session('user.email'))->first();
            if ($user) {
                $userId = $user->id;
            }
        }

        // Bersihkan total_pembayaran ke numerik
        $totalRaw = $validated['total_pembayaran'];
        if (is_string($totalRaw)) {
            $totalRaw = preg_replace('/[^0-9]/', '', $totalRaw);
        }
        $total = (float) ($totalRaw ?: 0);

        // Upload bukti pembayaran (disimpan permanen sebagai Base64 Data URI di database agar kompatibel dengan Vercel Serverless)
        $buktiPath = null;
        if ($request->filled('bukti_pembayaran_base64')) {
            $buktiPath = $request->input('bukti_pembayaran_base64');
        } elseif ($request->hasFile('bukti_pembayaran') && $request->file('bukti_pembayaran')->isValid()) {
            try {
                $file = $request->file('bukti_pembayaran');
                $mime = $file->getMimeType() ?: 'image/jpeg';
                $content = file_get_contents($file->getRealPath());
                if ($content !== false) {
                    $buktiPath = 'data:' . $mime . ';base64,' . base64_encode($content);
                }
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Upload file base64 error: ' . $e->getMessage());
            }
        }

        try {
            $order = Order::create([
                'user_id'               => $userId,
                'paket_slug'            => $validated['paket_slug'],
                'nama_paket'            => $validated['nama_paket'],
                'kota_keberangkatan'    => $validated['kota_keberangkatan'],
                'tanggal_keberangkatan' => $validated['tanggal_keberangkatan'],
                'titik_kumpul'          => $validated['titik_kumpul'],
                'jumlah_peserta'        => (int) $validated['jumlah_peserta'],
                'catatan'               => $validated['catatan'] ?? null,
                'nama_pemesan'          => $validated['nama_pemesan'],
                'nomor_hp'              => $validated['nomor_hp'],
                'email_pemesan'         => $validated['email_pemesan'],
                'nama_instansi'         => $validated['nama_instansi'] ?? null,
                'skema_pembayaran'      => $validated['skema_pembayaran'],
                'total_pembayaran'      => $total,
                'status'                => 'dipending',
                'bukti_pembayaran'      => $buktiPath,
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pesanan berhasil disimpan ke database!',
                    'order'   => $order,
                ]);
            }

            return redirect()->back()->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Throwable $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan pesanan ke database: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Update order status (for admin panel).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, string|int $id)
    {
        $order  = Order::findOrFail($id);
        $status = $request->input('status', 'selesai');
        $order->update(['status' => strtolower($status)]);

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diperbarui!',
            'order'   => $order,
        ]);
    }
}
