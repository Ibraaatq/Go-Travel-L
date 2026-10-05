@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="admin-page-wrapper">

    <!-- Top Action / Back Button -->
    <div class="admin-top-nav-row">
        <a href="{{ url('/') }}" class="admin-back-btn" title="Kembali ke Beranda" aria-label="Kembali ke Beranda">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>

    <!-- Main Glassmorphism Container (2-Column Layout) -->
    <div class="admin-glass-container">

        <!-- ==================== KOLOM KIRI: SIDEBAR PROFILE ==================== -->
        <aside class="admin-sidebar-card">
            <!-- User Profile Header -->
            <div class="sidebar-user-header">
                <div class="sidebar-avatar-circle">
                    @if(session()->has('user.avatar') && !empty(session('user.avatar')))
                        <img src="{{ session('user.avatar') }}" alt="{{ session('user.name') }}">
                    @else
                        <i class="fa-solid fa-user"></i>
                    @endif
                </div>
                <h2 class="sidebar-user-name">
                    {{ session('user.name', 'Ika Safitri Oktavia') }}
                </h2>
                <p class="sidebar-user-email">
                    {{ session('user.email', 'ikasafitrioktavia@gmail.com') }}
                </p>
            </div>

            <!-- Sidebar Nav Menu -->
            <nav>
                <ul class="sidebar-nav-list">
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link active" data-tab="tab-dashboard">
                            <i class="fa-solid fa-house"></i>
                            <span>Dashboard</span>
                        </button>
                    </li>
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link" data-tab="tab-paket-wisata">
                            <i class="fa-solid fa-suitcase"></i>
                            <span>Paket Wisata</span>
                        </button>
                    </li>
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link" data-tab="tab-riwayat-pemesanan">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <span>Riwayat Pemesanan</span>
                        </button>
                    </li>
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link" data-tab="tab-pengaturan">
                            <i class="fa-solid fa-gear"></i>
                            <span>Pengaturan</span>
                        </button>
                    </li>
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link nav-logout" onclick="openLogoutModal()">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- ==================== KOLOM KANAN: DASHBOARD CONTENT ==================== -->
        <main class="admin-main-content">

            <!-- ---------------------------------------------------- -->
            <!-- TAB 1: DASHBOARD OVERVIEW (REFERENCE IMAGE 1)        -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane active" id="tab-dashboard">

                <!-- 1. Top 3 Summary Cards -->
                <div class="summary-cards-grid">
                    <!-- Total Pesanan Card -->
                    <div class="summary-card total-orders">
                        <div class="summary-icon-circle">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-title">Total Pesanan</span>
                            <span class="summary-number">0</span>
                            <span class="summary-subtitle">Semua waktu</span>
                        </div>
                    </div>

                    <!-- Selesai Card -->
                    <div class="summary-card completed-orders">
                        <div class="summary-icon-circle">
                            <i class="fa-regular fa-circle-check"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-title">Selesai</span>
                            <span class="summary-number">0</span>
                            <span class="summary-subtitle">Perjalanan selesai</span>
                        </div>
                    </div>

                    <!-- Dikonfirmasi Card -->
                    <div class="summary-card confirmed-orders">
                        <div class="summary-icon-circle">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-title">Dikonfirmasi</span>
                            <span class="summary-number">0</span>
                            <span class="summary-subtitle">Perjalanan mendatang</span>
                        </div>
                    </div>
                </div>

                <!-- 2. Middle Card: Paket Wisata Horizontal List -->
                <div class="admin-section-card">
                    <div class="admin-card-header">
                        <h3 class="admin-card-title">Paket Wisata</h3>
                        <a href="javascript:void(0)" class="btn-detail-outline switch-to-packages" onclick="activateTab('tab-paket-wisata')">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="packages-horizontal-list">
                        @php
                            $dashboardPackages = [
                                [
                                    'name' => 'Jogja Tour 2 Hari',
                                    'location' => 'Yogyakarta',
                                    'price' => 'Rp.2.200.000',
                                    'duration' => 'Durasi 2 Hari 1 Malam',
                                    'image' => asset('images/jogja.jpg'),
                                    'slug' => 'jogja'
                                ],
                                [
                                    'name' => 'Bromo Tour 1 Hari',
                                    'location' => 'Jawa Timur',
                                    'price' => 'Rp.499.000',
                                    'duration' => 'Durasi 1 Hari',
                                    'image' => asset('images/bromo.jpg'),
                                    'slug' => 'bromo'
                                ],
                                [
                                    'name' => 'Lampung Tour 3 Hari',
                                    'location' => 'Lampung',
                                    'price' => 'Rp.975.000',
                                    'duration' => 'Durasi 3 Hari 2 Malam',
                                    'image' => asset('images/lampung.jpg'),
                                    'slug' => 'lampung'
                                ]
                            ];
                        @endphp

                        @foreach($dashboardPackages as $item)
                            <div class="package-item-card">
                                <div class="package-item-left">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="package-item-thumb" loading="lazy">
                                    <div class="package-item-meta">
                                        <h4 class="package-item-name">{{ $item['name'] }}</h4>
                                        <span class="package-item-location">{{ $item['location'] }}</span>
                                    </div>
                                </div>
                                <div class="package-item-right">
                                    <div class="package-item-pricing">
                                        <span class="package-item-price">{{ $item['price'] }}</span>
                                        <span class="package-item-duration">
                                            <i class="fa-regular fa-clock"></i> {{ $item['duration'] }}
                                        </span>
                                    </div>
                                    <div class="package-item-actions">
                                        <button type="button" class="btn-action-icon edit" title="Edit Paket" onclick="openPackageModal('{{ $item['name'] }}', '{{ $item['price'] }}', '{{ $item['location'] }}')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn-action-icon delete" title="Hapus Paket" onclick="deletePackageConfirm('{{ $item['name'] }}')">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- 3. Bottom Card: Riwayat Pemesanan Table -->
                <div class="admin-section-card">
                    <div class="admin-card-header">
                        <h3 class="admin-card-title">Riwayat Pemesanan</h3>
                    </div>

                    <div class="table-responsive-wrapper">
                        <table class="admin-orders-table">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Paket Wisata</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Total Pembayaran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Alexa Lubeille R.</div>
                                        <div class="table-text-sub">0987-3572-3833</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Jogja Tour 2 Hari</div>
                                        <div class="table-text-sub">Yogyakarta</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">01 Agustus 2026</div>
                                        <div class="table-text-sub">05 Agustus 2026</div>
                                    </td>
                                    <td>6 Orang</td>
                                    <td><strong>Rp. 13.200.000</strong></td>
                                    <td><span class="badge-status confirmed">Dikonfirmasi</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('alexa')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Nadia Putri</div>
                                        <div class="table-text-sub">0859-3555-4829</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Bandung Tour 4 Hari</div>
                                        <div class="table-text-sub">Bandung</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">06 Agustus 2026</div>
                                        <div class="table-text-sub">09 Agustus 2026</div>
                                    </td>
                                    <td>8 Orang</td>
                                    <td><strong>Rp. 14.400.000</strong></td>
                                    <td><span class="badge-status completed">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('nadia')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Raka Pratama</div>
                                        <div class="table-text-sub">0824-7872-3844</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Bali Tour 5 Hari</div>
                                        <div class="table-text-sub">Bali</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">27 Agustus 2026</div>
                                        <div class="table-text-sub">29 Agustus 2026</div>
                                    </td>
                                    <td>4 Orang</td>
                                    <td><strong>Rp. 11.000.000</strong></td>
                                    <td><span class="badge-status completed">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('raka')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Alya Ramadhani</div>
                                        <div class="table-text-sub">0928-7533-2088</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Lampung Tour 3 Hari</div>
                                        <div class="table-text-sub">Lampung</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">18 Juli 2026</div>
                                        <div class="table-text-sub">25 Juli 2026</div>
                                    </td>
                                    <td>7 Orang</td>
                                    <td><strong>Rp. 6.825.000</strong></td>
                                    <td><span class="badge-status completed">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('alya')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Fajar Maulana</div>
                                        <div class="table-text-sub">0925-4489-3877</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Bromo Tour 1 Hari</div>
                                        <div class="table-text-sub">Jawa Timur</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">19 Juli 2026</div>
                                        <div class="table-text-sub">27 Juli 2026</div>
                                    </td>
                                    <td>10 Orang</td>
                                    <td><strong>Rp. 4.990.000</strong></td>
                                    <td><span class="badge-status completed">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('fajar')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- ---------------------------------------------------- -->
            <!-- TAB 2: DAFTAR PAKET WISATA (REFERENCE IMAGE 2)       -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-paket-wisata">
                <div class="admin-section-card">
                    <!-- Header with Title & Badge Count -->
                    <div class="admin-card-header">
                        <h2 class="admin-card-title" style="font-size: 20px;">Daftar Paket Wisata</h2>
                        <div class="header-badge-count">
                            <i class="fa-solid fa-briefcase"></i>
                            <span id="packageBadgeCount">8</span>
                        </div>
                    </div>

                    <!-- Search Bar & Add Package Button -->
                    <div class="admin-controls-bar">
                        <div class="admin-search-wrapper">
                            <i class="fa-solid fa-magnifying-glass admin-search-icon"></i>
                            <input type="text" id="packageFilterInput" class="admin-search-input" placeholder="Search paket wisata atau lokasi...">
                        </div>
                        <button type="button" class="btn-add-package" onclick="openAddPackageModal()">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Paket</span>
                        </button>
                    </div>

                    <!-- Full Horizontal Package List (8 Packages) -->
                    <div class="packages-horizontal-list" id="fullPackagesList">
                        @php
                            $allFullPackages = [
                                [
                                    'name' => 'Jogja Tour 2 Hari',
                                    'location' => 'Yogyakarta',
                                    'price' => 'Rp.2.200.000',
                                    'duration' => 'Durasi 2 Hari 1 Malam',
                                    'image' => asset('images/jogja.jpg'),
                                    'slug' => 'jogja'
                                ],
                                [
                                    'name' => 'Bromo Tour 1 Hari',
                                    'location' => 'Jawa Timur',
                                    'price' => 'Rp.499.000',
                                    'duration' => 'Durasi 1 Hari',
                                    'image' => asset('images/bromo.jpg'),
                                    'slug' => 'bromo'
                                ],
                                [
                                    'name' => 'Lampung Tour 3 Hari',
                                    'location' => 'Lampung',
                                    'price' => 'Rp.975.000',
                                    'duration' => 'Durasi 3 Hari 2 Malam',
                                    'image' => asset('images/lampung.jpg'),
                                    'slug' => 'lampung'
                                ],
                                [
                                    'name' => 'Bali Tour 5 Hari',
                                    'location' => 'Bali',
                                    'price' => 'Rp.2.750.000',
                                    'duration' => 'Durasi 5 Hari 4 Malam',
                                    'image' => asset('images/bali.jpg'),
                                    'slug' => 'bali'
                                ],
                                [
                                    'name' => 'Bandung Tour 4 Hari',
                                    'location' => 'Bandung',
                                    'price' => 'Rp.1.800.000',
                                    'duration' => 'Durasi 4 Hari 3 Malam',
                                    'image' => asset('images/bandung.jpg'),
                                    'slug' => 'bandung'
                                ],
                                [
                                    'name' => 'Malioboro Tour 1 Hari',
                                    'location' => 'Yogyakarta',
                                    'price' => 'Rp.249.000',
                                    'duration' => 'Durasi 1 Hari',
                                    'image' => asset('images/malioboro.jpg'),
                                    'slug' => 'malioboro'
                                ],
                                [
                                    'name' => 'Tangkuban Perahu Tour 1 Hari',
                                    'location' => 'Jawa Barat',
                                    'price' => 'Rp.200.000',
                                    'duration' => 'Durasi 1 Hari',
                                    'image' => asset('images/tangkuban.jpg'),
                                    'slug' => 'tangkuban-perahu'
                                ],
                                [
                                    'name' => 'Pantai Pandawa 1 Hari',
                                    'location' => 'Bali',
                                    'price' => 'Rp.175.000',
                                    'duration' => 'Durasi 1 Hari',
                                    'image' => asset('images/pandawa.jpg'),
                                    'slug' => 'pantai-pandawa'
                                ],
                            ];
                        @endphp

                        @foreach($allFullPackages as $pkg)
                            <div class="package-item-card full-package-card" data-title="{{ strtolower($pkg['name']) }}" data-loc="{{ strtolower($pkg['location']) }}">
                                <div class="package-item-left">
                                    <img src="{{ $pkg['image'] }}" alt="{{ $pkg['name'] }}" class="package-item-thumb" loading="lazy">
                                    <div class="package-item-meta">
                                        <h4 class="package-item-name">{{ $pkg['name'] }}</h4>
                                        <span class="package-item-location">{{ $pkg['location'] }}</span>
                                    </div>
                                </div>
                                <div class="package-item-right">
                                    <div class="package-item-pricing">
                                        <span class="package-item-price">{{ $pkg['price'] }}</span>
                                        <span class="package-item-duration">
                                            <i class="fa-regular fa-clock"></i> {{ $pkg['duration'] }}
                                        </span>
                                    </div>
                                    <div class="package-item-actions">
                                        <button type="button" class="btn-action-icon edit" title="Edit Paket" onclick="openPackageModal('{{ $pkg['name'] }}', '{{ $pkg['price'] }}', '{{ $pkg['location'] }}')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn-action-icon delete" title="Hapus Paket" onclick="deletePackageConfirm('{{ $pkg['name'] }}')">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ---------------------------------------------------- -->
            <!-- TAB 3: RIWAYAT PEMESANAN TAB                         -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-riwayat-pemesanan">
                <div class="admin-section-card">
                    <div class="admin-card-header">
                        <h2 class="admin-card-title" style="font-size: 20px;">Riwayat Pemesanan Pelanggan</h2>
                    </div>

                    <div class="table-responsive-wrapper">
                        <table class="admin-orders-table">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Paket Wisata</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Total Pembayaran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Alexa Lubeille R.</div>
                                        <div class="table-text-sub">0987-3572-3833</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Jogja Tour 2 Hari</div>
                                        <div class="table-text-sub">Yogyakarta</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">01 Agustus 2026</div>
                                        <div class="table-text-sub">05 Agustus 2026</div>
                                    </td>
                                    <td>6 Orang</td>
                                    <td><strong>Rp. 13.200.000</strong></td>
                                    <td><span class="badge-status confirmed">Dikonfirmasi</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('alexa')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Nadia Putri</div>
                                        <div class="table-text-sub">0859-3555-4829</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Bandung Tour 4 Hari</div>
                                        <div class="table-text-sub">Bandung</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">06 Agustus 2026</div>
                                        <div class="table-text-sub">09 Agustus 2026</div>
                                    </td>
                                    <td>8 Orang</td>
                                    <td><strong>Rp. 14.400.000</strong></td>
                                    <td><span class="badge-status completed">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('nadia')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Raka Pratama</div>
                                        <div class="table-text-sub">0824-7872-3844</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Bali Tour 5 Hari</div>
                                        <div class="table-text-sub">Bali</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">27 Agustus 2026</div>
                                        <div class="table-text-sub">29 Agustus 2026</div>
                                    </td>
                                    <td>4 Orang</td>
                                    <td><strong>Rp. 11.000.000</strong></td>
                                    <td><span class="badge-status completed">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('raka')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Alya Ramadhani</div>
                                        <div class="table-text-sub">0928-7533-2088</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Lampung Tour 3 Hari</div>
                                        <div class="table-text-sub">Lampung</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">18 Juli 2026</div>
                                        <div class="table-text-sub">25 Juli 2026</div>
                                    </td>
                                    <td>7 Orang</td>
                                    <td><strong>Rp. 6.825.000</strong></td>
                                    <td><span class="badge-status completed">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('alya')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="table-text-main">Fajar Maulana</div>
                                        <div class="table-text-sub">0925-4489-3877</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">Bromo Tour 1 Hari</div>
                                        <div class="table-text-sub">Jawa Timur</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">19 Juli 2026</div>
                                        <div class="table-text-sub">27 Juli 2026</div>
                                    </td>
                                    <td>10 Orang</td>
                                    <td><strong>Rp. 4.990.000</strong></td>
                                    <td><span class="badge-status completed">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('fajar')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ---------------------------------------------------- -->
            <!-- TAB 4: PENGATURAN PROFIL TAB                         -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-pengaturan">
                <div class="admin-section-card">
                    <div class="admin-card-header">
                        <h2 class="admin-card-title" style="font-size: 20px;">Pengaturan Akun & Profil</h2>
                    </div>

                    <form class="admin-settings-form" onsubmit="event.preventDefault(); alert('Perubahan profil berhasil disimpan!');">
                        <div class="form-group-row">
                            <label class="form-group-label" for="settingName">Nama Pengguna</label>
                            <input type="text" id="settingName" class="form-input-control" value="{{ session('user.name', 'Ika Safitri Oktavia') }}" required>
                        </div>

                        <div class="form-group-row">
                            <label class="form-group-label" for="settingEmail">Email Pengguna</label>
                            <input type="email" id="settingEmail" class="form-input-control" value="{{ session('user.email', 'ikasafitrioktavia@gmail.com') }}" required>
                        </div>

                        <div class="form-group-row">
                            <label class="form-group-label" for="settingPhone">Nomor WhatsApp / Telepon</label>
                            <input type="tel" id="settingPhone" class="form-input-control" value="0812-3456-7890">
                        </div>

                        <div class="form-group-row">
                            <label class="form-group-label" for="settingPass">Ganti Password (Opsional)</label>
                            <input type="password" id="settingPass" class="form-input-control" placeholder="Biarkan kosong jika tidak ingin mengubah password">
                        </div>

                        <button type="submit" class="btn-save-settings">
                            <i class="fa-solid fa-floppy-disk" style="margin-right: 6px;"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            <!-- ---------------------------------------------------- -->
            <!-- TAB 5: DETAIL PEMESANAN (MATCHING REFERENCE DESIGN)  -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-detail-pemesanan">
                <div class="admin-section-card" style="padding: 28px 30px;">
                    <!-- Detail Header Row -->
                    <div class="detail-header-row">
                        <div class="detail-header-left">
                            <h2 class="detail-title">Detail Pemesanan</h2>
                            <span class="detail-subtitle">Dipesan pada <span id="dtOrderDate">01 Agustus 2026</span></span>
                            <div id="dtStatusBadge" class="dt-status-badge confirmed">Dikonfirmasi</div>
                        </div>
                        <div class="detail-header-actions">
                            <button type="button" class="btn-back-link" onclick="backToOrdersList()">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </button>
                            <button type="button" class="btn-detail-approve" id="dtActionBtn">
                                <i class="fa-solid fa-check"></i> <span id="dtActionBtnText">Disetujui</span>
                            </button>
                        </div>
                    </div>

                    <!-- 2-Subcolumn Layout -->
                    <div class="detail-content-grid">
                        <!-- Left Sub-column (4 Cards) -->
                        <div class="detail-left-cards">
                            <!-- 1. Informasi Paket Card -->
                            <div class="detail-info-card">
                                <h3 class="detail-card-title">Informasi Paket</h3>
                                <div class="detail-pkg-box">
                                    <img src="{{ asset('images/jogja.jpg') }}" alt="Paket" id="dtPkgImage" class="detail-pkg-img">
                                    <div class="detail-pkg-meta">
                                        <h4 class="detail-pkg-title" id="dtPkgName">Jogja Tour 2 Hari</h4>
                                        <div class="detail-pkg-feature">
                                            <i class="fa-regular fa-clock"></i>
                                            <span id="dtPkgDuration">Durasi 1 Hari</span>
                                        </div>
                                        <div class="detail-pkg-feature">
                                            <i class="fa-solid fa-hotel"></i>
                                            <span id="dtPkgHotel">No Hotel</span>
                                        </div>
                                        <div class="detail-pkg-feature">
                                            <i class="fa-solid fa-utensils"></i>
                                            <span id="dtPkgMeal">Makan 1x</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Informasi Pelanggan Card -->
                            <div class="detail-info-card">
                                <h3 class="detail-card-title">Informasi Pelanggan</h3>
                                <table class="detail-kv-table">
                                    <tr>
                                        <td class="label-col">Nama Lengkap</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtCustName">Alexa Lubeille R.</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Email</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtCustEmail">alexaxaxa@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">No WhatsApp</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtCustPhone">0897-3572-3833</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Alamat</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtCustAddress">Yogyakarta</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Catatan</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtCustNotes">Tidak ada catatan</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- 3. Informasi Pemesanan Card -->
                            <div class="detail-info-card">
                                <h3 class="detail-card-title">Informasi Pemesanan</h3>
                                <table class="detail-kv-table">
                                    <tr>
                                        <td class="label-col">Paket Wisata</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtOrderPkgName">Jogja Tour 2 Hari</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Tanggal Pesan</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtOrderBookingDate">01 Agustus 2026</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Tanggal Keberangkatan</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtOrderDepartDate">05 Agustus 2026</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Daerah Keberangkatan</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtOrderDepartCity">Lampung</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Harga Per-Orang</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtOrderPricePerPerson">Rp 2.200.000</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Jumlah Peserta</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtOrderParticipants">6 Orang</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- 4. Informasi Pembayaran Card -->
                            <div class="detail-info-card">
                                <h3 class="detail-card-title">Informasi Pembayaran</h3>
                                <table class="detail-kv-table">
                                    <tr>
                                        <td class="label-col">Metode Pembayaran</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtPayMethod">Midtrans (WhatsApp)</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Status Pembayaran</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtPayStatus">Berhasil</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Tanggal Pembayaran</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtPayDate">01 Agustus 2026</td>
                                    </tr>
                                    <tr>
                                        <td class="label-col">Total Pembayaran</td>
                                        <td class="sep-col">:</td>
                                        <td class="val-col" id="dtPayTotal" style="color: #ea580c; font-weight: 800;">Rp 13.200.000</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Right Sub-column (Bukti Pembayaran & Status Banner) -->
                        <div class="detail-right-cards">
                            <!-- Bukti Pembayaran Card -->
                            <div class="detail-info-card" style="padding: 20px;">
                                <h3 class="detail-card-title">Bukti Pembayaran</h3>
                                <div class="receipt-screen-wrapper">
                                    <div class="receipt-screen-title">Detail Transaksi</div>
                                    <div class="receipt-card-slip">
                                        <div class="receipt-icon-circle">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                        <div class="receipt-amount" id="dtReceiptAmount">Rp50.000</div>
                                        <div class="receipt-status-text">
                                            Pembayaran Berhasil<br>
                                            <span id="dtReceiptTime">16 Agu 2023 • 11:41</span>
                                        </div>
                                        <div class="receipt-id-num" id="dtReceiptId">12410379881212</div>
                                        <div><span class="receipt-badge-tag">PEMBAYARAN</span></div>
                                        <div class="receipt-dashed-line"></div>
                                        <div class="receipt-tx-info">
                                            <strong>Detail Transaksi</strong>
                                            <div>ID Transaksi: <span id="dtReceiptTx">20230816111121280010016686445575901</span></div>
                                            <div style="margin-top: 4px;">ID Order Merchant: <span id="dtReceiptMerchant">12012022023831150011739406522757</span></div>
                                        </div>
                                        <div style="text-align: left; margin-top: 10px; font-size: 10.5px; color: #64748b;">Metode Pembayaran</div>
                                        <div class="receipt-payment-method-row">
                                            <span id="dtReceiptMethod"><i class="fa-solid fa-circle-check" style="color: #2563eb; margin-right: 4px;"></i> Saldo DANA</span>
                                            <i class="fa-solid fa-circle-check" style="color: #2563eb;"></i>
                                        </div>
                                    </div>
                                    <div class="receipt-watermark">Powered by <strong>GO Travel</strong></div>
                                </div>
                            </div>

                            <!-- Status Banner Bottom Right -->
                            <div class="detail-status-banner confirmed" id="dtStatusBanner">
                                <div class="status-banner-icon">
                                    <i class="fa-regular fa-circle-check"></i>
                                </div>
                                <div class="status-banner-text">
                                    <span class="status-banner-title" id="dtBannerTitle">Menunggu perjalanan</span>
                                    <span class="status-banner-subtitle" id="dtBannerSubtitle">Menunggu perjalanan selesai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>

