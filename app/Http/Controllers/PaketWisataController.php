<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    /**
     * Data master paket wisata lengkap (24 Paket: Halaman 1, 2, dan 3)
     */
    public static function getPaketData()
    {
        return [
            // ==================== HALAMAN 1 ====================
            'tangkuban-perahu' => [
                'slug' => 'tangkuban-perahu',
                'name' => 'Tangkuban Perahu Tour 1 Hari',
                'price' => 'Rp.200.000',
                'price_raw' => 200000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Lembang, Subang, Jawa Barat',
                'rating' => 4.8,
                'reviews_count' => 124,
                'image' => 'images/tangkuban.jpg',
                'category' => 'jawa 1hari',
                'page' => 1,
                'description' => 'Nikmati keindahan kawah Gunung Tangkuban Perahu yang melegenda dan udara sejuk pegunungan Lembang. Paket ini dirancang khusus untuk liburan singkat yang menyegarkan bersama keluarga, teman, atau rekan kantor dengan armada bus pariwisata yang nyaman.',
                'highlights' => [
                    'Kawah Ratu Tangkuban Perahu',
                    'Kawah Domas & Pemandian Air Hangat',
                    'Wisata Belanja & Kuliner Tahu Lembang',
                    'Kebun Teh Ciater'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & bersih'],
                    ['icon' => 'fa-solid fa-user-tie', 'title' => 'Driver & Tour Leader', 'desc' => 'Ramah & profesional'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Wisata', 'desc' => 'Semua destinasi utama'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan & Air Mineral', 'desc' => '1x Makan siang & snack']
                ],
                'inclusions' => [
                    'Bus Pariwisata Executive AC (Reclining Seat, Audio, TV)',
                    'Tiket masuk kawasan Gunung Tangkuban Perahu',
                    '1x Makan Siang di Restoran Lokal',
                    'Snack Box & Air Mineral botol per peserta',
                    'BBM, Biaya Tol, dan Parkir bus',
                    'Driver berpengalaman & Tour Leader',
                    'P3K Standar Perjalanan'
                ],
                'exclusions' => [
                    'Pengeluaran pribadi (oleh-oleh, belanja pribadi)',
                    'Tiket wahana tambahan di luar paket',
                    'Tips sukarela untuk Driver & Crew'
                ],
                'important_info' => [
                    'Membawa pakaian hangat / jaket karena suhu di area kawah cukup dingin.',
                    'Gunakan masker saat berada di sekitar kawah aktif karena aroma belerang.',
                    'Dianjurkan memakai sepatu atau sandal yang nyaman untuk berjalan di area bebatuan.',
                    'Waktu berkumpul di titik temu maksimal 15 menit sebelum keberangkatan.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Eksplorasi Tangkuban Perahu & Lembang',
                        'schedules' => [
                            ['time' => '06:30 - 07:00', 'activity' => 'Berkumpul di meeting point & briefing perjalanan bersama Tour Leader'],
                            ['time' => '07:00 - 09:30', 'activity' => 'Perjalanan menuju Tangkuban Perahu dengan bus pariwisata ber-AC'],
                            ['time' => '09:30 - 12:00', 'activity' => 'Tiba di kawasan Gunung Tangkuban Perahu, eksplorasi Kawah Ratu & spot foto'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Istirahat, ibadah, dan makan siang bersama di restoran lokal khas Sunda'],
                            ['time' => '13:30 - 15:30', 'activity' => 'Kunjungan ke Kawah Domas dan Kebun Teh Ciater'],
                            ['time' => '15:30 - 17:00', 'activity' => 'Wisata belanja oleh-oleh khas Lembang (Tahu Susu, Bolu Susu, Keripik)'],
                            ['time' => '17:00 - 19:30', 'activity' => 'Perjalanan kembali menuju meeting point asal. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'jogja' => [
                'slug' => 'jogja',
                'name' => 'Jogja Tour 2 Hari',
                'price' => 'Rp.2.200.000',
                'price_raw' => 2200000,
                'duration' => '2 Hari 1 Malam',
                'max_people' => 'Max 40 Orang',
                'location' => 'D.I. Yogyakarta',
                'rating' => 4.9,
                'reviews_count' => 218,
                'image' => 'images/jogja.jpg',
                'category' => 'jawa menginap',
                'page' => 1,
                'description' => 'Jelajahi keindahan budaya, sejarah, dan pesona alam kota Yogyakarta. Mengunjungi Candi Prambanan, Pantai Parangtritis, Tebing Breksi, hingga suasana malam syahdu di kawasan Malioboro dengan fasilitas hotel berbintang.',
                'highlights' => [
                    'Candi Prambanan & Tebing Breksi',
                    'Pantai Parangtritis & Sunset View',
                    'Kawasan Malioboro & Titik Nol KM',
                    'Pusat Oleh-oleh Bakpia Pathok'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata Luxury', 'desc' => 'Full AC, TV, WiFi & USB Charger'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3/4', 'desc' => '1 Malam twin/triple share'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Sesuai Jadwal', 'desc' => '3x Makan & 1x Sarapan Hotel'],
                    ['icon' => 'fa-solid fa-map-location-dot', 'title' => 'Tour Guide Lokal', 'desc' => 'Pemandu wisata bersertifikat']
                ],
                'inclusions' => [
                    'Bus Pariwisata Executive AC selama 2 hari',
                    'Akomodasi 1 Malam di Hotel Bintang 3 (sekamar berdua/bertiga)',
                    'Tiket masuk semua objek wisata sesuai itinerary',
                    '3x Makan (1x Breakfast, 2x Lunch, 1x Dinner)',
                    'Air mineral botol 600ml setiap hari',
                    'BBM, Tol Trans Jawa, Retribusi & Parkir Bus',
                    'Tour Guide / Tour Leader profesional',
                    'Banner rombongan & Dokumentasi standar'
                ],
                'exclusions' => [
                    'Tiket transportasi dari kota asal ke meeting point (jika di luar rute)',
                    'Pengeluaran pribadi & room service di hotel',
                    'Tipping driver & guide'
                ],
                'important_info' => [
                    'Check-in hotel dimulai pukul 14:00 WIB dan check-out maksimal pukul 12:00 WIB.',
                    'Bawa perlengkapan ibadah, obat-obatan pribadi, dan pakaian ganti secukupnya.',
                    'Wajib membawa kartu identitas (KTP/SIM/Paspor) saat check-in hotel.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Candi Prambanan, Tebing Breksi & Sunset Parangtritis',
                        'schedules' => [
                            ['time' => '07:00 - 08:00', 'activity' => 'Penjemputan peserta di Meeting Point Yogyakarta & Welcome Snack'],
                            ['time' => '08:30 - 11:30', 'activity' => 'Wisata edukasi & sejarah di Kompleks Candi Prambanan'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang di resto lokal khas masakan Jawa'],
                            ['time' => '14:00 - 15:30', 'activity' => 'Mengunjungi Tebing Breksi dengan pemandangan ukiran batu alam unik'],
                            ['time' => '16:30 - 18:30', 'activity' => 'Menikmati sunset eksotis di Pantai Parangtritis'],
                            ['time' => '19:00 - 20:30', 'activity' => 'Makan malam kuliner Gudeg Jogja & Check-in Hotel'],
                            ['time' => '20:30 - Bebas', 'activity' => 'Waktu santai atau jalan-jalan mandiri di sekitar Malioboro']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Keraton Jogja, Belanja Bakpia & Kepulangan',
                        'schedules' => [
                            ['time' => '07:00 - 08:30', 'activity' => 'Sarapan pagi di hotel dan proses check-out kamar'],
                            ['time' => '09:00 - 11:00', 'activity' => 'Wisata sejarah ke Keraton Yogyakarta & Tamansari Water Castle'],
                            ['time' => '11:30 - 13:00', 'activity' => 'Makan siang di restoran lokal'],
                            ['time' => '13:30 - 15:30', 'activity' => 'Pusat oleh-oleh khas Jogja (Bakpia Kukus, Kaos Dagadu, Batik)'],
                            ['time' => '16:00 - Selesai', 'activity' => 'Pengantaran peserta ke stasiun/bandara/titik drop-off. Tour berakhir.']
                        ]
                    ]
                ]
            ],

            'malioboro' => [
                'slug' => 'malioboro',
                'name' => 'Malioboro Tour 1 Hari',
                'price' => 'Rp.249.000',
                'price_raw' => 249000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Kota Yogyakarta',
                'rating' => 4.7,
                'reviews_count' => 96,
                'image' => 'images/malioboro.jpg',
                'category' => 'jawa 1hari',
                'page' => 1,
                'description' => 'Paket city tour seru satu hari di jantung kebudayaan Yogyakarta. Mengitari kawasan bersejarah Malioboro, Titik Nol Kilometer, Pasar Beringharjo, hingga Museum Benteng Vredeburg.',
                'highlights' => [
                    'Jalan Malioboro & Titik Nol KM',
                    'Pasar Tradisional Beringharjo',
                    'Benteng Vredeburg',
                    'Sentra Bakpia Pathok'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Nyaman & full audio'],
                    ['icon' => 'fa-solid fa-user-tie', 'title' => 'Tour Leader', 'desc' => 'Memandu seluruh rute'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk', 'desc' => 'Museum & Destinasi'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan & Snack', 'desc' => '1x Makan siang & air mineral']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC nyaman',
                    'Tiket masuk Benteng Vredeburg & Objek wisata',
                    '1x Makan Siang Kuliner Khas Jogja',
                    'Snack & Air Mineral botol',
                    'BBM, Parkir, dan Retribusi Kawasan Malioboro',
                    'Tour Leader ramah dan informatif'
                ],
                'exclusions' => [
                    'Sewa andong / becak wisata di Malioboro',
                    'Belanja pribadi dan oleh-oleh',
                    'Tip crew'
                ],
                'important_info' => [
                    'Gunakan pakaian yang santai dan menyerap keringat.',
                    'Siapkan uang tunai kecil untuk berbelanja di Pasar Beringharjo.',
                    'Jaga barang bawaan saat berada di keramaian Malioboro.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'City Tour Heritage & Shopping Malioboro',
                        'schedules' => [
                            ['time' => '07:30 - 08:00', 'activity' => 'Kumpul di titik temu dan keberangkatan'],
                            ['time' => '08:30 - 11:30', 'activity' => 'Jelajah Museum Benteng Vredeburg & Titik Nol Kilometer Jogja'],
                            ['time' => '11:30 - 13:00', 'activity' => 'Makan siang kuliner khas di sekitar Malioboro'],
                            ['time' => '13:00 - 15:30', 'activity' => 'Waktu bebas berbelanja batik & souvenir di Pasar Beringharjo & Malioboro'],
                            ['time' => '15:30 - 17:30', 'activity' => 'Kunjungan ke sentra oleh-oleh Bakpia Pathok langsung dari pabrik'],
                            ['time' => '17:30 - 18:30', 'activity' => 'Perjalanan kembali ke titik temu awal. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'bromo' => [
                'slug' => 'bromo',
                'name' => 'Bromo Tour 1 Hari',
                'price' => 'Rp.499.000',
                'price_raw' => 499000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Taman Nasional Bromo Tengger Semeru, Jawa Timur',
                'rating' => 5.0,
                'reviews_count' => 342,
                'image' => 'images/bromo.jpg',
                'category' => 'jawa 1hari',
                'page' => 1,
                'description' => 'Saksikan matahari terbit spektakuler paling ikonik di Indonesia berlatar belakang Gunung Bromo, Batok, dan Semeru. Termasuk petualangan seru naik Jeep Hardtop 4x4 di Lautan Pasir dan Kawah Bromo.',
                'highlights' => [
                    'Sunrise View Point Penanjakan / Kingkong Hill',
                    'Kawah Aktif Gunung Bromo & Pura Luhur Poten',
                    'Pasir Berbisik (Lautan Pasir Bromo)',
                    'Padang Savana & Bukit Teletubbies'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-truck-monster', 'title' => 'Jeep 4x4 Bromo', 'desc' => 'Kapasitas 6 orang per jeep'],
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Antar jemput meeting point'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket TNBTS', 'desc' => 'Tiket resmi Taman Nasional'],
                    ['icon' => 'fa-solid fa-mug-hot', 'title' => 'Makan & Minuman Hangat', 'desc' => 'Sarapan pagi di resto lokal']
                ],
                'inclusions' => [
                    'Bus Pariwisata AC dari Meeting Point (Surabaya/Malang)',
                    'Sewa Jeep 4WD Hardtop untuk keliling spot Bromo',
                    'Tiket masuk resmi Taman Nasional Bromo Tengger Semeru',
                    '1x Sarapan Pagi di Resto Transit Bromo',
                    'Air mineral & Masker sekali pakai',
                    'Driver Bus, Driver Jeep & Tour Leader handal',
                    'BBM & Biaya Parkir'
                ],
                'exclusions' => [
                    'Sewa kuda di area Lautan Pasir Bromo (opsional)',
                    'Sewa jaket / sarung tangan tebal',
                    'Pengeluaran pribadi'
                ],
                'important_info' => [
                    'Suhu udara dini hari di Bromo bisa mencapai 5°C - 10°C, wajib membawa jaket tebal, syal, kupluk, dan sarung tangan.',
                    'Gunakan sepatu gunung atau sneakers anti-selip.',
                    'Bawa obat pribadi bagi yang memiliki riwayat asma atau alergi dingin.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Sunrise Penanjakan, Kawah Bromo & Bukit Teletubbies',
                        'schedules' => [
                            ['time' => '00:00 - 01:00', 'activity' => 'Meeting point di Malang/Surabaya & perjalanan ke pos transit Bromo'],
                            ['time' => '02:30 - 03:30', 'activity' => 'Tiba di pos transit, oper ke Jeep 4x4 menuju Sunrise Point'],
                            ['time' => '04:30 - 06:00', 'activity' => 'Menikmati Golden Sunrise Bromo yang megah & sesi foto'],
                            ['time' => '06:30 - 08:30', 'activity' => 'Jelajah Kawah Bromo & Pura Luhur Poten (bisa jalan kaki / naik kuda)'],
                            ['time' => '08:30 - 09:30', 'activity' => 'Foto seru di Lautan Pasir Berbisik'],
                            ['time' => '09:30 - 10:30', 'activity' => 'Eksplorasi Padang Savana Bukit Teletubbies yang hijau nan asri'],
                            ['time' => '11:00 - 12:30', 'activity' => 'Kembali ke pos transit, bersih-bersih, sarapan & istirahat'],
                            ['time' => '13:00 - 15:30', 'activity' => 'Perjalanan kembali menuju meeting point. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'pantai-pandawa' => [
                'slug' => 'pantai-pandawa',
                'name' => 'Pantai Pandawa Tour 1 Hari',
                'price' => 'Rp.175.000',
                'price_raw' => 175000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Kuta Selatan, Badung, Bali',
                'rating' => 4.8,
                'reviews_count' => 189,
                'image' => 'images/pandawa.jpg',
                'category' => 'bali 1hari',
                'page' => 1,
                'description' => 'Nikmati pesona pantai pasir putih tersembunyi di balik tebing kapur megah dengan patung Panca Pandawa. Dilengkapi dengan watersport seru dan pemandangan sunset di Bali Selatan.',
                'highlights' => [
                    'Tebing Kapur & Patung Panca Pandawa',
                    'Pantai Pasir Putih & Kano Pantai Pandawa',
                    'Pantai Melasti & Tebing Eksotis',
                    'Pusat Oleh-oleh Krisna Bali'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & dingin'],
                    ['icon' => 'fa-solid fa-umbrella-beach', 'title' => 'Akses Pantai', 'desc' => 'Tiket masuk Pandawa & Melasti'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Siang', 'desc' => '1x Makan siang resto lokal'],
                    ['icon' => 'fa-solid fa-person-swimming', 'title' => 'Aktivitas Pantai', 'desc' => 'Spot foto & watersport']
                ],
                'inclusions' => [
                    'Bus Pariwisata AC Full Day',
                    'Tiket masuk Pantai Pandawa & Pantai Melasti',
                    '1x Makan Siang masakan khas Bali / Halal',
                    'Air mineral dingin selama perjalanan',
                    'BBM, Tol Bali Mandara & Parkir',
                    'Tour Guide lokal Bali bersertifikat'
                ],
                'exclusions' => [
                    'Sewa Kano / Payung Pantai / Kano di Pandawa',
                    'Watersport tambahan',
                    'Pengeluaran pribadi'
                ],
                'important_info' => [
                    'Bawa pakaian ganti, handuk, dan kacamata hitam.',
                    'Gunakan tabir surya (sunscreen) untuk melindungi kulit dari terik matahari.',
                    'Tersedia fasilitas toilet dan tempat bilas di area pantai.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Eksotisme Pantai Selatan Bali',
                        'schedules' => [
                            ['time' => '08:00 - 08:30', 'activity' => 'Penjemputan di hotel / meeting point area Bali'],
                            ['time' => '09:30 - 12:30', 'activity' => 'Eksplorasi Pantai Pandawa: foto di tebing patung & main kano'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang di restoran lokal dengan menu lezat'],
                            ['time' => '14:30 - 17:00', 'activity' => 'Mengunjungi Pantai Melasti, tebing terbelah & pantai berombak tenang'],
                            ['time' => '17:30 - 19:00', 'activity' => 'Belanja cinderamata khas Bali di Krisna / Joger'],
                            ['time' => '19:00 - 20:00', 'activity' => 'Pengantaran kembali ke titik asal. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'bandung' => [
                'slug' => 'bandung',
                'name' => 'Bandung Tour 4 Hari',
                'price' => 'Rp.1.800.000',
                'price_raw' => 1800000,
                'duration' => '4 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Bandung, Jawa Barat',
                'rating' => 4.9,
                'reviews_count' => 175,
                'image' => 'images/bandung.jpg',
                'category' => 'jawa menginap',
                'page' => 1,
                'description' => 'Paket liburan komprehensif 4 hari keliling Paris van Java. Menikmati eksotisme Kawah Putih Ciwidey, pesona alam Lembang, wisata kuliner legendaris Bandung, dan belanja factory outlet.',
                'highlights' => [
                    'Kawah Putih & Glamping Lakeside Ciwidey',
                    'Floating Market & The Great Asia Afrika Lembang',
                    'Gedung Sate & Jalan Braga Heritage',
                    'Factory Outlet Riau & Cihampelas'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata VIP', 'desc' => 'AC, Reclining Seat & Audio'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3', 'desc' => '3 Malam di pusat kota Bandung'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Paket Makan Lengkap', 'desc' => 'Sarapan, makan siang & malam'],
                    ['icon' => 'fa-solid fa-camera', 'title' => 'Dokumentasi', 'desc' => 'Foto dokumentasi tour']
                ],
                'inclusions' => [
                    'Bus Pariwisata Executive AC 4 hari',
                    'Akomodasi Hotel Bintang 3 (3 Malam Twin Sharing)',
                    'Tiket masuk semua objek wisata di itinerary',
                    '7x Makan (3x Breakfast Hotel, 4x Lunch, 3x Dinner)',
                    'Air mineral botol setiap hari & Snack welcome',
                    'BBM, Tol Cipularang, dan Retribusi Wisata',
                    'Tour Guide / Tour Leader berpengalaman'
                ],
                'exclusions' => [
                    'Pengeluaran belanja pribadi dan laundry hotel',
                    'Wahana permainan berbayar di tempat wisata',
                    'Tip supir dan tour leader'
                ],
                'important_info' => [
                    'Bawa jaket untuk kawasan Ciwidey & Lembang karena berhawa dingin.',
                    'Siapkan pakaian secukupnya untuk kegiatan 4 hari 3 malam.',
                    'Kamera siap baterai penuh untuk spot foto instagramable.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Kedatangan & Wisata Sejarah Kota Bandung',
                        'schedules' => [
                            ['time' => '09:00 - 11:30', 'activity' => 'Penjemputan rombongan & City Tour Gedung Sate & Asia Afrika'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang di resto khas Sunda'],
                            ['time' => '14:00 - 16:30', 'activity' => 'Jalan santai menyusuri Braga Heritage & Museum KAA'],
                            ['time' => '17:00 - 19:00', 'activity' => 'Check-in Hotel dan istirahat'],
                            ['time' => '19:00 - 21:00', 'activity' => 'Makan malam kuliner malam Bandung']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Pesona Alam Ciwidey (Bandung Selatan)',
                        'schedules' => [
                            ['time' => '07:00 - 08:30', 'activity' => 'Sarapan pagi di hotel & persiapan'],
                            ['time' => '08:30 - 11:30', 'activity' => 'Wisata Kawah Putih Ciwidey & Jembatan Apung'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang di kawasan Glamping Situ Patenggang'],
                            ['time' => '14:00 - 16:00', 'activity' => 'Kebun Teh Rancabali & Petik Stroberi'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam dan kembali ke hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 3',
                        'title' => 'Nuansa Cantik Lembang (Bandung Utara)',
                        'schedules' => [
                            ['time' => '07:00 - 08:30', 'activity' => 'Sarapan pagi di hotel'],
                            ['time' => '09:00 - 12:00', 'activity' => 'Mengunjungi The Great Asia Afrika Lembang'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang & santai di Floating Market Lembang'],
                            ['time' => '14:00 - 17:00', 'activity' => 'Farmhouse Susu Lembang & Wisata Belanja FO Riau'],
                            ['time' => '19:00 - 21:00', 'activity' => 'Makan malam rombongan di Dago Bakery']
                        ]
                    ],
                    [
                        'day' => 'Hari 4',
                        'title' => 'Belanja Oleh-Oleh & Kepulangan',
                        'schedules' => [
                            ['time' => '07:00 - 08:30', 'activity' => 'Sarapan pagi & check-out hotel'],
                            ['time' => '09:00 - 12:00', 'activity' => 'Pusat oleh-oleh Kartika Sari / Prima Rasa'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang penutupan'],
                            ['time' => '14:00 - Selesai', 'activity' => 'Pengantaran peserta ke stasiun/bandara. Perjalanan selesai.']
                        ]
                    ]
                ]
            ],

            'bali' => [
                'slug' => 'bali',
                'name' => 'Bali Tour 5 Hari',
                'price' => 'Rp.2.750.000',
                'price_raw' => 2750000,
                'duration' => '5 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Denpasar & Seluruh Bali',
                'rating' => 4.9,
                'reviews_count' => 310,
                'image' => 'images/bali.jpg',
                'category' => 'bali menginap',
                'page' => 1,
                'description' => 'Petualangan impian di Pulau Dewata selama 5 hari. Mengunjungi Tanah Lot, Garuda Wisnu Kencana (GWK), Pura Uluwatu, Desa Penglipuran, Kintamani, hingga makan malam romantis di Pantai Jimbaran.',
                'highlights' => [
                    'Pura Tanah Lot & Pura Ulun Danu Beratan',
                    'Taman Budaya GWK & Pura Uluwatu',
                    'Desa Adat Penglipuran & Pemandangan Kintamani',
                    'Dinner Seafood Sunset di Pantai Jimbaran'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata Luxury', 'desc' => 'Full AC & Fasilitas Hiburan'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 4', 'desc' => '4 Malam di Kuta / Legian'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Lengkap & Seafood', 'desc' => 'Termasuk BBQ Seafood Jimbaran'],
                    ['icon' => 'fa-solid fa-camera', 'title' => 'Guide & Dokumentasi', 'desc' => 'Pemandu lokal ramah']
                ],
                'inclusions' => [
                    'Bus Pariwisata Executive AC selama 5 hari di Bali',
                    '4 Malam menginap di Hotel Bintang 4 pilihan',
                    'Tiket masuk semua objek wisata sesuai program',
                    'Makan sesuai jadwal (Breakfast, Lunch, Dinner)',
                    'Spesial Dinner BBQ Seafood di Pantai Jimbaran',
                    'BBM, Tol Bali Mandara, dan Parkir seluruh destinasi',
                    'Tour Guide berlisensi resmi HPI Bali',
                    'Air mineral botol setiap hari'
                ],
                'exclusions' => [
                    'Tiket pesawat PP dari kota asal ke Bali',
                    'Watersport di Tanjung Benoa',
                    'Keperluan pribadi (mini bar, laundry, dll.)'
                ],
                'important_info' => [
                    'Harap mengenakan pakaian sopan / selendang kain sarung saat memasuki pura suci.',
                    'Dilarang memasuki area tempat ibadah bagi wanita yang sedang datang bulan (haid).',
                    'Siapkan kartu e-money / uang tunai untuk transaksi pribadi.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Kedatangan & Sunset Tanah Lot',
                        'schedules' => [
                            ['time' => '11:00 - 13:00', 'activity' => 'Penjemputan di Bandara I Gusti Ngurah Rai dengan kalungan bunga'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di restoran lokal'],
                            ['time' => '15:30 - 18:30', 'activity' => 'Wisata ke Pura Tanah Lot melihat sunset menakjubkan'],
                            ['time' => '19:00 - 20:30', 'activity' => 'Makan malam & Check-in Hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Pesona Budaya & Pantai Bali Selatan',
                        'schedules' => [
                            ['time' => '08:00 - 09:00', 'activity' => 'Sarapan pagi di hotel'],
                            ['time' => '09:30 - 12:00', 'activity' => 'Watersport di Tanjung Benoa (Banana Boat / Parasailing)'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang resto lokal'],
                            ['time' => '14:30 - 16:30', 'activity' => 'Eksplorasi Garuda Wisnu Kencana Cultural Park'],
                            ['time' => '17:00 - 18:30', 'activity' => 'Pura Uluwatu & nonton Tari Kecak di atas tebing samudra'],
                            ['time' => '19:00 - 21:00', 'activity' => 'Candlelight Dinner Seafood di bibir Pantai Jimbaran']
                        ]
                    ],
                    [
                        'day' => 'Hari 3',
                        'title' => 'Keindahan Kintamani & Desa Adat Penglipuran',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan di hotel'],
                            ['time' => '09:30 - 11:30', 'activity' => 'Desa Adat Penglipuran (desa terbersih di dunia) & Hutan Bambu'],
                            ['time' => '12:00 - 14:00', 'activity' => 'Makan siang Buffet dengan pemandangan Gunung & Danau Batur Kintamani'],
                            ['time' => '14:30 - 16:30', 'activity' => 'Pura Tirta Empul Tampaksiring & Sumber Air Suci'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam kuliner khas Bali']
                        ]
                    ],
                    [
                        'day' => 'Hari 4',
                        'title' => 'Danau Beratan Bedugul & Wisata Belanja',
                        'schedules' => [
                            ['time' => '08:00 - 09:00', 'activity' => 'Sarapan di hotel'],
                            ['time' => '10:30 - 12:30', 'activity' => 'Pura Ulun Danu Beratan Bedugul di tepi danau berkabut'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang di resto lokal Bedugul'],
                            ['time' => '15:00 - 18:00', 'activity' => 'Belanja cinderamata lengkap di Krisna Oleh-Oleh & Joger Bali'],
                            ['time' => '19:00 - 21:00', 'activity' => 'Makan malam penutupan']
                        ]
                    ],
                    [
                        'day' => 'Hari 5',
                        'title' => 'Waktu Bebas & Kepulangan',
                        'schedules' => [
                            ['time' => '08:00 - 10:00', 'activity' => 'Sarapan di hotel & waktu santai di Pantai Kuta'],
                            ['time' => '11:00 - 12:00', 'activity' => 'Check-out hotel'],
                            ['time' => '12:30 - Selesai', 'activity' => 'Pengantaran ke Bandara Ngurah Rai. Sampai jumpa di trip berikutnya!']
                        ]
                    ]
                ]
            ],

            'lampung' => [
                'slug' => 'lampung',
                'name' => 'Lampung Tour 3 Hari',
                'price' => 'Rp.975.000',
                'price_raw' => 975000,
                'duration' => '3 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Bandar Lampung & Pesawaran, Lampung',
                'rating' => 4.8,
                'reviews_count' => 112,
                'image' => 'images/lampung.jpg',
                'category' => 'sumatera menginap',
                'page' => 1,
                'description' => 'Jelajahi surga bahari di Teluk Lampung. Snorkeling di pulau eksotis Pahawang, bermain dengan lumba-lumba di Teluk Kiluan, mengunjungi Taman Nasional Way Kambas, dan menikmati kuliner lezat khas Lampung.',
                'highlights' => [
                    'Pulau Pahawang Besar & Pahawang Kecil',
                    'Spot Snorkeling Taman Nemo & Cukuh Bedil',
                    'Pantai Mutun & Pulau Tangkil',
                    'Pusat Keripik Pisang Khas Lampung'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Antar jemput rute Lampung'],
                    ['icon' => 'fa-solid fa-ship', 'title' => 'Kapal Snorkeling', 'desc' => 'Kapal eksplor pulau & alat snorkel'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3', 'desc' => '2 Malam di Bandar Lampung'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan & Barbeque', 'desc' => 'Makan siang di pulau & resto']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC selama di Lampung',
                    'Kapal sewa eksklusif untuk hopping island Pahawang',
                    'Alamat Snorkeling lengkap (Google, Snorkel, Life Jacket)',
                    'Akomodasi 2 Malam di Hotel Bintang 3',
                    'Tiket masuk semua pulau dan destinasi wisata',
                    'Makan sesuai program (termasuk makan siang ikan bakar di pulau)',
                    'Underwater photoshoot dengan kamera action cam',
                    'Tour Guide lokal & Pemandu Snorkeling',
                    'Air mineral & Snack'
                ],
                'exclusions' => [
                    'Tiket penyeberangan kapal ferry (jika rute dari Merak ke Bakauheni pribadi)',
                    'Pengeluaran belanja pribadi dan oleh-oleh',
                    'Tip supir dan boatman'
                ],
                'important_info' => [
                    'Bawa pakaian renang, sunblock, dan dry bag untuk perlengkapan elektronik.',
                    'Dianjurkan membawa kacamata hitam dan sandal pantai.',
                    'Ikuti arahan instruktur keselamatan saat melakukan kegiatan snorkeling.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Kedatangan & Pantai Mutun Tangkil',
                        'schedules' => [
                            ['time' => '09:00 - 11:00', 'activity' => 'Penjemputan di Bandara Radin Inten II / Pelabuhan Bakauheni'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang kuliner pindang patin khas Lampung'],
                            ['time' => '14:00 - 17:30', 'activity' => 'Wisata Pantai Mutun dan menyeberang ke Pulau Tangkil'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam & Check-in Hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Island Hopping & Snorkeling Pulau Pahawang',
                        'schedules' => [
                            ['time' => '07:00 - 08:00', 'activity' => 'Sarapan di hotel dan persiapan snorkeling'],
                            ['time' => '08:30 - 10:00', 'activity' => 'Menuju Dermaga Ketapang dan naik kapal jelajah pulau'],
                            ['time' => '10:00 - 12:30', 'activity' => 'Snorkeling di Cukuh Bedil & Taman Nemo, foto underwater'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang menu ikan bakar segar di Pulau Pahawang Besar'],
                            ['time' => '14:00 - 16:30', 'activity' => 'Foto di Pasir Timbul Pahawang Kecil dan Pulau Kelagian'],
                            ['time' => '17:00 - 18:30', 'activity' => 'Kembali ke dermaga & bilas'],
                            ['time' => '19:00 - 21:00', 'activity' => 'Makan malam dan kembali ke hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 3',
                        'title' => 'Sentra Oleh-Oleh Keripik Pisang & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 09:00', 'activity' => 'Sarapan pagi & check-out hotel'],
                            ['time' => '09:30 - 12:00', 'activity' => 'Belanja aneka Keripik Pisang Aneka Rasa & Kopi Lampung'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang penutupan'],
                            ['time' => '14:00 - Selesai', 'activity' => 'Pengantaran peserta ke bandara/pelabuhan. Trip selesai.']
                        ]
                    ]
                ]
            ],

            // ==================== HALAMAN 2 ====================
            'kayla-hills' => [
                'slug' => 'kayla-hills',
                'name' => 'Kayla Hills Batang Tour 2 Hari',
                'price' => 'Rp.500.000',
                'price_raw' => 500000,
                'duration' => '2 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Batang, Jawa Tengah',
                'rating' => 5.0,
                'reviews_count' => 145,
                'image' => 'images/kayla-hills.jpg',
                'category' => 'jawa menginap',
                'page' => 2,
                'description' => 'Nikmati keseruan wahana rainbow slide spektakuler, panorama kebun teh pegunungan yang asri, serta beragam spot foto kekinian di Kayla Hills Batang bersama rombongan.',
                'highlights' => [
                    'Wahana Rainbow Slide Raksasa',
                    'Ferris Wheel & Kereta Mini Pegunungan',
                    'Gardu Pandang Kebun Teh Pagilaran',
                    'Pusat Oleh-oleh Khas Batang & Pekalongan'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & full fasilitas'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3', 'desc' => '1 Malam twin share'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk & Wahana', 'desc' => 'Akses terusan Kayla Hills'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan 3x', 'desc' => 'Termasuk kuliner lokal']
                ],
                'inclusions' => [
                    'Bus Pariwisata AC Executive selama 2 hari',
                    'Akomodasi Hotel Bintang 3 (1 Malam)',
                    'Tiket masuk Kayla Hills & wahana utama',
                    '3x Makan & Air Mineral botol',
                    'BBM, Tol, Retribusi & Parkir',
                    'Tour Leader profesional'
                ],
                'exclusions' => [
                    'Pengeluaran belanja pribadi',
                    'Tiket wahana tambahan berbayar opsional',
                    'Tips driver & crew'
                ],
                'important_info' => [
                    'Kenakan pakaian yang nyaman untuk aktivitas outdoor dan bermain wahana.',
                    'Bawa jaket ringan karena udara perbukitan sejuk di sore/malam hari.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Eksplorasi Kayla Hills & Wahana Seru',
                        'schedules' => [
                            ['time' => '07:00 - 09:30', 'activity' => 'Penjemputan & perjalanan menuju Kayla Hills Batang'],
                            ['time' => '10:00 - 13:00', 'activity' => 'Tiba di Kayla Hills, main Rainbow Slide & sesi foto'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di resto lokal khas Batang'],
                            ['time' => '15:00 - 17:30', 'activity' => 'Jelajah agrowisata kebun teh & sunset view'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam & Check-in hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Wisata Batik Pekalongan & Kepulangan',
                        'schedules' => [
                            ['time' => '07:00 - 08:30', 'activity' => 'Sarapan pagi & check-out hotel'],
                            ['time' => '09:00 - 12:00', 'activity' => 'Wisata belanja ke Pasar Grosir Batik Setono'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang kuliner Megono & Garang Asem'],
                            ['time' => '14:30 - Selesai', 'activity' => 'Perjalanan kembali menuju meeting point asal.']
                        ]
                    ]
                ]
            ],

            'saloka' => [
                'slug' => 'saloka',
                'name' => 'Saloka Tour 3 Hari',
                'price' => 'Rp.600.000',
                'price_raw' => 600000,
                'duration' => '3 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Tuntang, Semarang, Jawa Tengah',
                'rating' => 5.0,
                'reviews_count' => 198,
                'image' => 'images/saloka.jpg',
                'category' => 'jawa menginap',
                'page' => 2,
                'description' => 'Jelajahi taman rekreasi tematik terbesar di Jawa Tengah dengan lebih dari 25 wahana seru terbagi dalam 5 zona petualangan, pertunjukan spektakuler Baru Klinthing, dan kuliner khas Semarang.',
                'highlights' => [
                    'Saloka Theme Park 5 Zona Petualangan',
                    'Wahana Bianglala Raksasa Cakrawala',
                    'Lawang Sewu & Kota Lama Semarang',
                    'Pusat Lumpia & Bandeng Juwana'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Reclining seat, audio, USB'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3', 'desc' => '2 Malam di Semarang'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Terusan Saloka', 'desc' => 'Bebas naik semua wahana'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Terjadwal', 'desc' => 'Sarapan hotel & makan resto']
                ],
                'inclusions' => [
                    'Bus Pariwisata Executive AC selama 3 hari',
                    'Akomodasi Hotel Bintang 3 (2 Malam)',
                    'Tiket terusan Saloka Theme Park',
                    'Tiket Lawang Sewu & Objek Wisata',
                    '5x Makan & Air Mineral harian',
                    'Tour Leader & Driver berpengalaman'
                ],
                'exclusions' => [
                    'Belanja pribadi dan oleh-oleh',
                    'Tips supir dan crew'
                ],
                'important_info' => [
                    'Tiket terusan Saloka berlaku untuk semua wahana permainan sepuasnya tanpa batas.',
                    'Dianjurkan membawa baju ganti bila ingin mencoba wahana air.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Kedatangan & Heritage Kota Lama Semarang',
                        'schedules' => [
                            ['time' => '08:00 - 11:30', 'activity' => 'Penjemputan rombongan & perjalanan ke Semarang'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang resto khas Semarangan'],
                            ['time' => '14:00 - 17:00', 'activity' => 'Wisata Kota Lama Semarang & Gereja Blenduk'],
                            ['time' => '18:00 - 20:00', 'activity' => 'Makan malam & Check-in hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Full Day Petualangan di Saloka Theme Park',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi di hotel'],
                            ['time' => '09:00 - 16:30', 'activity' => 'Eksplorasi wahana Saloka Theme Park, show & atraksi'],
                            ['time' => '17:00 - 19:30', 'activity' => 'Makan malam kuliner malam Semarang & kembali ke hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 3',
                        'title' => 'Lawang Sewu, Oleh-Oleh & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi & check-out hotel'],
                            ['time' => '09:00 - 11:30', 'activity' => 'Wisata sejarah ke Lawang Sewu'],
                            ['time' => '12:00 - 14:00', 'activity' => 'Makan siang & belanja Bandeng Presto Juwana / Lumpia'],
                            ['time' => '14:30 - Selesai', 'activity' => 'Pengantaran peserta ke titik drop-off. Selesai.']
                        ]
                    ]
                ]
            ],

            'kebun-raya-bogor' => [
                'slug' => 'kebun-raya-bogor',
                'name' => 'Kebun Raya Bogor Tour 1 Hari',
                'price' => 'Rp.300.000',
                'price_raw' => 300000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Kota Bogor, Jawa Barat',
                'rating' => 5.0,
                'reviews_count' => 167,
                'image' => 'images/kebun-raya-bogor.jpg',
                'category' => 'jawa 1hari',
                'page' => 2,
                'description' => 'Eksplorasi keasrian hutan tropis di tengah kota Bogor, melihat ribuan spesies flora langka, memberi makan rusa tutul di halaman Istana Bogor, dan museum zoologi.',
                'highlights' => [
                    'Taman Meksiko & Griya Anggrek',
                    'Kolam Teratai Raksasa & Jembatan Merah',
                    'Museum Zoologi Bogor',
                    'Rusa Tutul Istana Kepresidenan Bogor'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada bersih & dingin'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk KRB', 'desc' => 'Tiket terusan kebun raya'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Siang Khas Sunda', 'desc' => 'Restoran ternama di Bogor'],
                    ['icon' => 'fa-solid fa-user-tie', 'title' => 'Tour Leader Ramah', 'desc' => 'Pemandu edukatif']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC Full Day',
                    'Tiket masuk Kebun Raya Bogor & Museum Zoologi',
                    '1x Makan Siang masakan Sunda',
                    'Snack & Air Mineral botol',
                    'BBM, Tol Jagorawi, dan Parkir bus'
                ],
                'exclusions' => [
                    'Sewa sepeda / golf cart di dalam kebun raya',
                    'Pengeluaran belanja pribadi (Asinan Bogor, Roti Unyil)'
                ],
                'important_info' => [
                    'Kenakan sepatu sneakers yang nyaman untuk berjalan santai di area taman.',
                    'Dianjurkan membawa payung lipat atau topi pelindung matahari.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Piknik Edukasi Kebun Raya Bogor & Wisata Kuliner',
                        'schedules' => [
                            ['time' => '07:00 - 08:30', 'activity' => 'Kumpul di meeting point & berangkat ke Bogor via Tol Jagorawi'],
                            ['time' => '09:00 - 12:00', 'activity' => 'Jelajah Kebun Raya Bogor, Griya Anggrek, & Museum Zoologi'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang bersama di restoran khas Sunda Gurih 7 Bogor'],
                            ['time' => '14:30 - 16:30', 'activity' => 'Wisata belanja oleh-oleh Roti Unyil Venus & Asinan Gedung Dalam'],
                            ['time' => '17:00 - 18:30', 'activity' => 'Perjalanan kembali menuju meeting point. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'nicoles-river-park' => [
                'slug' => 'nicoles-river-park',
                'name' => "Nicole's River Park Tour 2 Hari",
                'price' => 'Rp.450.000',
                'price_raw' => 450000,
                'duration' => '2 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Puncak, Bogor, Jawa Barat',
                'rating' => 5.0,
                'reviews_count' => 132,
                'image' => 'images/nicoles-river-park.jpg',
                'category' => 'jawa menginap',
                'page' => 2,
                'description' => "Wisata keliling negeri dongeng ala kastil Eropa megah di Nicole's River Park Puncak, wahana mini zoo, spot foto ikonik dunia, dan udara sejuk pegunungan.",
                'highlights' => [
                    'Kastil Megah Medieval Nicole\'s Castle',
                    'Spot Foto Ikonik Jepang, Korea, Santorini & China',
                    'Mini Zoo & Feeding Satwa Lucu',
                    'Chocolaterie & Resto Nicole\'s'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & driver handal'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Resort Puncak', 'desc' => '1 Malam view perbukitan'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Terusan', 'desc' => 'Akses seluruh spot foto'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Lengkap', 'desc' => '3x Makan + Snack']
                ],
                'inclusions' => [
                    'Bus Pariwisata AC Executive 2 hari',
                    'Akomodasi Hotel 1 Malam di kawasan Puncak',
                    'Tiket masuk terusan Nicole\'s River Park',
                    '3x Makan & Air Mineral',
                    'BBM, Tol, dan Biaya Parkir',
                    'Tour Leader ramah'
                ],
                'exclusions' => [
                    'Sewa kostum tradisional (Hanbok/Kimono)',
                    'Pengeluaran pribadi'
                ],
                'important_info' => [
                    'Bawa jaket atau sweater untuk udara dingin di kawasan Puncak pada malam hari.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => "Petualangan Kastil Nicole's River Park",
                        'schedules' => [
                            ['time' => '07:00 - 09:30', 'activity' => 'Berangkat dari meeting point menuju kawasan Puncak'],
                            ['time' => '10:00 - 13:00', 'activity' => 'Eksplorasi spot kastil & wahana mini zoo di Nicole\'s River Park'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di restoran lokal Puncak'],
                            ['time' => '15:00 - 17:30', 'activity' => 'Wisata santai di Agrowisata Gunung Mas Puncak'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam & Check-in hotel resort']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Wisata Belanja Oleh-oleh & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi di hotel dan check-out'],
                            ['time' => '09:00 - 11:30', 'activity' => 'Belanja susu Cimory & oleh-oleh khas Puncak'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang penutupan'],
                            ['time' => '14:00 - Selesai', 'activity' => 'Perjalanan kembali menuju meeting point. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'dcastello' => [
                'slug' => 'dcastello',
                'name' => "D'Castello Tour 1 Hari",
                'price' => 'Rp.250.000',
                'price_raw' => 250000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Ciater, Subang, Jawa Barat',
                'rating' => 5.0,
                'reviews_count' => 220,
                'image' => 'images/dcastello.jpg',
                'category' => 'jawa 1hari',
                'page' => 2,
                'description' => "Kunjungi Florawisata D'Castello Ciater Subang dengan kastil megah warna-warni bak negeri dongeng berlatar kebun teh hijau luas serta taman bunga aneka warna.",
                'highlights' => [
                    'Kastil Negeri Dongeng Warna-Warni D\'Castello',
                    'Jembatan Tangan Raksasa Berlatar Kebun Teh',
                    'Taman Bunga Kastil Terbuka',
                    'Wisata Pemandian Air Panas Ciater'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Nyaman & full entertainment'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk D\'Castello', 'desc' => 'Semua area taman & kastil'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Siang Prasmanan', 'desc' => 'Restoran masakan khas Sunda'],
                    ['icon' => 'fa-solid fa-user-tie', 'title' => 'Tour Leader', 'desc' => 'Pemandu perjalanan ramah']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC',
                    'Tiket masuk Florawisata D\'Castello Ciater',
                    '1x Makan Siang Lezat',
                    'Air mineral botol & Snack',
                    'BBM, Tol, dan Parkir bus'
                ],
                'exclusions' => [
                    'Wahana trampolin, istana balon, dan buggy car',
                    'Belanja Nanas Simadu & oleh-oleh Subang'
                ],
                'important_info' => [
                    'Siapkan kamera / smartphone dengan baterai penuh untuk berfoto di ratusan spot instagramable.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => "Pesona Kastil Bunga D'Castello Ciater",
                        'schedules' => [
                            ['time' => '06:30 - 07:00', 'activity' => 'Berkumpul di meeting point dan berangkat menuju Ciater Subang'],
                            ['time' => '09:30 - 12:30', 'activity' => 'Eksplorasi spot foto Kastil D\'Castello & jembatan kanopi kebun teh'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang prasmanan masakan Sunda di resto lokal'],
                            ['time' => '14:30 - 16:30', 'activity' => 'Relaksasi di Air Panas Sari Ater Subang'],
                            ['time' => '16:30 - 17:30', 'activity' => 'Belanja buah nanas simadu & dodol khas Subang'],
                            ['time' => '17:30 - 20:00', 'activity' => 'Perjalanan kembali menuju meeting point. Selesai.']
                        ]
                    ]
                ]
            ],

            'sea-world' => [
                'slug' => 'sea-world',
                'name' => 'Sea World Tour 1 Hari',
                'price' => 'Rp.1.200.000',
                'price_raw' => 1200000,
                'duration' => '3 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Ancol, Jakarta Utara',
                'rating' => 5.0,
                'reviews_count' => 284,
                'image' => 'images/sea-world.jpg',
                'category' => 'jawa menginap',
                'page' => 2,
                'description' => 'Petualangan bawah laut menakjubkan di Sea World Ancol. Menyusuri terowongan kaca bawah air Antasena, melihat ribuan biota laut, atraksi feeding show hiu, dan touch pool edukatif.',
                'highlights' => [
                    'Terowongan Kaca Bawah Laut Antasena',
                    'Akuarium Utama & Live Feeding Show Hiu',
                    'Touch Pool Bintang Laut & Penyu',
                    'Wisata Pantai Karnaval Ancol'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada pariwisata eksekutif'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3', 'desc' => '2 Malam menginap di Jakarta'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Ancol & Sea World', 'desc' => 'Tiket resmi terusan'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Terjadwal', 'desc' => '5x Makan & Air mineral']
                ],
                'inclusions' => [
                    'Bus Pariwisata AC selama program 3 hari',
                    'Akomodasi Hotel Bintang 3 (2 Malam)',
                    'Tiket masuk gerbang Ancol & Sea World Jakarta',
                    '5x Makan sesuai jadwal program',
                    'BBM, Tol, dan Biaya Parkir',
                    'Tour Guide bersertifikat'
                ],
                'exclusions' => [
                    'Wahana tambahan di kawasan Ancol (Dufan/Atlantis)',
                    'Pengeluaran belanja pribadi'
                ],
                'important_info' => [
                    'Patuhi tata tertib saat berada di area Touch Pool (tidak mengangkat biota keluar dari air).'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Kedatangan & Pantai Ancol Sunset',
                        'schedules' => [
                            ['time' => '09:00 - 12:00', 'activity' => 'Penjemputan rombongan & perjalanan ke Jakarta'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang di restoran kuliner khas Betawi'],
                            ['time' => '14:30 - 17:30', 'activity' => 'Santai sore di Promenade Pantai Lagoon Ancol'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam & Check-in hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Eksplorasi Menakjubkan Sea World & Oceanarium',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi di hotel'],
                            ['time' => '09:00 - 13:00', 'activity' => 'Jelajah Sea World, Terowongan Antasena & Nonton Feeding Show'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di kawasan resto Ancol'],
                            ['time' => '15:00 - 17:30', 'activity' => 'Wisata gondola / kereta gantung Ancol'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam seafood di Bandar Djakarta & kembali ke hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 3',
                        'title' => 'Monas, Wisata Belanja & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan di hotel dan check-out'],
                            ['time' => '09:00 - 11:30', 'activity' => 'Kunjungan ke Monumen Nasional (Monas)'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang & belanja oleh-oleh khas Jakarta'],
                            ['time' => '14:00 - Selesai', 'activity' => 'Pengantaran peserta ke titik kepulangan. Selesai.']
                        ]
                    ]
                ]
            ],

            'atlantis' => [
                'slug' => 'atlantis',
                'name' => 'Atlantis Water Adventure',
                'price' => 'Rp.2.100.000',
                'price_raw' => 2100000,
                'duration' => '4 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Ancol, Jakarta Utara',
                'rating' => 5.0,
                'reviews_count' => 176,
                'image' => 'images/atlantis.jpg',
                'category' => 'jawa menginap',
                'page' => 2,
                'description' => 'Rasakan sensasi liburan air penuh petualangan di taman rekreasi air tematik peradaban kuno Mediterania Atlantis Water Adventure dengan 8 kolam utama dan berbagai seluncuran ekstrem.',
                'highlights' => [
                    'Seluncuran Ekstrem Dragon Slide & Skybox',
                    'Kolam Ombak Poseidon Wave Pool',
                    'Kolam Arus Antila River',
                    'Wahana Air Anak Elephant Pool'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata VIP', 'desc' => 'Fasilitas mewah & full audio'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 4', 'desc' => '3 Malam di Jakarta Pusat'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Terusan Atlantis', 'desc' => 'Akses seluruh wahana air'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Lengkap 4 Hari', 'desc' => 'Sarapan hotel & resto lokal']
                ],
                'inclusions' => [
                    'Bus Pariwisata AC 4 Hari',
                    'Hotel Bintang 4 (3 Malam Twin/Triple Share)',
                    'Tiket masuk Ancol & Atlantis Water Adventure',
                    'Makan lengkap selama program tour',
                    'BBM, Tol, dan Parkir',
                    'Tour Guide handal'
                ],
                'exclusions' => [
                    'Sewa ban pelampung & loker pribadi',
                    'Keperluan pribadi dan belanja'
                ],
                'important_info' => [
                    'Wajib mengenakan pakaian renang berbahan polyester / nilon.',
                    'Dilarang membawa makanan dan minuman dari luar ke dalam area kolam renang.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Kedatangan & City Tour Jakarta Heritage',
                        'schedules' => [
                            ['time' => '10:00 - 12:00', 'activity' => 'Penjemputan rombongan di titik temu'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang kuliner Betawi'],
                            ['time' => '14:30 - 17:00', 'activity' => 'Wisata Kota Tua Jakarta & Museum Fatahillah'],
                            ['time' => '18:00 - 20:00', 'activity' => 'Check-in hotel & makan malam']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Full Day Water Adventure di Atlantis Ancol',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi di hotel'],
                            ['time' => '09:00 - 16:30', 'activity' => 'Bermain air seru di Dragon Slide, Skybox & Kolam Ombak Atlantis'],
                            ['time' => '17:30 - 20:30', 'activity' => 'Makan malam kuliner dan istirahat di hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 3',
                        'title' => 'Wisata Belanja & Kuliner Metropolitan',
                        'schedules' => [
                            ['time' => '08:00 - 09:00', 'activity' => 'Sarapan di hotel'],
                            ['time' => '09:30 - 13:00', 'activity' => 'Wisata belanja Grand Indonesia / Pasar Tanah Abang'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang resto populer'],
                            ['time' => '15:00 - 18:00', 'activity' => 'Kawasan Senayan Park & Danau Romantis'],
                            ['time' => '19:00 - 21:00', 'activity' => 'Makan malam penutupan']
                        ]
                    ],
                    [
                        'day' => 'Hari 4',
                        'title' => 'Check-out & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 09:00', 'activity' => 'Sarapan & proses check-out hotel'],
                            ['time' => '09:30 - 11:30', 'activity' => 'Pusat oleh-oleh khas Jakarta'],
                            ['time' => '12:00 - Selesai', 'activity' => 'Pengantaran rombongan ke titik akhir. Tour berakhir.']
                        ]
                    ]
                ]
            ],

            'bird-land' => [
                'slug' => 'bird-land',
                'name' => 'Bird Land Tour',
                'price' => 'Rp.850.000',
                'price_raw' => 850000,
                'duration' => '2 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Ancol, Jakarta Utara',
                'rating' => 5.0,
                'reviews_count' => 154,
                'image' => 'images/bird-land.jpg',
                'category' => 'jawa menginap',
                'page' => 2,
                'description' => 'Jelajahi suaka burung interaktif modern di Jakarta Bird Land Ancol, berinteraksi langsung dengan aneka burung eksotis Indonesia dan mancanegara di aviary raksasa.',
                'highlights' => [
                    'Aviary Kubah Raksasa dengan Ratusan Burung Bebas Terbang',
                    'Atraksi Free Flight Bird Show & Feeding Kakatua',
                    'Spot Foto Bersama Flamingo & Makau Warna-warni',
                    'Pemandangan Tepi Danau Ancol'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & bersih'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3', 'desc' => '1 Malam di Jakarta'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Terusan Bird Land', 'desc' => 'Termasuk tiket masuk Ancol'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan 3x', 'desc' => 'Menu lezat resto pilihan']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC 2 Hari',
                    'Akomodasi Hotel Bintang 3 (1 Malam)',
                    'Tiket masuk Jakarta Bird Land & Kawasan Ancol',
                    '3x Makan & Air Mineral harian',
                    'BBM, Tol, dan Biaya Parkir',
                    'Tour Leader bersertifikat'
                ],
                'exclusions' => [
                    'Pakan burung khusus feeding show berbayar pribadi',
                    'Pengeluaran belanja pribadi'
                ],
                'important_info' => [
                    'Ikuti petunjuk keeper satwa saat melakukan feeding pada burung.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Eksplorasi Seru Jakarta Bird Land',
                        'schedules' => [
                            ['time' => '07:30 - 09:30', 'activity' => 'Penjemputan peserta & perjalanan menuju kawasan Ancol'],
                            ['time' => '10:00 - 13:00', 'activity' => 'Jelajah Jakarta Bird Land: Aviary, Feeding Show, & Foto Burung Makau'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di restoran kawasan Ancol'],
                            ['time' => '15:00 - 17:30', 'activity' => 'Santai sore di Symphony of the Sea Ancol'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam & Check-in hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Wisata Budaya Betawi & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi di hotel & check-out'],
                            ['time' => '09:00 - 11:30', 'activity' => 'Kunjungan ke Perkampungan Budaya Betawi Setu Babakan'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang kuliner khas Kerak Telor & Bir Pletok'],
                            ['time' => '14:00 - Selesai', 'activity' => 'Perjalanan kembali menuju meeting point. Tour selesai.']
                        ]
                    ]
                ]
            ],

            // ==================== HALAMAN 3 ====================
            'dufan' => [
                'slug' => 'dufan',
                'name' => 'Dufan Tour 1 Hari',
                'price' => 'Rp.310.000',
                'price_raw' => 310000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Taman Impian Jaya Ancol, Jakarta Utara',
                'rating' => 5.0,
                'reviews_count' => 450,
                'image' => 'images/dufan.jpg',
                'category' => 'jawa 1hari',
                'page' => 3,
                'description' => 'Pusat hiburan outdoor theme park terbesar di Indonesia Dunia Fantasi (Dufan). Nikmati wahana pemacu adrenalin seperti Halilintar, Tornado, Kora-Kora, Niagara-Gara, dan Istana Boneka.',
                'highlights' => [
                    'Wahana Ekstrem Halilintar, Tornado & Hysteria',
                    'Wahana Klasik Istana Boneka & Bianglala',
                    'Petualangan Air Niagara-Gara & Arung Jeram',
                    'Parade Dufan & Magic House Show'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & ber-AC dingin'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Terusan Dufan', 'desc' => 'Bebas naik seluruh wahana'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Siang & Snack', 'desc' => 'Voucher makan resto / bento box'],
                    ['icon' => 'fa-solid fa-user-tie', 'title' => 'Tour Leader Handal', 'desc' => 'Siap mendampingi rombongan']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC Full Day',
                    'Tiket masuk Gerbang Ancol & Tiket Terusan Dufan (All Wahana)',
                    '1x Makan Siang & Air Mineral botol',
                    'BBM, Tol, dan Biaya Parkir Bus',
                    'Tour Leader ramah'
                ],
                'exclusions' => [
                    'Tiket Fast Track Dufan (opsional antrean cepat)',
                    'Pengeluaran pribadi & belanja merchandise Dufan'
                ],
                'important_info' => [
                    'Kenakan pakaian dan alas kaki yang nyaman untuk berjalan santai di area theme park.',
                    'Bawa jas hujan plastik tipis / baju ganti untuk wahana basah seperti Arung Jeram & Niagara-Gara.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Sehari Penuh Petualangan di Dunia Fantasi',
                        'schedules' => [
                            ['time' => '07:00 - 08:30', 'activity' => 'Berkumpul di meeting point & perjalanan menuju kawasan Ancol'],
                            ['time' => '09:00 - 12:30', 'activity' => 'Tiba di Dufan, bermain wahana outdoor favorit'],
                            ['time' => '12:30 - 13:30', 'activity' => 'Makan siang & istirahat ibadah'],
                            ['time' => '13:30 - 17:00', 'activity' => 'Lanjut bermain wahana & menyaksikan parade spektakuler Dufan'],
                            ['time' => '17:30 - 19:30', 'activity' => 'Perjalanan kembali menuju meeting point awal. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'hutan-mycelia' => [
                'slug' => 'hutan-mycelia',
                'name' => 'Hutan Mycelia Tour 2 Hari',
                'price' => 'Rp.750.000',
                'price_raw' => 750000,
                'duration' => '2 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Cikole, Lembang, Jawa Barat',
                'rating' => 5.0,
                'reviews_count' => 187,
                'image' => 'images/hutan-mycelia.jpg',
                'category' => 'jawa menginap',
                'page' => 3,
                'description' => 'Sensasi magis wisata malam di Hutan Mycelia Grafika Cikole Lembang. Jelajah hutan pinus dengan instalasi seni cahaya lampu artistik bertema kerajaan jamur bercahaya (bioluminescent).',
                'highlights' => [
                    'Instalasi Seni Lampu Hutan Mycelia Lembang',
                    'Wisata Alam Grafika Cikole & Hutan Pinus',
                    'Tangkuban Perahu / Orchid Forest Cikole',
                    'Pusat Kuliner Hangat & Susu Murni Lembang'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & suspensi empuk'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Glamping / Hotel Cikole', 'desc' => '1 Malam suasana hutan pinus'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Hutan Mycelia', 'desc' => 'Akses night tour hutan lampu'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan & BBQ Malam', 'desc' => '3x Makan + Api Unggun']
                ],
                'inclusions' => [
                    'Bus Pariwisata AC selama 2 hari',
                    'Akomodasi Glamping / Hotel Bintang 3 di Lembang (1 Malam)',
                    'Tiket masuk Hutan Mycelia Night Tour & Orchid Forest',
                    '3x Makan (termasuk BBQ Dinner)',
                    'BBM, Tol, dan Parkir bus',
                    'Tour Leader profesional'
                ],
                'exclusions' => [
                    'Pengeluaran belanja pribadi',
                    'Wahana outbound opsional (Flying Fox, ATV)'
                ],
                'important_info' => [
                    'Suhu udara di Cikole Lembang pada malam hari dingin (14°C - 18°C), wajib membawa jaket tebal atau sweater hangat.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Orchid Forest & Keajaiban Hutan Mycelia',
                        'schedules' => [
                            ['time' => '07:30 - 10:30', 'activity' => 'Perjalanan menuju kawasan Lembang Cikole'],
                            ['time' => '11:00 - 13:00', 'activity' => 'Eksplorasi Orchid Forest Cikole & Jembatan Gantung Kayu'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di resto lokal khas Sunda'],
                            ['time' => '15:00 - 17:30', 'activity' => 'Check-in glamping/hotel & santai di hutan pinus'],
                            ['time' => '18:30 - 21:00', 'activity' => 'Night Tour ke Hutan Mycelia yang bercahaya magis & BBQ Dinner']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Floating Market & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi & check-out penginapan'],
                            ['time' => '09:00 - 12:00', 'activity' => 'Wisata santai di Floating Market Lembang'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang & belanja oleh-oleh Bolu Susu Lembang'],
                            ['time' => '14:30 - Selesai', 'activity' => 'Perjalanan kembali ke kota asal. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'mikutopia' => [
                'slug' => 'mikutopia',
                'name' => 'Mikutopia Tour 1 Hari',
                'price' => 'Rp.280.000',
                'price_raw' => 280000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Berastagi, Sumatera Utara',
                'rating' => 5.0,
                'reviews_count' => 139,
                'image' => 'images/mikutopia.jpg',
                'category' => 'sumatera 1hari',
                'page' => 3,
                'description' => 'Nikmati keseruan aneka wahana petualangan dan rekreasi keluarga di kawasan sejuk pegunungan Berastagi dengan fasilitas lengkap dan panorama alam memukau.',
                'highlights' => [
                    'Wahana Permainan Theme Park Mikutopia',
                    'Pemandangan Dataran Tinggi Berastagi & Gunung Sibayak',
                    'Pasar Buah Berastagi & Petik Stroberi',
                    'Bukit Gundaling View Point'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & aman'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Terusan', 'desc' => 'Akses seluruh wahana permainan'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Siang Resto', 'desc' => '1x Makan siang khas Berastagi'],
                    ['icon' => 'fa-solid fa-user-tie', 'title' => 'Tour Guide Lokal', 'desc' => 'Pemandu berpengalaman']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC Full Day',
                    'Tiket masuk terusan wahana Mikutopia',
                    '1x Makan Siang Lezat',
                    'Air mineral botol & Snack',
                    'BBM, Retribusi, dan Biaya Parkir'
                ],
                'exclusions' => [
                    'Belanja buah-buahan segar dan souvenir',
                    'Pengeluaran pribadi'
                ],
                'important_info' => [
                    'Bawa jaket karena suhu udara di Berastagi cukup dingin.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Petualangan Seru Mikutopia Berastagi',
                        'schedules' => [
                            ['time' => '07:00 - 09:30', 'activity' => 'Penjemputan di meeting point Medan & perjalanan ke Berastagi'],
                            ['time' => '10:00 - 13:00', 'activity' => 'Bermain wahana seru di taman hiburan Mikutopia'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di restoran lokal Berastagi'],
                            ['time' => '15:00 - 16:30', 'activity' => 'Wisata ke Pasar Buah Berastagi & Bukit Gundaling'],
                            ['time' => '17:00 - 19:30', 'activity' => 'Perjalanan kembali menuju meeting point. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'famoso-garden' => [
                'slug' => 'famoso-garden',
                'name' => 'Famoso Garden Bandung Tour 2 Hari',
                'price' => 'Rp.480.000',
                'price_raw' => 480000,
                'duration' => '2 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Dago Atas, Bandung, Jawa Barat',
                'rating' => 5.0,
                'reviews_count' => 165,
                'image' => 'images/famoso-garden.jpg',
                'category' => 'jawa menginap',
                'page' => 3,
                'description' => 'Wisata tematik negeri dongeng Famoso Garden di Dago Bandung. Menyajikan suasana perkampungan fantasi dengan kastil-kastil mungil, kafe estetik, dan spot foto yang sangat instagramable.',
                'highlights' => [
                    'Perkampungan Dongeng Fantasi Famoso Garden',
                    'Kastil Miniatur Bergaya Eropa Klasik',
                    'Tebing Keraton / Dago Dreampark',
                    'Wisata Kuliner Malam Punclut'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada eksekutif full musik'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3', 'desc' => '1 Malam di pusat kota Bandung'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Famoso Garden', 'desc' => 'Akses seluruh spot foto'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Terjadwal', 'desc' => '3x Makan + Snack']
                ],
                'inclusions' => [
                    'Bus Pariwisata AC selama 2 hari',
                    'Akomodasi Hotel Bintang 3 (1 Malam)',
                    'Tiket masuk Famoso Garden & Dago Dreampark',
                    '3x Makan & Air Mineral harian',
                    'BBM, Tol Cipularang, dan Biaya Parkir',
                    'Tour Leader ramah'
                ],
                'exclusions' => [
                    'Kuliner kafe tambahan di dalam Famoso Garden',
                    'Belanja factory outlet pribadi'
                ],
                'important_info' => [
                    'Gunakan outfit kekinian untuk berfoto di berbagai sudut desa dongeng.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Pesona Negeri Dongeng Famoso Garden',
                        'schedules' => [
                            ['time' => '07:00 - 10:00', 'activity' => 'Perjalanan menuju Bandung via Tol Cipularang'],
                            ['time' => '10:30 - 13:00', 'activity' => 'Eksplorasi spot foto negeri dongeng di Famoso Garden'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di restoran khas Sunda Dago'],
                            ['time' => '15:00 - 17:30', 'activity' => 'Wisata ke Tebing Keraton menikmati sunset Bandung'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam di Punclut & Check-in hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Jalan Braga & Belanja Oleh-Oleh',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi di hotel dan check-out'],
                            ['time' => '09:00 - 11:30', 'activity' => 'Jalan santai foto di kawasan heritage Braga'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang & belanja oleh-oleh Kartika Sari'],
                            ['time' => '14:00 - Selesai', 'activity' => 'Perjalanan pulang menuju titik kumpul asal. Selesai.']
                        ]
                    ]
                ]
            ],

            'samudera-ancol' => [
                'slug' => 'samudera-ancol',
                'name' => 'Samudera Ancol Tour 1 Hari',
                'price' => 'Rp.190.000',
                'price_raw' => 190000,
                'duration' => '1 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Taman Impian Jaya Ancol, Jakarta Utara',
                'rating' => 5.0,
                'reviews_count' => 215,
                'image' => 'images/samudera-ancol.jpg',
                'category' => 'jawa 1hari',
                'page' => 3,
                'description' => 'Wisata edukasi dan konservasi satwa laut di Ocean Dream Samudra Ancol. Menyaksikan atraksi cerdas lumba-lumba, singa laut yang lucu, sinema 5D, serta wahana rekreasi seru.',
                'highlights' => [
                    'Pertunjukan Cerdas Lumba-lumba & Singa Laut',
                    'Atraksi Satwa Burung Pintar & Berang-berang',
                    'Wahana Cinema 5D & Underwater Theater',
                    'Wahana Carousel & Bumper Car Anak'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada nyaman & driver ramah'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Samudra', 'desc' => 'Termasuk tiket gerbang Ancol'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Siang & Snack', 'desc' => '1x Makan siang di resto lokal'],
                    ['icon' => 'fa-solid fa-user-tie', 'title' => 'Tour Leader', 'desc' => 'Memandu rombongan']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC Full Day',
                    'Tiket masuk Gerbang Ancol & Ocean Dream Samudra',
                    '1x Makan Siang & Air Mineral botol',
                    'BBM, Tol, dan Biaya Parkir',
                    'Tour Leader berdedikasi'
                ],
                'exclusions' => [
                    'Sesi foto khusus bersama lumba-lumba (opsional)',
                    'Pengeluaran belanja pribadi'
                ],
                'important_info' => [
                    'Perhatikan jadwal showtime lumba-lumba dan singa laut agar tidak terlewat.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Edukasi Seru di Ocean Dream Samudra Ancol',
                        'schedules' => [
                            ['time' => '07:30 - 09:00', 'activity' => 'Kumpul di meeting point dan berangkat menuju Ancol'],
                            ['time' => '09:30 - 12:30', 'activity' => 'Menonton show lumba-lumba, atraksi singa laut, & Cinema 5D'],
                            ['time' => '12:30 - 13:30', 'activity' => 'Makan siang bersama rombongan'],
                            ['time' => '14:00 - 16:30', 'activity' => 'Bermain wahana seru dan santai di tepi Pantai Ancol'],
                            ['time' => '17:00 - 18:30', 'activity' => 'Perjalanan kembali ke titik temu. Tour berakhir.']
                        ]
                    ]
                ]
            ],

            'surabaya' => [
                'slug' => 'surabaya',
                'name' => 'Surabaya Tour 3 Hari',
                'price' => 'Rp.1.350.000',
                'price_raw' => 1350000,
                'duration' => '3 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Surabaya, Jawa Timur',
                'rating' => 5.0,
                'reviews_count' => 178,
                'image' => 'images/surabaya-tour.jpg',
                'category' => 'jawa menginap',
                'page' => 3,
                'description' => 'Eksplorasi Kota Pahlawan Surabaya selama 3 hari. Mengunjungi Monumen Sura & Baya, Jembatan Suramadu, Museum Kapal Selam, House of Sampoerna, dan jelajah kuliner Rawon Kalkulator serta Bebek Sinjay.',
                'highlights' => [
                    'Patung Ikonik Sura dan Baya & Monkasel',
                    'Jembatan Megah Suramadu & Wisata Madura',
                    'Kawasan Heritage Tunjungan Street',
                    'Pusat Oleh-Oleh Spikoe Resep Kuno & Almond Crispy'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Executive bus reclining seat'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 3', 'desc' => '2 Malam di pusat kota Surabaya'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Destinasi', 'desc' => 'Semua museum & objek wisata'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Terjadwal', 'desc' => '5x Makan kuliner khas Surabaya']
                ],
                'inclusions' => [
                    'Bus Pariwisata Executive AC selama 3 hari',
                    'Akomodasi Hotel Bintang 3 (2 Malam)',
                    'Tiket masuk seluruh objek wisata dalam program',
                    '5x Makan (termasuk sarapan hotel & kuliner legendaris)',
                    'BBM, Tol Trans Jawa, dan Parkir bus',
                    'Tour Guide lokal profesional'
                ],
                'exclusions' => [
                    'Tiket perjalanan asal ke Surabaya (jika di luar rute bus)',
                    'Pengeluaran belanja pribadi'
                ],
                'important_info' => [
                    'Siapkan pakaian katun santai yang menyerap keringat untuk cuaca tropis hangat kota Surabaya.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'City Tour Kota Pahlawan & Tunjungan',
                        'schedules' => [
                            ['time' => '09:00 - 11:30', 'activity' => 'Penjemputan peserta di Surabaya & Monumen Kapal Selam'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang Rawon Setan legendaris'],
                            ['time' => '14:00 - 17:00', 'activity' => 'Foto di Patung Sura Baya & Jelajah Jalan Tunjungan Heritage'],
                            ['time' => '18:00 - 20:00', 'activity' => 'Makan malam Bebek Sinjay & Check-in hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Sensasi Jembatan Suramadu & Wisata Madura',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi di hotel'],
                            ['time' => '09:00 - 12:30', 'activity' => 'Melintasi Jembatan Suramadu & Sentra Batik Madura'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang bebek khas Madura'],
                            ['time' => '15:30 - 17:30', 'activity' => 'Wisata Ekowisata Mangrove Wonorejo Surabaya'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam kuliner dan kembali ke hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 3',
                        'title' => 'Wisata Belanja Oleh-Oleh & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi & check-out hotel'],
                            ['time' => '09:00 - 12:00', 'activity' => 'Belanja Spikoe Resep Kuno & Pusat Grosir Pasar Turi'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang penutupan'],
                            ['time' => '14:30 - Selesai', 'activity' => 'Pengantaran peserta ke titik drop-off. Tour selesai.']
                        ]
                    ]
                ]
            ],

            'taman-mini' => [
                'slug' => 'taman-mini',
                'name' => 'Taman Mini Indonesia Tour 4 Hari',
                'price' => 'Rp.2.300.000',
                'price_raw' => 2300000,
                'duration' => '4 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Jakarta Timur, DKI Jakarta',
                'rating' => 5.0,
                'reviews_count' => 312,
                'image' => 'images/taman-mini.jpg',
                'category' => 'jawa menginap',
                'page' => 3,
                'description' => 'Wisata budaya terakbar di Taman Mini Indonesia Indah (TMII) yang telah direvitalisasi modern. Menjelajahi anjungan 38 provinsi di Nusantara, Danau Kepulauan Indonesia, Kereta Gantung, dan Museum Indonesia.',
                'highlights' => [
                    'Danau Archipelago dengan Miniatur Kepulauan Indonesia',
                    'Anjungan Daerah Tradisional Rumah Adat 38 Provinsi',
                    'Kereta Gantung TMII & Istana Anak-Anak',
                    'Taman Burung & Museum Pusaka TMII'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata VIP', 'desc' => 'Armada mewah, AC & TV LED'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Bintang 4', 'desc' => '3 Malam menginap di Jakarta'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk TMII & Wahana', 'desc' => 'Termasuk tiket kereta gantung'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan Lengkap', 'desc' => 'Sarapan hotel & restoran nusantara']
                ],
                'inclusions' => [
                    'Bus Pariwisata Executive AC 4 Hari',
                    'Akomodasi Hotel Bintang 4 (3 Malam)',
                    'Tiket masuk gerbang TMII & Wahana Kereta Gantung',
                    'Makan lengkap selama 4 hari (Breakfast, Lunch, Dinner)',
                    'BBM, Tol, dan Biaya Parkir Bus',
                    'Tour Leader berpengalaman'
                ],
                'exclusions' => [
                    'Sewa skuter listrik / sepeda di dalam area TMII',
                    'Belanja cinderamata kerajinan daerah'
                ],
                'important_info' => [
                    'Kawasan TMII kini mengusung konsep ramah lingkungan (green zone), gunakan kendaraan ramah lingkungan atau shuttle bus gratis di dalam area.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Kedatangan & Wisata Monas Heritage',
                        'schedules' => [
                            ['time' => '10:00 - 12:00', 'activity' => 'Penjemputan rombongan di meeting point Jakarta'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang di restoran kuliner khas Nusantara'],
                            ['time' => '14:30 - 17:00', 'activity' => 'Kunjungan ke Monumen Nasional & Museum Nasional'],
                            ['time' => '18:00 - 20:00', 'activity' => 'Check-in Hotel Bintang 4 & makan malam']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Eksplorasi Budaya Nusantara di TMII',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan pagi di hotel'],
                            ['time' => '09:00 - 12:30', 'activity' => 'Jelajah Anjungan Rumah Adat Daerah & Naik Kereta Gantung TMII'],
                            ['time' => '12:30 - 14:00', 'activity' => 'Makan siang di Restoran Danau Archipelago TMII'],
                            ['time' => '14:30 - 17:00', 'activity' => 'Wisata ke Istana Anak-Anak & Taman Burung TMII'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam kuliner malam Jakarta & istirahat di hotel']
                        ]
                    ],
                    [
                        'day' => 'Hari 3',
                        'title' => 'Wisata Belanja & Hiburan Ibu Kota',
                        'schedules' => [
                            ['time' => '08:00 - 09:00', 'activity' => 'Sarapan di hotel'],
                            ['time' => '09:30 - 13:00', 'activity' => 'Wisata belanja cinderamata Sarinah Mall Thamrin'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang resto populer'],
                            ['time' => '15:00 - 18:00', 'activity' => 'Kawasan Senayan & Gelora Bung Karno'],
                            ['time' => '19:00 - 21:00', 'activity' => 'Makan malam penutupan']
                        ]
                    ],
                    [
                        'day' => 'Hari 4',
                        'title' => 'Check-out & Kepulangan Rombongan',
                        'schedules' => [
                            ['time' => '07:30 - 09:00', 'activity' => 'Sarapan pagi & proses check-out kamar hotel'],
                            ['time' => '09:30 - 11:30', 'activity' => 'Pusat oleh-oleh khas Betawi & Nusantara'],
                            ['time' => '12:00 - Selesai', 'activity' => 'Pengantaran peserta ke titik akhir perjalanan. Selesai.']
                        ]
                    ]
                ]
            ],

            'fairy-garden' => [
                'slug' => 'fairy-garden',
                'name' => 'Fairy Garden Bandung Tour 2 Hari',
                'price' => 'Rp.900.000',
                'price_raw' => 900000,
                'duration' => '2 Hari',
                'max_people' => 'Max 40 Orang',
                'location' => 'Lembang, Bandung Barat, Jawa Barat',
                'rating' => 5.0,
                'reviews_count' => 194,
                'image' => 'images/fairy-garden.jpg',
                'category' => 'jawa menginap',
                'page' => 3,
                'description' => 'Masuki dunia peri ajaib di Fairy Garden Lembang Bandung. Kastil peri megah dengan kostum peri bersayap, taman bunga labirin, parade teatrikal peri, dan aktivitas edukasi seni untuk keluarga.',
                'highlights' => [
                    'Kastil Megah Istana Peri Fairy Castle',
                    'Parade Teatrikal Kostum Peri Cantik Bersayap',
                    'Taman Bunga Labirin & Rumah Pohon Ajaib',
                    'The Lodge Maribaya & Wisata Alam Pinus'
                ],
                'facilities' => [
                    ['icon' => 'fa-solid fa-bus', 'title' => 'Bus Pariwisata AC', 'desc' => 'Armada mewah & berfasilitas lengkap'],
                    ['icon' => 'fa-solid fa-hotel', 'title' => 'Hotel Resort Lembang', 'desc' => '1 Malam di perbukitan sejuk'],
                    ['icon' => 'fa-solid fa-ticket', 'title' => 'Tiket Masuk Fairy Garden', 'desc' => 'Akses terusan seluruh taman'],
                    ['icon' => 'fa-solid fa-utensils', 'title' => 'Makan 3x', 'desc' => 'Menu lezat resto khas Sunda']
                ],
                'inclusions' => [
                    'Transportasi Bus Pariwisata AC 2 Hari',
                    'Akomodasi Hotel Resort Lembang (1 Malam)',
                    'Tiket masuk Fairy Garden & The Lodge Maribaya',
                    '3x Makan & Air Mineral harian',
                    'BBM, Tol Cipularang, dan Biaya Parkir',
                    'Tour Leader ramah'
                ],
                'exclusions' => [
                    'Sewa kostum peri & wahana sky tree berbayar di The Lodge',
                    'Pengeluaran belanja pribadi'
                ],
                'important_info' => [
                    'Bawa jaket atau pakaian hangat untuk suasana malam Lembang yang sejuk.'
                ],
                'itinerary' => [
                    [
                        'day' => 'Hari 1',
                        'title' => 'Keajaiban Istana Peri Fairy Garden',
                        'schedules' => [
                            ['time' => '07:00 - 10:00', 'activity' => 'Perjalanan rombongan menuju kawasan Lembang Bandung'],
                            ['time' => '10:30 - 13:00', 'activity' => 'Eksplorasi taman peri Fairy Garden & nonton pertunjukan peri'],
                            ['time' => '13:00 - 14:30', 'activity' => 'Makan siang di resto lokal khas Sunda'],
                            ['time' => '15:00 - 17:30', 'activity' => 'Wisata alam pinus di The Lodge Maribaya'],
                            ['time' => '18:30 - 20:30', 'activity' => 'Makan malam rombongan & Check-in hotel resort']
                        ]
                    ],
                    [
                        'day' => 'Hari 2',
                        'title' => 'Wisata Belanja & Kepulangan',
                        'schedules' => [
                            ['time' => '07:30 - 08:30', 'activity' => 'Sarapan di hotel dan check-out'],
                            ['time' => '09:00 - 11:30', 'activity' => 'Wisata belanja factory outlet Rumah Mode Bandung'],
                            ['time' => '12:00 - 13:30', 'activity' => 'Makan siang & belanja oleh-oleh Prima Rasa'],
                            ['time' => '14:00 - Selesai', 'activity' => 'Perjalanan kembali menuju titik asal. Tour selesai.']
                        ]
                    ]
                ]
            ],
        ];
    }

    /**
     * Halaman index paket wisata (Mendukung query ?page=1, ?page=2, ?page=3 atau paginasi dynamic)
     */
    public function index(Request $request)
    {
        $allPackages = self::getPaketData();
        $currentPage = (int) $request->query('page', 1);
        if ($currentPage < 1 || $currentPage > 3) {
            $currentPage = 1;
        }

        return view('paket-wisata', compact('allPackages', 'currentPage'));
    }

    /**
     * Halaman detail paket wisata
     */
    public function show($slug)
    {
        $allPackages = self::getPaketData();

        $paket = $allPackages[$slug] ?? null;

        if (!$paket) {
            foreach ($allPackages as $key => $data) {
                if (str_contains($slug, $key) || str_contains($key, $slug)) {
                    $paket = $data;
                    break;
                }
            }
        }

        if (!$paket) {
            $paket = $allPackages['jogja'];
        }

        return view('detail-paket', compact('paket'));
    }

    /**
     * Daftar kota keberangkatan
     */
    public static function getDepartureCities()
    {
        return [
            ['city' => 'Yogyakarta', 'extra' => 0, 'extra_label' => '+Rp 0'],
            ['city' => 'Bandung', 'extra' => 150000, 'extra_label' => '+Rp 150.000'],
            ['city' => 'Jakarta', 'extra' => 200000, 'extra_label' => '+Rp 200.000'],
            ['city' => 'Surabaya', 'extra' => 150000, 'extra_label' => '+Rp 150.000'],
            ['city' => 'Lampung', 'extra' => 300000, 'extra_label' => '+Rp 300.000'],
            ['city' => 'Purwokerto', 'extra' => 100000, 'extra_label' => '+Rp 100.000'],
            ['city' => 'Magelang', 'extra' => 50000, 'extra_label' => '+Rp 50.000'],
            ['city' => 'Semarang', 'extra' => 100000, 'extra_label' => '+Rp 100.000'],
        ];
    }

    /**
     * Halaman checkout / buat pesanan
     */
    public function checkout($slug)
    {
        $allPackages = self::getPaketData();

        $paket = $allPackages[$slug] ?? null;

        if (!$paket) {
            foreach ($allPackages as $key => $data) {
                if (str_contains($slug, $key) || str_contains($key, $slug)) {
                    $paket = $data;
                    break;
                }
            }
        }

        if (!$paket) {
            $paket = $allPackages['jogja'];
        }

        // Tambahan info hotel & meals untuk summary
        $hotelDetails = [
            'tangkuban-perahu' => 'Tanpa Menginap (1 Hari)',
            'jogja' => 'Hotel Bintang 3 (1 Malam)',
            'malioboro' => 'Tanpa Menginap (1 Hari)',
            'bromo' => 'Transit Homestay Bromo',
            'pantai-pandawa' => 'Tanpa Menginap (1 Hari)',
            'bandung' => 'Hotel Bintang 3 (3 Malam)',
            'bali' => 'Hotel Bintang 4 (4 Malam)',
            'lampung' => 'Hotel Bintang 3 (2 Malam)',
            'kayla-hills' => 'Hotel Bintang 3 (1 Malam)',
            'saloka' => 'Hotel Bintang 3 (2 Malam)',
            'kebun-raya-bogor' => 'Tanpa Menginap (1 Hari)',
            'nicoles-river-park' => 'Hotel Resort Puncak (1 Malam)',
            'dcastello' => 'Tanpa Menginap (1 Hari)',
            'sea-world' => 'Hotel Bintang 3 (2 Malam)',
            'atlantis' => 'Hotel Bintang 4 (3 Malam)',
            'bird-land' => 'Hotel Bintang 3 (1 Malam)',
            'dufan' => 'Tanpa Menginap (1 Hari)',
            'hutan-mycelia' => 'Glamping / Hotel Cikole (1 Malam)',
            'mikutopia' => 'Tanpa Menginap (1 Hari)',
            'famoso-garden' => 'Hotel Bintang 3 (1 Malam)',
            'samudera-ancol' => 'Tanpa Menginap (1 Hari)',
            'surabaya' => 'Hotel Bintang 3 (2 Malam)',
            'taman-mini' => 'Hotel Bintang 4 (3 Malam)',
            'fairy-garden' => 'Hotel Resort Lembang (1 Malam)',
        ];

        $mealDetails = [
            'tangkuban-perahu' => '1x Makan Siang & Snack',
            'jogja' => '3x Makan & 1x Sarapan',
            'malioboro' => '1x Makan Siang & Snack',
            'bromo' => '1x Sarapan & Kopi Hangat',
            'pantai-pandawa' => '1x Makan Siang',
            'bandung' => '7x Makan Lengkap',
            'bali' => 'Makan Lengkap & Seafood Jimbaran',
            'lampung' => 'Makan Lengkap & Ikan Bakar',
            'kayla-hills' => '3x Makan & Air Mineral',
            'saloka' => '5x Makan & Sarapan Hotel',
            'kebun-raya-bogor' => '1x Makan Siang Sunda & Snack',
            'nicoles-river-park' => '3x Makan + Snack',
            'dcastello' => '1x Makan Siang Prasmanan',
            'sea-world' => '5x Makan & Seafood',
            'atlantis' => 'Makan Lengkap 4 Hari',
            'bird-land' => '3x Makan & Snack',
            'dufan' => '1x Makan Siang & Snack',
            'hutan-mycelia' => '3x Makan + BBQ Dinner',
            'mikutopia' => '1x Makan Siang Khas Berastagi',
            'famoso-garden' => '3x Makan & Air Mineral',
            'samudera-ancol' => '1x Makan Siang & Snack',
            'surabaya' => '5x Makan Kuliner Khas Surabaya',
            'taman-mini' => 'Makan Lengkap 4 Hari',
            'fairy-garden' => '3x Makan & Air Mineral',
        ];

        $paket['hotel_info'] = $hotelDetails[$paket['slug']] ?? 'Hotel Bintang 3';
        $paket['meal_info'] = $mealDetails[$paket['slug']] ?? 'Makan Sesuai Program';

        $departureCities = self::getDepartureCities();

        return view('checkout', compact('paket', 'departureCities'));
    }
}
