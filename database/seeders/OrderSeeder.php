<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'paket_slug' => 'jogja',
                'nama_paket' => 'Jogja Tour 2 Hari',
                'kota_keberangkatan' => 'Lampung',
                'tanggal_keberangkatan' => '05 Agustus 2026',
                'titik_kumpul' => 'Pool Bus GO Travel (Pusat Kota)',
                'jumlah_peserta' => 6,
                'catatan' => 'Tidak ada catatan',
                'nama_pemesan' => 'Alexa Lubeille R.',
                'nomor_hp' => '0987-3572-3833',
                'email_pemesan' => 'alexaxaxa@gmail.com',
                'nama_instansi' => 'Keluarga Alexa',
                'skema_pembayaran' => 'full',
                'total_pembayaran' => 13200000,
                'status' => 'dipending',
                'created_at' => '2026-08-01 10:00:00',
            ],
            [
                'paket_slug' => 'bandung',
                'nama_paket' => 'Bandung Tour 4 Hari',
                'kota_keberangkatan' => 'Jakarta',
                'tanggal_keberangkatan' => '09 Agustus 2026',
                'titik_kumpul' => 'Stasiun Kereta Api Utama',
                'jumlah_peserta' => 8,
                'catatan' => 'Minta kursi baris depan untuk lansia',
                'nama_pemesan' => 'Nadia Putri',
                'nomor_hp' => '0859-3555-4829',
                'email_pemesan' => 'nadiaputri@gmail.com',
                'nama_instansi' => 'PT Nadia Medika',
                'skema_pembayaran' => 'full',
                'total_pembayaran' => 14400000,
                'status' => 'selesai',
                'created_at' => '2026-08-06 14:20:00',
            ],
            [
                'paket_slug' => 'bali',
                'nama_paket' => 'Bali Tour 5 Hari',
                'kota_keberangkatan' => 'Surabaya',
                'tanggal_keberangkatan' => '29 Agustus 2026',
                'titik_kumpul' => 'Bandara Internasional',
                'jumlah_peserta' => 4,
                'catatan' => 'Tidak ada catatan',
                'nama_pemesan' => 'Raka Pratama',
                'nomor_hp' => '0824-7872-3844',
                'email_pemesan' => 'rakapratama@gmail.com',
                'nama_instansi' => 'Raka Family Trip',
                'skema_pembayaran' => 'full',
                'total_pembayaran' => 11000000,
                'status' => 'selesai',
                'created_at' => '2026-08-27 09:15:00',
            ],
            [
                'paket_slug' => 'lampung',
                'nama_paket' => 'Lampung Tour 3 Hari',
                'kota_keberangkatan' => 'Jakarta',
                'tanggal_keberangkatan' => '25 Juli 2026',
                'titik_kumpul' => 'Pool Bus GO Travel (Pusat Kota)',
                'jumlah_peserta' => 7,
                'catatan' => 'Perjalanan liburan keluarga',
                'nama_pemesan' => 'Alya Ramadhani',
                'nomor_hp' => '0928-7533-2088',
                'email_pemesan' => 'alyaramadhani@gmail.com',
                'nama_instansi' => 'Keluarga Ramadhani',
                'skema_pembayaran' => 'full',
                'total_pembayaran' => 6825000,
                'status' => 'selesai',
                'created_at' => '2026-07-18 16:45:00',
            ],
            [
                'paket_slug' => 'bromo',
                'nama_paket' => 'Bromo Tour 1 Hari',
                'kota_keberangkatan' => 'Surabaya',
                'tanggal_keberangkatan' => '27 Juli 2026',
                'titik_kumpul' => 'Stasiun Kereta Api Utama',
                'jumlah_peserta' => 10,
                'catatan' => 'Trip bareng rekan kerja',
                'nama_pemesan' => 'Fajar Maulana',
                'nomor_hp' => '0925-4489-3877',
                'email_pemesan' => 'fajarmaulana@gmail.com',
                'nama_instansi' => 'Divisi Marketing PT Kreatif',
                'skema_pembayaran' => 'full',
                'total_pembayaran' => 4990000,
                'status' => 'selesai',
                'created_at' => '2026-07-19 11:30:00',
            ],
        ];

        foreach ($orders as $orderData) {
            Order::create($orderData);
        }
    }
}
