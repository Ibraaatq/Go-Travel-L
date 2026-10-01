<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    /**
     * Data master paket wisata
     */
    public static function getPaketData()
    {
        return [
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
                'duration' => '1 Hari (Midnight Tour)',
                'max_people' => 'Max 40 Orang',
                'location' => 'Taman Nasional Bromo Tengger Semeru, Jawa Timur',
                'rating' => 5.0,
                'reviews_count' => 342,
                'image' => 'images/bromo.jpg',
                'category' => 'jawa 1hari',
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
                'duration' => '4 Hari 3 Malam',
                'max_people' => 'Max 40 Orang',
                'location' => 'Bandung, Jawa Barat',
                'rating' => 4.9,
                'reviews_count' => 175,
                'image' => 'images/bandung.jpg',
                'category' => 'jawa menginap',
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
                'duration' => '5 Hari 4 Malam',
                'max_people' => 'Max 40 Orang',
                'location' => 'Denpasar & Seluruh Bali',
                'rating' => 4.9,
                'reviews_count' => 310,
                'image' => 'images/bali.jpg',
                'category' => 'bali menginap',
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
                'duration' => '3 Hari 2 Malam',
                'max_people' => 'Max 40 Orang',
                'location' => 'Bandar Lampung & Pesawaran, Lampung',
                'rating' => 4.8,
                'reviews_count' => 112,
                'image' => 'images/lampung.jpg',
                'category' => 'sumatera menginap',
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
            ]
        ];
    }

    /**
     * Halaman index paket wisata
     */
    public function index()
    {
        return view('paket-wisata');
    }

    /**
     * Halaman detail paket wisata
     */
    public function show($slug)
    {
        $allPackages = self::getPaketData();

        // Cari paket berdasarkan slug atau default ke jogja jika tidak ditemukan
        $paket = $allPackages[$slug] ?? null;

        if (!$paket) {
            // Coba cari substring jika slug variatif
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
        ];

        $paket['hotel_info'] = $hotelDetails[$paket['slug']] ?? 'Hotel Bintang 3';
        $paket['meal_info'] = $mealDetails[$paket['slug']] ?? 'Makan Sesuai Program';

        $departureCities = self::getDepartureCities();

        return view('checkout', compact('paket', 'departureCities'));
    }
}