</div>

<!-- ==================== MODAL TAMBAH / EDIT PAKET ==================== -->
<div class="admin-modal-backdrop" id="packageFormModal">
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="packageModalTitle">Tambah Paket Wisata</h3>
            <button type="button" class="admin-modal-close" onclick="closePackageModal()">&times;</button>
        </div>
        <form onsubmit="event.preventDefault(); handlePackageSubmit();">
            <div class="admin-modal-body">
                <div class="form-group-row">
                    <label class="form-group-label">Nama Paket Wisata</label>
                    <input type="text" id="inputPkgName" class="form-input-control" placeholder="Contoh: Jogja Tour 2 Hari" required>
                </div>
                <div class="form-group-row">
                    <label class="form-group-label">Lokasi / Destinasi</label>
                    <input type="text" id="inputPkgLocation" class="form-input-control" placeholder="Contoh: D.I. Yogyakarta" required>
                </div>
                <div class="form-group-row">
                    <label class="form-group-label">Harga Paket</label>
                    <input type="text" id="inputPkgPrice" class="form-input-control" placeholder="Contoh: Rp.2.200.000" required>
                </div>
                <div class="form-group-row">
                    <label class="form-group-label">Durasi Tour</label>
                    <input type="text" id="inputPkgDuration" class="form-input-control" placeholder="Contoh: Durasi 2 Hari 1 Malam" required>
                </div>
                <button type="submit" class="btn-save-settings" style="width: 100%; text-align: center; margin-top: 10px;">
                    Simpan Paket Wisata
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Master Dataset of Orders for Interactive Detail Views
    const orderDatabase = {
        'alexa': {
            orderDate: '01 Agustus 2026',
            status: 'Dikonfirmasi',
            pkgName: 'Jogja Tour 2 Hari',
            pkgDuration: 'Durasi 1 Hari',
            pkgHotel: 'No Hotel',
            pkgMeal: 'Makan 1x',
            pkgImage: '{{ asset("images/jogja.jpg") }}',
            custName: 'Alexa Lubeille R.',
            custEmail: 'alexaxaxa@gmail.com',
            custPhone: '0987-3572-3833',
            custAddress: 'Yogyakarta',
            custNotes: 'Tidak ada catatan',
            bookingDate: '01 Agustus 2026',
            departDate: '05 Agustus 2026',
            departCity: 'Lampung',
            pricePerPerson: 'Rp 2.200.000',
            participants: '6 Orang',
            payMethod: 'Midtrans (WhatsApp)',
            payStatus: 'Berhasil',
            payDate: '01 Agustus 2026',
            totalPay: 'Rp 13.200.000',
            receiptAmount: 'Rp50.000',
            receiptTime: '16 Agu 2023 • 11:41',
            receiptId: '12410379881212',
            receiptTx: '20230816111121280010016686445575901',
            receiptMerchant: '12012022023831150011739406522757',
            receiptMethod: 'Saldo DANA'
        },
        'nadia': {
            orderDate: '06 Agustus 2026',
            status: 'Selesai',
            pkgName: 'Bandung Tour 4 Hari',
            pkgDuration: 'Durasi 4 Hari 3 Malam',
            pkgHotel: 'Hotel Bintang 3',
            pkgMeal: 'Makan 7x',
            pkgImage: '{{ asset("images/bandung.jpg") }}',
            custName: 'Nadia Putri',
            custEmail: 'nadiaputri@gmail.com',
            custPhone: '0859-3555-4829',
            custAddress: 'Bandung',
            custNotes: 'Minta kursi baris depan untuk lansia',
            bookingDate: '06 Agustus 2026',
            departDate: '09 Agustus 2026',
            departCity: 'Jakarta',
            pricePerPerson: 'Rp 1.800.000',
            participants: '8 Orang',
            payMethod: 'Transfer Bank BCA',
            payStatus: 'Berhasil',
            payDate: '06 Agustus 2026',
            totalPay: 'Rp 14.400.000',
            receiptAmount: 'Rp 14.400.000',
            receiptTime: '06 Agu 2026 • 14:20',
            receiptId: '12410379881213',
            receiptTx: '20230806142021280010016686445575902',
            receiptMerchant: '12012022023831150011739406522758',
            receiptMethod: 'Transfer Bank BCA'
        },
        'raka': {
            orderDate: '27 Agustus 2026',
            status: 'Selesai',
            pkgName: 'Bali Tour 5 Hari',
            pkgDuration: 'Durasi 5 Hari 4 Malam',
            pkgHotel: 'Hotel Bintang 4',
            pkgMeal: 'Makan Lengkap & Seafood Jimbaran',
            pkgImage: '{{ asset("images/bali.jpg") }}',
            custName: 'Raka Pratama',
            custEmail: 'rakapratama@gmail.com',
            custPhone: '0824-7872-3844',
            custAddress: 'Bali',
            custNotes: 'Tidak ada catatan',
            bookingDate: '27 Agustus 2026',
            departDate: '29 Agustus 2026',
            departCity: 'Surabaya',
            pricePerPerson: 'Rp 2.750.000',
            participants: '4 Orang',
            payMethod: 'Midtrans (QRIS)',
            payStatus: 'Berhasil',
            payDate: '27 Agustus 2026',
            totalPay: 'Rp 11.000.000',
            receiptAmount: 'Rp 11.000.000',
            receiptTime: '27 Agu 2026 • 09:15',
            receiptId: '12410379881214',
            receiptTx: '20230827091521280010016686445575903',
            receiptMerchant: '12012022023831150011739406522759',
            receiptMethod: 'QRIS / GoPay'
        },
        'alya': {
            orderDate: '18 Juli 2026',
            status: 'Selesai',
            pkgName: 'Lampung Tour 3 Hari',
            pkgDuration: 'Durasi 3 Hari 2 Malam',
            pkgHotel: 'Hotel Bintang 3',
            pkgMeal: 'Makan Lengkap & Ikan Bakar',
            pkgImage: '{{ asset("images/lampung.jpg") }}',
            custName: 'Alya Ramadhani',
            custEmail: 'alyaramadhani@gmail.com',
            custPhone: '0928-7533-2088',
            custAddress: 'Lampung',
            custNotes: 'Perjalanan liburan keluarga',
            bookingDate: '18 Juli 2026',
            departDate: '25 Juli 2026',
            departCity: 'Jakarta',
            pricePerPerson: 'Rp 975.000',
            participants: '7 Orang',
            payMethod: 'Transfer Mandiri',
            payStatus: 'Berhasil',
            payDate: '18 Juli 2026',
            totalPay: 'Rp 6.825.000',
            receiptAmount: 'Rp 6.825.000',
            receiptTime: '18 Jul 2026 • 16:45',
            receiptId: '12410379881215',
            receiptTx: '20230718164521280010016686445575904',
            receiptMerchant: '12012022023831150011739406522760',
            receiptMethod: 'Mandiri Virtual Account'
        },
        'fajar': {
            orderDate: '19 Juli 2026',
            status: 'Selesai',
            pkgName: 'Bromo Tour 1 Hari',
            pkgDuration: 'Durasi 1 Hari',
            pkgHotel: 'Transit Homestay Bromo',
            pkgMeal: '1x Sarapan & Kopi Hangat',
            pkgImage: '{{ asset("images/bromo.jpg") }}',
            custName: 'Fajar Maulana',
            custEmail: 'fajarmaulana@gmail.com',
            custPhone: '0925-4489-3877',
            custAddress: 'Jawa Timur',
            custNotes: 'Trip bareng rekan kerja',
            bookingDate: '19 Juli 2026',
            departDate: '27 Juli 2026',
            departCity: 'Surabaya',
            pricePerPerson: 'Rp 499.000',
            participants: '10 Orang',
            payMethod: 'Midtrans (GoPay)',
            payStatus: 'Berhasil',
            payDate: '19 Juli 2026',
            totalPay: 'Rp 4.990.000',
            receiptAmount: 'Rp 4.990.000',
            receiptTime: '19 Jul 2026 • 20:10',
            receiptId: '12410379881216',
            receiptTx: '20230719201021280010016686445575905',
            receiptMerchant: '12012022023831150011739406522761',
            receiptMethod: 'GoPay / QRIS'
        }
    };

    // Tab Navigation Logic
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.sidebar-nav-link[data-tab]');
        const tabPanes = document.querySelectorAll('.tab-content-pane');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                activateTab(targetTab);
            });
        });

        // Real-time package search filter
        const searchInput = document.getElementById('packageFilterInput');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase().trim();
                const packageCards = document.querySelectorAll('.full-package-card');
                let matchCount = 0;

                packageCards.forEach(card => {
                    const title = card.getAttribute('data-title') || '';
                    const loc = card.getAttribute('data-loc') || '';
                    if (title.includes(query) || loc.includes(query)) {
                        card.style.display = 'flex';
                        matchCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                const badge = document.getElementById('packageBadgeCount');
                if (badge) {
                    badge.textContent = matchCount;
                }
            });
        }
    });

    function activateTab(tabId) {
        // Deactivate all buttons & panes
        document.querySelectorAll('.sidebar-nav-link[data-tab]').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content-pane').forEach(pane => pane.classList.remove('active'));

        // Activate matching button & pane
        const activeBtn = document.querySelector(`.sidebar-nav-link[data-tab="${tabId}"]`);
        const activePane = document.getElementById(tabId);

        if (activeBtn) activeBtn.classList.add('active');
        if (activePane) activePane.classList.add('active');
    }

    // Detail Pemesanan View Function
    function showOrderDetail(orderKey) {
        const data = orderDatabase[orderKey] || orderDatabase['alexa'];

        document.getElementById('dtOrderDate').textContent = data.orderDate;
        
        // Status Badge, Action Button, and Bottom Banner
        const badge = document.getElementById('dtStatusBadge');
        const actionBtn = document.getElementById('dtActionBtn');
        const actionBtnText = document.getElementById('dtActionBtnText');
        const banner = document.getElementById('dtStatusBanner');
        const bannerTitle = document.getElementById('dtBannerTitle');
        const bannerSub = document.getElementById('dtBannerSubtitle');

        if (data.status === 'Dikonfirmasi') {
            badge.className = 'dt-status-badge confirmed';
            badge.textContent = 'Dikonfirmasi';
            
            actionBtn.className = 'btn-detail-approve';
            actionBtnText.textContent = 'Disetujui';
            
            banner.className = 'detail-status-banner confirmed';
            bannerTitle.textContent = 'Menunggu perjalanan';
            bannerSub.textContent = 'Menunggu perjalanan selesai';
        } else if (data.status === 'Selesai') {
            badge.className = 'dt-status-badge completed';
            badge.textContent = 'Selesai';
            
            actionBtn.className = 'btn-detail-approve completed';
            actionBtnText.textContent = 'Perjalanan Selesai';
            
            banner.className = 'detail-status-banner completed';
            bannerTitle.textContent = 'Perjalanan Selesai';
            bannerSub.textContent = 'Perjalanan telah selesai dan dinikmati pelanggan';
        } else {
            badge.className = 'dt-status-badge pending';
            badge.textContent = 'Dipending';
            
            actionBtn.className = 'btn-detail-approve';
            actionBtnText.textContent = 'Disetujui';
            
            banner.className = 'detail-status-banner';
            bannerTitle.textContent = 'Menunggu Konfirmasi';
            bannerSub.textContent = 'Menunggu pembayaran diverifikasi';
        }

        // Populate Fields
        document.getElementById('dtPkgName').textContent = data.pkgName;
        document.getElementById('dtPkgDuration').textContent = data.pkgDuration;
        document.getElementById('dtPkgHotel').textContent = data.pkgHotel;
        document.getElementById('dtPkgMeal').textContent = data.pkgMeal;
        document.getElementById('dtPkgImage').src = data.pkgImage;

        document.getElementById('dtCustName').textContent = data.custName;
        document.getElementById('dtCustEmail').textContent = data.custEmail;
        document.getElementById('dtCustPhone').textContent = data.custPhone;
        document.getElementById('dtCustAddress').textContent = data.custAddress;
        document.getElementById('dtCustNotes').textContent = data.custNotes;

        document.getElementById('dtOrderPkgName').textContent = data.pkgName;
        document.getElementById('dtOrderBookingDate').textContent = data.bookingDate;
        document.getElementById('dtOrderDepartDate').textContent = data.departDate;
        document.getElementById('dtOrderDepartCity').textContent = data.departCity;
        document.getElementById('dtOrderPricePerPerson').textContent = data.pricePerPerson;
        document.getElementById('dtOrderParticipants').textContent = data.participants;

        document.getElementById('dtPayMethod').textContent = data.payMethod;
        document.getElementById('dtPayStatus').textContent = data.payStatus;
        document.getElementById('dtPayDate').textContent = data.payDate;
        document.getElementById('dtPayTotal').textContent = data.totalPay;

        document.getElementById('dtReceiptAmount').textContent = data.receiptAmount;
        document.getElementById('dtReceiptTime').textContent = data.receiptTime;
        document.getElementById('dtReceiptId').textContent = data.receiptId;
        document.getElementById('dtReceiptTx').textContent = data.receiptTx;
        document.getElementById('dtReceiptMerchant').textContent = data.receiptMerchant;
        document.getElementById('dtReceiptMethod').innerHTML = `<i class="fa-solid fa-circle-check" style="color: #2563eb; margin-right: 4px;"></i> ${data.receiptMethod}`;

        // Switch pane
        document.querySelectorAll('.tab-content-pane').forEach(p => p.classList.remove('active'));
        document.getElementById('tab-detail-pemesanan').classList.add('active');

        // Keep Riwayat Pemesanan sidebar link active
        document.querySelectorAll('.sidebar-nav-link').forEach(btn => btn.classList.remove('active'));
        const riwayatBtn = document.querySelector('.sidebar-nav-link[data-tab="tab-riwayat-pemesanan"]');
        if (riwayatBtn) riwayatBtn.classList.add('active');

        window.scrollTo({ top: document.querySelector('.admin-glass-container').offsetTop - 20, behavior: 'smooth' });
    }

    function backToOrdersList() {
        activateTab('tab-riwayat-pemesanan');
    }

    // Modal Tambah / Edit Paket
    function openAddPackageModal() {
        document.getElementById('packageModalTitle').textContent = 'Tambah Paket Wisata Baru';
        document.getElementById('inputPkgName').value = '';
        document.getElementById('inputPkgLocation').value = '';
        document.getElementById('inputPkgPrice').value = '';
        document.getElementById('inputPkgDuration').value = '';
        document.getElementById('packageFormModal').classList.add('show');
    }

    function openPackageModal(name, price, location) {
        document.getElementById('packageModalTitle').textContent = 'Edit Paket Wisata';
        document.getElementById('inputPkgName').value = name;
        document.getElementById('inputPkgLocation').value = location;
        document.getElementById('inputPkgPrice').value = price;
        document.getElementById('inputPkgDuration').value = 'Durasi Sesuai Paket';
        document.getElementById('packageFormModal').classList.add('show');
    }

    function closePackageModal() {
        document.getElementById('packageFormModal').classList.remove('show');
    }

    function handlePackageSubmit() {
        alert('Data paket wisata berhasil diperbarui!');
        closePackageModal();
    }

    function deletePackageConfirm(pkgName) {
        if (confirm(`Apakah Anda yakin ingin menghapus paket "${pkgName}"?`)) {
            alert(`Paket "${pkgName}" berhasil dihapus.`);
        }
    }

    // Logout Confirmation Modal
    function openLogoutModal() {
        const modal = document.getElementById('logoutModal');
        if (modal) {
            modal.classList.add('show');
        }
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutModal');
        if (modal) {
            modal.classList.remove('show');
        }
    }

    // Close modals on backdrop click
    window.addEventListener('click', function(e) {
        const pkgModal = document.getElementById('packageFormModal');
        const logoutModal = document.getElementById('logoutModal');
        if (e.target === pkgModal) {
            closePackageModal();
        }
        if (e.target === logoutModal) {
            closeLogoutModal();
        }
    });

    // Close modals on Escape key
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePackageModal();
            closeLogoutModal();
        }
    });
</script>

<!-- ==================== MODAL LOGOUT CONFIRMATION ==================== -->
<div class="admin-modal-backdrop" id="logoutModal">
    <div class="admin-modal-box logout-modal-box">
        <div class="logout-icon-wrapper">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </div>
        <h3 class="logout-modal-title">Konfirmasi Keluar</h3>
        <p class="logout-modal-desc">
            Apakah Anda yakin ingin keluar dari sesi admin Go Travel? Anda harus masuk kembali untuk mengakses halaman ini.
        </p>
        <div class="logout-actions-row">
            <button type="button" class="btn-modal-cancel" onclick="closeLogoutModal()">
                Batal
            </button>
            <a href="{{ url('/logout') }}" class="btn-modal-confirm-logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Ya, Keluar</span>
            </a>
        </div>
    </div>
</div>
@endsection
