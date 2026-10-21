<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PaketWisataController;
use App\Models\Package;

class DestinasiController extends Controller
{
    /**
     * Data master destinasi wisata
     */
    public static function getDestinasiData()
    {
        return [
            'yogyakarta' => [
                'slug' => 'yogyakarta',
                'name' => 'Yogyakarta',
                'category' => 'jawa populer',
                'image' => 'images/jogja.jpg',
                'description' => 'Kota budaya dengan keindahan candi bersejarah, keraton, dan wisata kuliner khas.',
                'package_slugs' => ['jogja', 'malioboro'],
            ],
            'bandung' => [
                'slug' => 'bandung',
                'name' => 'Bandung',
                'category' => 'jawa populer',
                'image' => 'images/bandung.jpg',
                'description' => 'Kota kembang berhawa sejuk dengan pesona wisata kawah alam dan belanja modern.',
                'package_slugs' => ['tangkuban-perahu', 'bandung'],
            ],
            'jakarta' => [
                'slug' => 'jakarta',
                'name' => 'Jakarta',
                'category' => 'jawa populer',
                'image' => 'images/jakarta.jpg',
                'description' => 'Ibu kota metropolitan dengan ragam wisata sejarah, hiburan modern, dan museum.',
                'package_slugs' => [], // Belum memiliki paket wisata (dibiarkan kosong)
            ],
            'surabaya' => [
                'slug' => 'surabaya',
                'name' => 'Surabaya',
                'category' => 'jawa',
                'image' => 'images/surabaya.jpg',
                'description' => 'Kota pahlawan bersejarah dengan jembatan Suramadu dan wisata kuliner khas.',
                'package_slugs' => [], // Belum memiliki paket wisata (dibiarkan kosong)
            ],
            'lampung' => [
                'slug' => 'lampung',
                'name' => 'Lampung',
                'category' => 'sumatera populer',
                'image' => 'images/lampung.jpg',
                'description' => 'Gerbang pulau Sumatera dengan pantai eksotis, pulau tropis, dan keindahan alam.',
                'package_slugs' => ['lampung'],
            ],
            'purwokerto' => [
                'slug' => 'purwokerto',
                'name' => 'Purwokerto',
                'category' => 'jawa',
                'image' => 'images/purwokerto.jpg',
                'description' => 'Wisata alam sejuk di lereng Gunung Slamet dengan air terjun dan hutan pinus asri.',
                'package_slugs' => [], // Belum memiliki paket wisata (dibiarkan kosong)
            ],
            'magelang' => [
                'slug' => 'magelang',
                'name' => 'Magelang',
                'category' => 'jawa populer',
                'image' => 'images/magelang.jpg',
                'description' => 'Rumah kemegahan Candi Borobudur dengan panorama perbukitan dan sunrise menawan.',
                'package_slugs' => [], // Belum memiliki paket wisata (dibiarkan kosong)
            ],
            'semarang' => [
                'slug' => 'semarang',
                'name' => 'Semarang',
                'category' => 'jawa',
                'image' => 'images/semarang.jpg',
                'description' => 'Kota pesisir bersejarah dengan pesona arsitektur Lawang Sewu dan Kota Lama.',
                'package_slugs' => [], // Belum memiliki paket wisata (dibiarkan kosong)
            ],
            'bali' => [
                'slug' => 'bali',
                'name' => 'Bali',
                'category' => 'bali populer',
                'image' => 'images/bali.jpg',
                'description' => 'Pulau Dewata dengan keindahan pantai pasir putih, pura eksotis, dan seni budaya.',
                'package_slugs' => ['pantai-pandawa', 'bali'],
            ],
            'bromo' => [
                'slug' => 'bromo',
                'name' => 'Bromo',
                'category' => 'jawa populer',
                'image' => 'images/bromo.jpg',
                'description' => 'Pesona lautan pasir dan sunrise magis berlatar pemandangan kaldera kawah aktif.',
                'package_slugs' => ['bromo'],
            ],
        ];
    }

    /**
     * Halaman index daftar destinasi
     */
    public function index()
    {
        $destinasiList = self::getDestinasiData();
        $packages = Package::where('is_active', true)->get();
        if ($packages->isEmpty()) {
            $packages = Package::all();
        }
        return view('destinasi', compact('destinasiList', 'packages'));
    }

    /**
     * Halaman paket wisata berdasarkan destinasi
     */
    public function show($slug)
    {
        $allDestinasi = self::getDestinasiData();
        $destinasi = $allDestinasi[$slug] ?? null;

        if (!$destinasi) {
            abort(404);
        }

        // Ambil paket dari MySQL yang cocok dengan nama destinasi atau slug paket
        $dbPackages = Package::where('is_active', true)
            ->where(function ($q) use ($destinasi) {
                $q->where('destinasi', 'like', '%' . $destinasi['name'] . '%')
                  ->orWhereIn('slug', $destinasi['package_slugs'] ?? []);
            })->get();

        if ($dbPackages->isNotEmpty()) {
            $packages = [];
            foreach ($dbPackages as $dbPkg) {
                $packages[] = [
                    'slug' => $dbPkg->slug,
                    'name' => $dbPkg->nama_paket,
                    'price' => $dbPkg->harga_display ?: ('Rp.' . number_format($dbPkg->harga, 0, ',', '.')),
                    'duration' => $dbPkg->durasi,
                    'max_people' => 'Max 40 Orang',
                    'location' => $dbPkg->destinasi,
                    'rating' => 4.9,
                    'image' => $dbPkg->gambar ? (str_starts_with($dbPkg->gambar, 'images/') ? $dbPkg->gambar : 'storage/' . $dbPkg->gambar) : 'images/jogja.jpg',
                    'category' => $dbPkg->kategori,
                ];
            }
        } else {
            $allPackages = PaketWisataController::getPaketData();
            $packages = [];

            foreach ($destinasi['package_slugs'] as $pkgSlug) {
                if (isset($allPackages[$pkgSlug])) {
                    $packages[] = $allPackages[$pkgSlug];
                }
            }
        }

        return view('detail-destinasi', compact('destinasi', 'packages'));
    }
}
