<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            OrderSeeder::class,
        ]);

        $paketData = \App\Http\Controllers\PaketWisataController::getPaketData();
        foreach ($paketData as $item) {
            \App\Models\Package::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'nama_paket'    => $item['name'],
                    'destinasi'     => $item['location'],
                    'kategori'      => $item['category'],
                    'durasi'        => $item['duration'],
                    'makan'         => 'Makan Sesuai Program',
                    'deskripsi'     => $item['description'] ?? '',
                    'harga'         => $item['price_raw'] ?? 0,
                    'harga_display' => $item['price'] ?? 'Rp. 0',
                    'gambar'        => $item['image'] ?? 'images/jogja.jpg',
                    'itinerary'     => $item['itinerary'] ?? [],
                    'is_active'     => true,
                ]
            );
        }
    }
}
