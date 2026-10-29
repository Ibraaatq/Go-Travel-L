<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('db:cek', function () {
    $this->info("==================================================");
    $this->info("   CEK STATUS DATABASE GO TRAVEL (TiDB CLOUD)     ");
    $this->info("==================================================");

    try {
        $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
        $this->line("<fg=green;options=bold>✓ Koneksi Database Berhasil!</>");
        $this->line("Host: " . config('database.connections.mysql.host'));
        $this->line("Database: " . config('database.connections.mysql.database'));
    } catch (\Throwable $e) {
        $this->error("✗ Gagal terhubung ke database: " . $e->getMessage());
        return;
    }

    $this->newLine();
    $this->info("--- 1. DAFTAR PENGGUNA & ADMIN (Tabel: users) ---");
    $users = \App\Models\User::all();
    if ($users->isEmpty()) {
        $this->warn("Belum ada data user.");
    } else {
        $headers = ['ID', 'Nama', 'Email', 'Role', 'Dibuat Pada'];
        $rows = $users->map(fn($u) => [$u->id, $u->name, $u->email, $u->role, $u->created_at?->format('d/m/Y H:i') ?: '-'])->toArray();
        $this->table($headers, $rows);
    }

    $this->newLine();
    $this->info("--- 2. DAFTAR PESANAN TIKET (Tabel: orders) ---");
    $orders = \App\Models\Order::latest()->take(10)->get();
    if ($orders->isEmpty()) {
        $this->warn("Belum ada data pesanan.");
    } else {
        $headers = ['ID', 'Pemesan', 'No HP', 'Paket', 'Peserta', 'Total', 'Status'];
        $rows = $orders->map(fn($o) => [
            $o->id,
            $o->nama_pemesan,
            $o->nomor_hp,
            $o->nama_paket,
            $o->jumlah_peserta . ' org',
            'Rp ' . number_format((float)$o->total_pembayaran, 0, ',', '.'),
            $o->status
        ])->toArray();
        $this->table($headers, $rows);
    }

    $this->newLine();
    $this->info("--- 3. DAFTAR PESAN MASUK KONTAK (Tabel: contacts) ---");
    $contacts = \App\Models\Contact::latest()->take(10)->get();
    if ($contacts->isEmpty()) {
        $this->warn("Belum ada pesan masuk.");
    } else {
        $headers = ['ID', 'Nama', 'Email', 'No HP', 'Isi Pesan', 'Waktu'];
        $rows = $contacts->map(fn($c) => [
            $c->id,
            $c->name ?: $c->nama_lengkap,
            $c->email,
            $c->phone ?: $c->nomor_telepon,
            \Illuminate\Support\Str::limit($c->message ?: $c->pesan, 40),
            $c->created_at?->format('d/m/Y H:i') ?: '-'
        ])->toArray();
        $this->table($headers, $rows);
    }

    $this->newLine();
    $this->info("--- 4. DAFTAR PAKET WISATA (Tabel: packages) ---");
    $this->line("Total Paket Wisata: <fg=cyan;options=bold>" . \App\Models\Package::count() . " paket</>");

    $this->newLine();
    $this->info("==================================================");
    $this->info("         SEMUA DATA TERSINKRONISASI AKTIF         ");
    $this->info("==================================================");
})->purpose('Cek data pengguna, pesanan, dan pesan kontak di database');

