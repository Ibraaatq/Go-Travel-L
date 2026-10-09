@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <style>
        /* Toast notification styling */
        .admin-toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 10000;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }
        .admin-toast {
            min-width: 300px;
            max-width: 420px;
            background: #ffffff;
            color: #0f172a;
            border-radius: 16px;
            padding: 14px 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 5px solid #16a34a;
            font-size: 13.5px;
            font-weight: 600;
            pointer-events: auto;
            transform: translateX(120%);
            opacity: 0;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        }
        .admin-toast.show {
            transform: translateX(0);
            opacity: 1;
        }
        .admin-toast.toast-success {
            border-left-color: #16a34a;
        }
        .admin-toast.toast-info {
            border-left-color: #0284c7;
        }
        .admin-toast-icon {
            font-size: 18px;
            color: #16a34a;
        }
        .admin-toast.toast-info .admin-toast-icon {
            color: #0284c7;
        }
        .badge-status {
            transition: all 0.25s ease;
        }
        .btn-detail-approve {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
        }
        .btn-detail-approve.completed,
        .btn-detail-approve.approved {
            background: #16a34a !important;
            box-shadow: 0 4px 14px rgba(22, 163, 74, 0.35) !important;
            color: #ffffff !important;
        }
        .btn-detail-approve.completed:hover,
        .btn-detail-approve.approved:hover {
            background: #15803d !important;
            box-shadow: 0 6px 18px rgba(22, 163, 74, 0.45) !important;
        }
    </style>
@endsection

@php
    $userRole = session('user.role', 'admin');
    // If not explicitly 'user', default to 'admin' (or if session user has admin credentials)
    $isAdmin = ($userRole === 'admin');
@endphp

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
                <div style="margin-top: 6px;">
                    <span style="display: inline-block; padding: 2px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; {{ $isAdmin ? 'background: #fee2e2; color: #dc2626;' : 'background: #e0f2fe; color: #0284c7;' }}">
                        {{ $isAdmin ? 'Admin' : 'User' }}
                    </span>
                </div>
            </div>

            <!-- Sidebar Nav Menu -->
            <nav>
                <ul class="sidebar-nav-list">
                    @if($isAdmin)
                        {{-- MENU LENGKAP UNTUK ADMIN --}}
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
                    @else
                        {{-- MENU KHUSUS USER BIASA: HANYA RIWAYAT DAN LOGOUT --}}
                        <li class="sidebar-nav-item">
                            <button type="button" class="sidebar-nav-link active" data-tab="tab-riwayat-pemesanan">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <span>Riwayat Pemesanan</span>
                            </button>
                        </li>
                        <li class="sidebar-nav-item">
                            <button type="button" class="sidebar-nav-link nav-logout" onclick="openLogoutModal()">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <span>Logout</span>
                            </button>
                        </li>
                    @endif
                </ul>
            </nav>
        </aside>

        <!-- ==================== KOLOM KANAN: DASHBOARD CONTENT ==================== -->
        <main class="admin-main-content">

            @if($isAdmin)
            <!-- ---------------------------------------------------- -->
            <!-- TAB 1: DASHBOARD OVERVIEW (KHUSUS ADMIN)             -->
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
                            <span class="summary-number" id="summaryTotalCount">5</span>
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
                            <span class="summary-number" id="summaryCompletedCount">4</span>
                            <span class="summary-subtitle">Perjalanan selesai</span>
                        </div>
                    </div>

                    <!-- Dipending Card (Diperbarui dari Dikonfirmasi) -->
                    <div class="summary-card pending-orders">
                        <div class="summary-icon-circle">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-title">Dipending</span>
                            <span class="summary-number" id="summaryPendingCount">1</span>
                            <span class="summary-subtitle">Menunggu konfirmasi</span>
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

                    <div class="packages-horizontal-list" id="dashboardPackagesList">
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
                            <div class="package-item-card" data-package-slug="{{ $item['slug'] }}" data-title="{{ strtolower($item['name']) }}" data-loc="{{ strtolower($item['location']) }}">
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
                                        <button type="button" class="btn-action-icon edit" title="Edit Paket" onclick="openEditPackageView('{{ $item['slug'] }}', 'tab-dashboard')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn-action-icon delete" title="Hapus Paket" onclick="deletePackageConfirm('{{ $item['slug'] }}', '{{ addslashes($item['name']) }}')">
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
                                    <td><span class="badge-status pending" data-order-badge="alexa">Dipending</span></td>
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
                                    <td><span class="badge-status completed" data-order-badge="nadia">Selesai</span></td>
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
                                    <td><span class="badge-status completed" data-order-badge="raka">Selesai</span></td>
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
                                    <td><span class="badge-status completed" data-order-badge="alya">Selesai</span></td>
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
                                    <td><span class="badge-status completed" data-order-badge="fajar">Selesai</span></td>
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
            <!-- TAB 2: DAFTAR PAKET WISATA                           -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-paket-wisata">
                <div class="admin-section-card">
                    <!-- Header with Title & Badge Count -->
                    <div class="admin-card-header">
                        <h2 class="admin-card-title">Daftar Paket Wisata</h2>
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
                        <button type="button" class="btn-add-package" onclick="openAddPackageView()">
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
                            <div class="package-item-card full-package-card" data-package-slug="{{ $pkg['slug'] }}" data-title="{{ strtolower($pkg['name']) }}" data-loc="{{ strtolower($pkg['location']) }}">
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
                                        <button type="button" class="btn-action-icon edit" title="Edit Paket" onclick="openEditPackageView('{{ $pkg['slug'] }}', 'tab-paket-wisata')">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn-action-icon delete" title="Hapus Paket" onclick="deletePackageConfirm('{{ $pkg['slug'] }}', '{{ addslashes($pkg['name']) }}')">
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
            <!-- TAB: TAMBAH PAKET WISATA (MATCHING SCREENSHOT)       -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-tambah-paket">
                <form id="addPackageForm" onsubmit="event.preventDefault(); handleSavePackageForm();" class="package-form-container">
                    
                    <!-- 1. Tambah Gambar -->
                    <div class="package-form-card">
                        <h3 class="form-section-heading">1. Tambah Gambar</h3>
                        <div class="upload-dropzone" id="packageDropzone" onclick="document.getElementById('packageImageInput').click();">
                            <input type="file" id="packageImageInput" accept="image/png, image/jpeg, image/webp" style="display: none;" onchange="handlePackageImageSelect(this)">
                            
                            <div class="upload-dropzone-content" id="uploadPlaceholderContent">
                                <div class="upload-icon-circle">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="upload-main-text">
                                    Seret &amp; letakkan gambar disini atau <span class="upload-link-text">klik untuk memilih file</span>
                                </div>
                                <div class="upload-hint-text">
                                    Format: JPG, PNG, WEBP. Maksimal 2MB
                                </div>
                            </div>

                            <div class="image-preview-wrapper" id="packageImagePreviewWrap" onclick="event.stopPropagation();">
                                <img id="packageImagePreview" src="" alt="Preview Gambar">
                                <button type="button" class="btn-remove-preview" title="Hapus Gambar" onclick="removePackageImagePreview(event)">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Informasi Paket -->
                    <div class="package-form-card">
                        <h3 class="form-section-heading">2. Informasi Paket</h3>
                        <div class="form-grid-2col">
                            <!-- Nama Paket Wisata -->
                            <div class="form-field-group">
                                <label class="form-field-label">Nama Paket Wisata</label>
                                <input type="text" id="inputFormPkgName" class="form-text-input" placeholder="Tulis nama paket wisata" required>
                            </div>

                            <!-- Harga Mulai (Rp) -->
                            <div class="form-field-group">
                                <label class="form-field-label">Harga Mulai (Rp)</label>
                                <input type="text" id="inputFormPkgPrice" class="form-text-input" placeholder="Tulis harga" required>
                            </div>

                            <!-- Destinasi -->
                            <div class="form-field-group">
                                <label class="form-field-label">Destinasi</label>
                                <div class="custom-select-wrapper">
                                    <select id="inputFormPkgDest" class="form-select-control" required>
                                        <option value="" disabled selected>Pilih destinasi</option>
                                        <option value="Yogyakarta">Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Bandung">Bandung</option>
                                        <option value="Bogor">Bogor</option>
                                        <option value="Jakarta">Jakarta</option>
                                        <option value="Lombok">Lombok</option>
                                        <option value="Labuan Bajo">Labuan Bajo</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down select-chevron"></i>
                                </div>
                            </div>

                            <!-- Kategori Paket -->
                            <div class="form-field-group">
                                <label class="form-field-label">Kategori Paket</label>
                                <div class="custom-select-wrapper">
                                    <select id="inputFormPkgCategory" class="form-select-control" required>
                                        <option value="" disabled selected>Pilih kategori paket</option>
                                        <option value="Wisata Alam">Wisata Alam</option>
                                        <option value="Wisata Budaya">Wisata Budaya</option>
                                        <option value="Wisata Pantai">Wisata Pantai</option>
                                        <option value="Family Trip">Family Trip</option>
                                        <option value="Open Trip">Open Trip</option>
                                        <option value="Honeymoon">Honeymoon</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down select-chevron"></i>
                                </div>
                            </div>

                            <!-- Durasi -->
                            <div class="form-field-group">
                                <label class="form-field-label">Durasi</label>
                                <input type="text" id="inputFormPkgDuration" class="form-text-input" placeholder="Tulis durasi perjalanan" required>
                            </div>

                            <!-- Makan -->
                            <div class="form-field-group">
                                <label class="form-field-label">Makan</label>
                                <input type="text" id="inputFormPkgMeal" class="form-text-input" placeholder="Tulis makan yang didapatkan">
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-field-group full-width">
                                <label class="form-field-label">Deskripsi</label>
                                <textarea id="inputFormPkgDesc" class="form-textarea-control" placeholder="Tulis deskripsi paket wisata" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Rencana Perjalanan -->
                    <div class="package-form-card">
                        <div class="itinerary-section-header">
                            <h3 class="form-section-heading" style="margin-bottom: 0;">3. Rencana Perjalanan</h3>
                            <button type="button" class="btn-add-itinerary" onclick="addItineraryDay()">
                                <i class="fa-solid fa-plus"></i>
                                <span>Tambah Rencana Perjalanan</span>
                            </button>
                        </div>

                        <!-- Empty State Alert Box -->
                        <div class="itinerary-empty-alert" id="itineraryEmptyAlert">
                            <div class="alert-icon">
                                <i class="fa-solid fa-exclamation"></i>
                            </div>
                            <div class="alert-content">
                                <span class="alert-title">Belum Ada Rencana Perjalanan</span>
                                <span class="alert-desc">Klik tombol <strong>Tambah Rencana Perjalanan</strong> untuk menambahkan rencana perjalanan.</span>
                            </div>
                        </div>

                        <!-- Dynamic Itinerary Days List -->
                        <div class="itinerary-items-list" id="itineraryDaysContainer"></div>
                    </div>

                    <!-- Action Buttons Bottom Row -->
                    <div class="form-actions-bottom-row">
                        <button type="button" class="btn-form-back" onclick="backToPackageList()">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Kembali</span>
                        </button>
                        <button type="submit" class="btn-form-save">
                            <span>Simpan</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- ---------------------------------------------------- -->
            <!-- TAB: EDIT PAKET WISATA (MATCHING SCREENSHOT)         -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-edit-paket">
                <h2 class="edit-package-title" id="editPageMainTitle">Edit Paket Wisata - Jogja Tour 2 Hari</h2>

                <form id="editPackageForm" onsubmit="event.preventDefault(); handleSaveEditPackageForm();" class="package-form-container">
                    <input type="hidden" id="editPkgSlug" value="jogja">
                    <input type="hidden" id="editFromTab" value="tab-paket-wisata">

                    <!-- 1. Ubah Gambar -->
                    <div class="package-form-card">
                        <h3 class="form-section-heading">1. Ubah Gambar</h3>
                        <div class="upload-dropzone" id="editPackageDropzone" onclick="document.getElementById('editPackageImageInput').click();">
                            <input type="file" id="editPackageImageInput" accept="image/png, image/jpeg, image/webp" style="display: none;" onchange="handleEditPackageImageSelect(this)">
                            
                            <div class="upload-dropzone-content" id="editUploadPlaceholderContent" style="display: none;">
                                <div class="upload-icon-circle">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="upload-main-text">
                                    Seret &amp; letakkan gambar disini atau <span class="upload-link-text">klik untuk memilih file</span>
                                </div>
                                <div class="upload-hint-text">
                                    Format: JPG, PNG, WEBP. Maksimal 2MB
                                </div>
                            </div>

                            <div class="image-preview-wrapper" id="editPackageImagePreviewWrap" style="display: block;" onclick="event.stopPropagation();">
                                <img id="editPackageImagePreview" src="{{ asset('images/jogja.jpg') }}" alt="Preview Gambar">
                                <button type="button" class="btn-remove-preview" title="Hapus Gambar" onclick="removeEditPackageImagePreview(event)">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Informasi Paket -->
                    <div class="package-form-card">
                        <h3 class="form-section-heading">2. Informasi Paket</h3>
                        <div class="form-grid-2col">
                            <!-- Nama Paket Wisata -->
                            <div class="form-field-group">
                                <label class="form-field-label">Nama Paket Wisata</label>
                                <input type="text" id="editFormPkgName" class="form-text-input" placeholder="Ubah nama paket wisata" required>
                            </div>

                            <!-- Harga Mulai (Rp) -->
                            <div class="form-field-group">
                                <label class="form-field-label">Harga Mulai (Rp)</label>
                                <input type="text" id="editFormPkgPrice" class="form-text-input" placeholder="Ubah harga" required>
                            </div>

                            <!-- Destinasi -->
                            <div class="form-field-group">
                                <label class="form-field-label">Destinasi</label>
                                <div class="custom-select-wrapper">
                                    <select id="editFormPkgDest" class="form-select-control" required>
                                        <option value="" disabled>Ubah destinasi</option>
                                        <option value="Yogyakarta" selected>Yogyakarta</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Bandung">Bandung</option>
                                        <option value="Bogor">Bogor</option>
                                        <option value="Jakarta">Jakarta</option>
                                        <option value="Lombok">Lombok</option>
                                        <option value="Labuan Bajo">Labuan Bajo</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down select-chevron"></i>
                                </div>
                            </div>

                            <!-- Kategori Paket -->
                            <div class="form-field-group">
                                <label class="form-field-label">Kategori Paket</label>
                                <div class="custom-select-wrapper">
                                    <select id="editFormPkgCategory" class="form-select-control" required>
                                        <option value="" disabled>Ubah kategori paket</option>
                                        <option value="Wisata Alam">Wisata Alam</option>
                                        <option value="Wisata Budaya" selected>Wisata Budaya</option>
                                        <option value="Wisata Pantai">Wisata Pantai</option>
                                        <option value="Family Trip">Family Trip</option>
                                        <option value="Open Trip">Open Trip</option>
                                        <option value="Honeymoon">Honeymoon</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down select-chevron"></i>
                                </div>
                            </div>

                            <!-- Durasi -->
                            <div class="form-field-group">
                                <label class="form-field-label">Durasi</label>
                                <input type="text" id="editFormPkgDuration" class="form-text-input" placeholder="Ubah durasi perjalanan" required>
                            </div>

                            <!-- Makan -->
                            <div class="form-field-group">
                                <label class="form-field-label">Makan</label>
                                <input type="text" id="editFormPkgMeal" class="form-text-input" placeholder="Ubah makan yang didapatkan">
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-field-group full-width">
                                <label class="form-field-label">Deskripsi</label>
                                <textarea id="editFormPkgDesc" class="form-textarea-control" placeholder="Ubah deskripsi paket wisata" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Rencana Perjalanan -->
                    <div class="package-form-card">
                        <div class="itinerary-section-header">
                            <h3 class="form-section-heading" style="margin-bottom: 0;">3. Rencana Perjalanan</h3>
                            <button type="button" class="btn-add-itinerary" onclick="addEditItineraryDay()">
                                <i class="fa-solid fa-plus"></i>
                                <span>Ubah Rencana Perjalanan</span>
                            </button>
                        </div>

                        <!-- Empty State Alert Box -->
                        <div class="itinerary-empty-alert" id="editItineraryEmptyAlert" style="display: none;">
                            <div class="alert-icon">
                                <i class="fa-solid fa-exclamation"></i>
                            </div>
                            <div class="alert-content">
                                <span class="alert-title">Belum Ada Rencana Perjalanan</span>
                                <span class="alert-desc">Klik tombol <strong>Ubah Rencana Perjalanan</strong> untuk menambahkan rencana perjalanan.</span>
                            </div>
                        </div>

                        <!-- Dynamic Itinerary Days List -->
                        <div class="itinerary-items-list" id="editItineraryDaysContainer"></div>
                    </div>

                    <!-- Action Buttons Bottom Row -->
                    <div class="form-actions-bottom-row">
                        <button type="button" class="btn-form-back" onclick="backFromEditPackage()">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Kembali</span>
                        </button>
                        <button type="submit" class="btn-form-save">
                            <span>Ubah Rencana Perjalanan</span>
                        </button>
                    </div>
                </form>
            </div>
            @endif

            <!-- ---------------------------------------------------- -->
            <!-- TAB 3: RIWAYAT PEMESANAN TAB (UNTUK ADMIN & USER)    -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane {{ !$isAdmin ? 'active' : '' }}" id="tab-riwayat-pemesanan">
                <div class="admin-section-card">
                    <div class="admin-card-header">
                        <h2 class="admin-card-title">{{ $isAdmin ? 'Riwayat Pemesanan Pelanggan' : 'Riwayat Pemesanan Saya' }}</h2>
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
                                    <td><span class="badge-status pending" data-order-badge="alexa">Dipending</span></td>
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
                                    <td><span class="badge-status completed" data-order-badge="nadia">Selesai</span></td>
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
                                    <td><span class="badge-status completed" data-order-badge="raka">Selesai</span></td>
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
                                    <td><span class="badge-status completed" data-order-badge="alya">Selesai</span></td>
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
                                    <td><span class="badge-status completed" data-order-badge="fajar">Selesai</span></td>
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

            @if($isAdmin)
            <!-- ---------------------------------------------------- -->
            <!-- TAB 4: PENGATURAN PROFIL TAB (KHUSUS ADMIN)          -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-pengaturan">
                <div class="admin-section-card">
                    <div class="admin-card-header">
                        <h2 class="admin-card-title">Pengaturan Akun & Profil</h2>
                    </div>

                    <form class="admin-settings-form" onsubmit="event.preventDefault(); showToast('Perubahan profil berhasil disimpan!', 'success');">
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
            @endif

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
                            <div id="dtStatusBadge" class="dt-status-badge pending">Dipending</div>
                        </div>
                        <div class="detail-header-actions">
                            <button type="button" class="btn-back-link" onclick="backToOrdersList()">
                                <i class="fa-solid fa-arrow-left"></i> Kembali
                            </button>
                            @if($isAdmin)
                            <button type="button" class="btn-detail-approve" id="dtActionBtn" onclick="toggleApproveOrder()">
                                <i class="fa-solid fa-clock" id="dtActionBtnIcon"></i> <span id="dtActionBtnText">Dikonfirmasi</span>
                            </button>
                            @endif
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
                            <div class="detail-status-banner pending" id="dtStatusBanner">
                                <div class="status-banner-icon">
                                    <i class="fa-regular fa-clock" id="dtBannerIcon"></i>
                                </div>
                                <div class="status-banner-text">
                                    <span class="status-banner-title" id="dtBannerTitle">Menunggu Konfirmasi</span>
                                    <span class="status-banner-subtitle" id="dtBannerSubtitle">Menunggu pembayaran diverifikasi & disetujui</span>
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

<!-- ==================== TOAST NOTIFICATION CONTAINER ==================== -->
<div class="admin-toast-container" id="adminToastContainer"></div>

<!-- ==================== SCRIPT LOGIKA PROFILE & ADMIN DASHBOARD ==================== -->
<script>
    // Master Dataset of Orders with initial 'Dipending' status for Alexa
    const orderDatabase = {
        'alexa': {
            orderDate: '01 Agustus 2026',
            status: 'Dipending',
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

    let currentViewingOrderKey = 'alexa';

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

        // Drag & Drop handlers for Package Image Upload
        const dropzone = document.getElementById('packageDropzone');
        if (dropzone) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('dragover');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('dragover');
                }, false);
            });

            dropzone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                const input = document.getElementById('packageImageInput');
                if (files && files.length > 0) {
                    if (input) input.files = files;
                    handlePackageImageSelect(input);
                }
            }, false);
        }

        updateSummaryCounts();

        // Search Filter for Packages List
        const filterInput = document.getElementById('packageFilterInput');
        if (filterInput) {
            filterInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase().trim();
                const cards = document.querySelectorAll('#fullPackagesList .package-item-card');
                cards.forEach(card => {
                    const title = (card.getAttribute('data-title') || '').toLowerCase();
                    const loc = (card.getAttribute('data-loc') || '').toLowerCase();
                    if (title.includes(query) || loc.includes(query)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });

    function activateTab(tabId) {
        document.querySelectorAll('.sidebar-nav-link[data-tab]').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content-pane').forEach(pane => pane.classList.remove('active'));

        const activeBtn = document.querySelector(`.sidebar-nav-link[data-tab="${tabId}"]`);
        const activePane = document.getElementById(tabId);

        if (activeBtn) activeBtn.classList.add('active');
        if (activePane) activePane.classList.add('active');
    }

    // ==========================================
    // MASTER DATASET OF PACKAGES
    // ==========================================
    const packagesDatabase = {
        'jogja': {
            slug: 'jogja',
            name: 'Jogja Tour 2 Hari',
            price: 'Rp.2.200.000',
            location: 'Yogyakarta',
            destination: 'Yogyakarta',
            category: 'Wisata Budaya',
            duration: 'Durasi 2 Hari 1 Malam',
            meal: 'Makan 4x',
            image: '{{ asset("images/jogja.jpg") }}',
            description: 'Jelajahi keindahan budaya, sejarah, dan pesona alam kota Yogyakarta. Mengunjungi Candi Prambanan, Pantai Parangtritis, Tebing Breksi, hingga suasana malam syahdu di kawasan Malioboro.',
            itinerary: [
                {
                    day: 1,
                    slots: [
                        { time: '08.00 - 12.00', activity: 'Tiba di Jogja, explore Candi Prambanan & Tebing Breksi' },
                        { time: '13.00 - 17.00', activity: 'Makan siang kuliner khas Gudeg & sunset di Pantai Parangtritis' }
                    ]
                },
                {
                    day: 2,
                    slots: [
                        { time: '08.00 - 12.00', activity: 'Keraton Ngayogyakarta & Tamansari Water Castle' },
                        { time: '13.00 - 16.00', activity: 'Belanja oleh-oleh di Malioboro & Sentra Bakpia Pathok' }
                    ]
                }
            ]
        },
        'bromo': {
            slug: 'bromo',
            name: 'Bromo Tour 1 Hari',
            price: 'Rp.499.000',
            location: 'Jawa Timur',
            destination: 'Jawa Timur',
            category: 'Wisata Alam',
            duration: 'Durasi 1 Hari',
            meal: 'Makan 1x & Snack',
            image: '{{ asset("images/bromo.jpg") }}',
            description: 'Saksikan megahnya matahari terbit (sunrise) di Penanjakan 1 Bromo dan jelajahi Pasir Berbisik, Kawah Bromo, serta Bukit Teletubbies.',
            itinerary: [
                {
                    day: 1,
                    slots: [
                        { time: '00.30 - 04.30', activity: 'Meeting point & perjalanan jeep menuju Penanjakan Bromo' },
                        { time: '05.00 - 09.30', activity: 'Golden Sunrise, Kawah Bromo, Pasir Berbisik & Savana Teletubbies' }
                    ]
                }
            ]
        },
        'lampung': {
            slug: 'lampung',
            name: 'Lampung Tour 3 Hari',
            price: 'Rp.975.000',
            location: 'Lampung',
            destination: 'Lampung',
            category: 'Wisata Pantai',
            duration: 'Durasi 3 Hari 2 Malam',
            meal: 'Makan 6x',
            image: '{{ asset("images/lampung.jpg") }}',
            description: 'Eksplorasi keindahan bahari Teluk Kiluan, Pulau Pahawang, serta snorkeling bersama ikan badut dan lumba-lumba liar.',
            itinerary: [
                {
                    day: 1,
                    slots: [
                        { time: '08.00 - 12.00', activity: 'Penyeberangan pelabuhan & eksplorasi Pulau Kelagian' },
                        { time: '13.00 - 17.00', activity: 'Snorkeling di Pahawang Besar & check-in homestay' }
                    ]
                },
                {
                    day: 2,
                    slots: [
                        { time: '06.00 - 11.00', activity: 'Dolphin tour di Teluk Kiluan melihat lumba-lumba' },
                        { time: '13.00 - 16.30', activity: 'Laguna Gayau & bersantai di pantai pasir putih' }
                    ]
                },
                {
                    day: 3,
                    slots: [
                        { time: '08.00 - 12.00', activity: 'Beli oleh-oleh kripik pisang khas Lampung & transfer kembali' }
                    ]
                }
            ]
        },
        'bali': {
            slug: 'bali',
            name: 'Bali Tour 5 Hari',
            price: 'Rp.2.750.000',
            location: 'Bali',
            destination: 'Bali',
            category: 'Wisata Budaya',
            duration: 'Durasi 5 Hari 4 Malam',
            meal: 'Makan 10x',
            image: '{{ asset("images/bali.jpg") }}',
            description: 'Liburan lengkap ke Pulau Dewata: Tanah Lot, Kintamani, Pantai Melasti, Tari Kecak Uluwatu, dan sunset dinner di Jimbaran.',
            itinerary: [
                {
                    day: 1,
                    slots: [
                        { time: '10.00 - 14.00', activity: 'Penjemputan Bandara Ngurah Rai & check-in hotel' },
                        { time: '15.30 - 19.00', activity: 'Sunset Tanah Lot & makan malam santai' }
                    ]
                },
                {
                    day: 2,
                    slots: [
                        { time: '08.30 - 13.00', activity: 'Kintamani view Gunung & Danau Batur' },
                        { time: '14.00 - 17.30', activity: 'Tegalalang Rice Terrace & Tirta Empul' }
                    ]
                }
            ]
        },
        'bandung': {
            slug: 'bandung',
            name: 'Bandung Tour 4 Hari',
            price: 'Rp.1.800.000',
            location: 'Bandung',
            destination: 'Bandung',
            category: 'Wisata Alam',
            duration: 'Durasi 4 Hari 3 Malam',
            meal: 'Makan 8x',
            image: '{{ asset("images/bandung.jpg") }}',
            description: 'Wisata sejuk Bandung & Lembang: Kawah Putih Ciwidey, Floating Market, The Great Asia Africa, dan belanja Factory Outlet.',
            itinerary: [
                {
                    day: 1,
                    slots: [
                        { time: '08.00 - 12.30', activity: 'Wisata Kawah Putih Ciwidey & Kebun Teh Rancabali' },
                        { time: '13.30 - 17.00', activity: 'Glamping Lakeside & Situ Patenggang' }
                    ]
                }
            ]
        },
        'malioboro': {
            slug: 'malioboro',
            name: 'Malioboro Tour 1 Hari',
            price: 'Rp.249.000',
            location: 'Yogyakarta',
            destination: 'Yogyakarta',
            category: 'Wisata Budaya',
            duration: 'Durasi 1 Hari',
            meal: 'Makan 1x',
            image: '{{ asset("images/malioboro.jpg") }}',
            description: 'City tour Jogja menikmati suasana khas Malioboro, Titik Nol KM, Keraton Ngayogyakarta, dan Pasar Beringharjo.',
            itinerary: [
                {
                    day: 1,
                    slots: [
                        { time: '09.00 - 12.00', activity: 'Walking tour Malioboro & Titik Nol Kilometer' },
                        { time: '13.00 - 16.00', activity: 'Keraton & belanja batik Pasar Beringharjo' }
                    ]
                }
            ]
        },
        'tangkuban-perahu': {
            slug: 'tangkuban-perahu',
            name: 'Tangkuban Perahu Tour 1 Hari',
            price: 'Rp.200.000',
            location: 'Jawa Barat',
            destination: 'Bandung',
            category: 'Wisata Alam',
            duration: 'Durasi 1 Hari',
            meal: 'Makan 1x & Snack',
            image: '{{ asset("images/tangkuban.jpg") }}',
            description: 'Menikmati keindahan Kawah Ratu Tangkuban Perahu dan udara sejuk pegunungan Lembang.',
            itinerary: [
                {
                    day: 1,
                    slots: [
                        { time: '07.00 - 11.30', activity: 'Eksplorasi Kawah Ratu & Kawah Domas' },
                        { time: '12.30 - 15.30', activity: 'Pemandian Air Panas Ciater & Kebun Teh' }
                    ]
                }
            ]
        },
        'pantai-pandawa': {
            slug: 'pantai-pandawa',
            name: 'Pantai Pandawa 1 Hari',
            price: 'Rp.175.000',
            location: 'Bali',
            destination: 'Bali',
            category: 'Wisata Pantai',
            duration: 'Durasi 1 Hari',
            meal: 'Makan 1x',
            image: '{{ asset("images/pandawa.jpg") }}',
            description: 'Menikmati keindahan pasir putih Pantai Pandawa, tebing kapur patung Pandawa Lima, dan water sport kano.',
            itinerary: [
                {
                    day: 1,
                    slots: [
                        { time: '09.00 - 12.00', activity: 'Foto tebing Patung Pandawa Lima & pantai pasir putih' },
                        { time: '13.00 - 16.00', activity: 'Bermain kano laut & bersantai di beach club' }
                    ]
                }
            ]
        }
    };

    // ==========================================
    // ITINERARY SLOTS & DAY BUILDER HELPERS
    // ==========================================
    function createTimeSlotRow(defaultTime = '', defaultActivity = '') {
        const slotRow = document.createElement('div');
        slotRow.className = 'itinerary-slot-row';
        slotRow.innerHTML = `
            <input type="text" class="form-text-input itinerary-time-input" value="${defaultTime}" placeholder="08.00 - 12.00">
            <input type="text" class="form-text-input itinerary-act-input" value="${defaultActivity}" placeholder="Tiba di Jogja, explore Candi Prambanan & Tebing Breksi">
            <button type="button" class="btn-remove-slot" onclick="removeTimeSlot(this)" title="Hapus Jam">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        `;
        return slotRow;
    }

    function addTimeSlotFromButton(btn) {
        const dayCard = btn.closest('.itinerary-day-card');
        if (!dayCard) return;
        const slotsContainer = dayCard.querySelector('.itinerary-slots-container');
        if (slotsContainer) {
            const newSlot = createTimeSlotRow('', '');
            slotsContainer.appendChild(newSlot);
            const timeInput = newSlot.querySelector('.itinerary-time-input');
            if (timeInput) timeInput.focus();
        }
    }

    function removeTimeSlot(btn) {
        const slotRow = btn.closest('.itinerary-slot-row');
        const slotsContainer = btn.closest('.itinerary-slots-container');
        if (slotRow) {
            slotRow.remove();
        }
        // If no slot remaining, automatically append one empty slot
        if (slotsContainer && slotsContainer.children.length === 0) {
            slotsContainer.appendChild(createTimeSlotRow('', ''));
        }
    }

    function reindexItineraryDays(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;
        const dayCards = container.querySelectorAll('.itinerary-day-card');
        dayCards.forEach((card, index) => {
            const badge = card.querySelector('.itinerary-day-badge');
            if (badge) {
                badge.innerHTML = `<i class="fa-regular fa-calendar-check"></i> Hari ke-${index + 1}`;
            }
        });
    }

    // ==========================================
    // 1. TAMBAH PAKET WISATA HANDLERS
    // ==========================================
    let itineraryDayCount = 0;
    let uploadedPackageImageSrc = '{{ asset("images/jogja.jpg") }}';

    function openAddPackageView() {
        const form = document.getElementById('addPackageForm');
        if (form) form.reset();
        uploadedPackageImageSrc = '{{ asset("images/jogja.jpg") }}';
        
        // Reset preview
        const previewWrap = document.getElementById('packageImagePreviewWrap');
        const placeholder = document.getElementById('uploadPlaceholderContent');
        const fileInput = document.getElementById('packageImageInput');
        if (fileInput) fileInput.value = '';
        if (previewWrap) previewWrap.style.display = 'none';
        if (placeholder) placeholder.style.display = 'block';

        // Reset itinerary
        const itineraryContainer = document.getElementById('itineraryDaysContainer');
        const itineraryAlert = document.getElementById('itineraryEmptyAlert');
        if (itineraryContainer) itineraryContainer.innerHTML = '';
        itineraryDayCount = 0;

        // Add 1 default day
        addItineraryDay();

        // Switch to Tambah Paket Pane & keep Paket Wisata sidebar link active
        activateTab('tab-tambah-paket');
        const pkgSideLink = document.querySelector('.sidebar-nav-link[data-tab="tab-paket-wisata"]');
        if (pkgSideLink) pkgSideLink.classList.add('active');

        window.scrollTo({ top: document.querySelector('.admin-glass-container').offsetTop - 20, behavior: 'smooth' });
    }

    function backToPackageList() {
        activateTab('tab-paket-wisata');
    }

    function handlePackageImageSelect(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                uploadedPackageImageSrc = e.target.result;
                const previewImg = document.getElementById('packageImagePreview');
                const previewWrap = document.getElementById('packageImagePreviewWrap');
                const placeholder = document.getElementById('uploadPlaceholderContent');
                
                if (previewImg) previewImg.src = uploadedPackageImageSrc;
                if (previewWrap) previewWrap.style.display = 'block';
                if (placeholder) placeholder.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removePackageImagePreview(e) {
        if (e) e.stopPropagation();
        const fileInput = document.getElementById('packageImageInput');
        const previewWrap = document.getElementById('packageImagePreviewWrap');
        const placeholder = document.getElementById('uploadPlaceholderContent');
        const previewImg = document.getElementById('packageImagePreview');

        if (fileInput) fileInput.value = '';
        if (previewImg) previewImg.src = '';
        if (previewWrap) previewWrap.style.display = 'none';
        if (placeholder) placeholder.style.display = 'block';
        uploadedPackageImageSrc = '{{ asset("images/jogja.jpg") }}';
    }

    function addItineraryDay(initialSlots = null) {
        const itineraryContainer = document.getElementById('itineraryDaysContainer');
        const itineraryAlert = document.getElementById('itineraryEmptyAlert');
        
        if (itineraryAlert) itineraryAlert.style.display = 'none';

        const dayCards = itineraryContainer ? itineraryContainer.querySelectorAll('.itinerary-day-card') : [];
        const currentDayIndex = dayCards.length + 1;

        const dayCard = document.createElement('div');
        dayCard.className = 'itinerary-day-card';
        dayCard.innerHTML = `
            <div class="itinerary-day-header">
                <span class="itinerary-day-badge">
                    <i class="fa-regular fa-calendar-check"></i> Hari ke-${currentDayIndex}
                </span>
                <button type="button" class="btn-remove-day" onclick="removeItineraryDay(this, 'itineraryDaysContainer')" title="Hapus Hari">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </div>
            <div class="itinerary-slots-container"></div>
            <button type="button" class="btn-add-time-slot" onclick="addTimeSlotFromButton(this)">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Jam</span>
            </button>
        `;

        const slotsContainer = dayCard.querySelector('.itinerary-slots-container');
        if (initialSlots && Array.isArray(initialSlots) && initialSlots.length > 0) {
            initialSlots.forEach(s => {
                slotsContainer.appendChild(createTimeSlotRow(s.time || '', s.activity || ''));
            });
        } else {
            slotsContainer.appendChild(createTimeSlotRow('08.00 - 12.00', ''));
        }

        if (itineraryContainer) {
            itineraryContainer.appendChild(dayCard);
            reindexItineraryDays('itineraryDaysContainer');
        }
    }

    function removeItineraryDay(btn, containerId = 'itineraryDaysContainer') {
        const dayCard = btn.closest('.itinerary-day-card');
        if (dayCard) dayCard.remove();

        const container = document.getElementById(containerId);
        const alertId = containerId === 'itineraryDaysContainer' ? 'itineraryEmptyAlert' : 'editItineraryEmptyAlert';
        const alertEl = document.getElementById(alertId);

        if (container && container.children.length === 0) {
            if (alertEl) alertEl.style.display = 'flex';
        } else {
            reindexItineraryDays(containerId);
        }
    }

    function collectItineraryFromContainer(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return [];
        const dayCards = container.querySelectorAll('.itinerary-day-card');
        const itineraryResult = [];

        dayCards.forEach((card, index) => {
            const slots = [];
            const slotRows = card.querySelectorAll('.itinerary-slot-row');
            slotRows.forEach(row => {
                const time = (row.querySelector('.itinerary-time-input')?.value || '').trim();
                const act = (row.querySelector('.itinerary-act-input')?.value || '').trim();
                if (time || act) {
                    slots.push({ time: time, activity: act });
                }
            });

            if (slots.length > 0) {
                itineraryResult.push({
                    day: index + 1,
                    slots: slots
                });
            }
        });

        return itineraryResult;
    }

    function handleSavePackageForm() {
        const nameInput = document.getElementById('inputFormPkgName');
        const priceInput = document.getElementById('inputFormPkgPrice');
        const destInput = document.getElementById('inputFormPkgDest');
        const categoryInput = document.getElementById('inputFormPkgCategory');
        const durationInput = document.getElementById('inputFormPkgDuration');
        const mealInput = document.getElementById('inputFormPkgMeal');
        const descInput = document.getElementById('inputFormPkgDesc');

        const name = nameInput ? nameInput.value.trim() : '';
        let price = priceInput ? priceInput.value.trim() : '';
        const dest = destInput ? destInput.value : '';
        const category = categoryInput ? categoryInput.value : 'Wisata Alam';
        const duration = durationInput ? durationInput.value.trim() : 'Durasi 1 Hari';
        const meal = mealInput ? mealInput.value.trim() : 'Makan 1x';
        const desc = descInput ? descInput.value.trim() : '';

        if (!name || !price || !dest) {
            showToast('Mohon lengkapi nama paket, harga, dan destinasi!', 'info');
            return;
        }

        if (!price.toLowerCase().startsWith('rp')) {
            price = 'Rp.' + price;
        }

        // Generate slug
        const slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '') || 'paket-' + Date.now();

        // Collect structured itinerary
        const itineraryList = collectItineraryFromContainer('itineraryDaysContainer');

        // Save to Database Object
        packagesDatabase[slug] = {
            slug: slug,
            name: name,
            price: price,
            location: dest,
            destination: dest,
            category: category,
            duration: duration,
            meal: meal,
            image: uploadedPackageImageSrc,
            description: desc,
            itinerary: itineraryList
        };

        // Add Card to Full Packages List
        const listContainer = document.getElementById('fullPackagesList');
        if (listContainer) {
            const newCard = document.createElement('div');
            newCard.className = 'package-item-card full-package-card';
            newCard.setAttribute('data-package-slug', slug);
            newCard.setAttribute('data-title', name.toLowerCase());
            newCard.setAttribute('data-loc', dest.toLowerCase());
            newCard.innerHTML = `
                <div class="package-item-left">
                    <img src="${uploadedPackageImageSrc}" alt="${name}" class="package-item-thumb" loading="lazy">
                    <div class="package-item-meta">
                        <h4 class="package-item-name">${name}</h4>
                        <span class="package-item-location">${dest}</span>
                    </div>
                </div>
                <div class="package-item-right">
                    <div class="package-item-pricing">
                        <span class="package-item-price">${price}</span>
                        <span class="package-item-duration">
                            <i class="fa-regular fa-clock"></i> ${duration}
                        </span>
                    </div>
                    <div class="package-item-actions">
                        <button type="button" class="btn-action-icon edit" title="Edit Paket" onclick="openEditPackageView('${slug}', 'tab-paket-wisata')">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button type="button" class="btn-action-icon delete" title="Hapus Paket" onclick="deletePackageConfirm('${slug}', '${name.replace(/'/g, "\\'")}')">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            `;
            listContainer.insertBefore(newCard, listContainer.firstChild);

            // Update badge count
            const badge = document.getElementById('packageBadgeCount');
            if (badge) {
                const current = parseInt(badge.textContent.trim()) || 8;
                badge.textContent = current + 1;
            }
        }

        showToast(`Paket wisata "${name}" berhasil ditambahkan!`, 'success');
        activateTab('tab-paket-wisata');
    }

    // ==========================================
    // 2. EDIT PAKET WISATA HANDLERS (MATCHING SCREENSHOT)
    // ==========================================
    let editUploadedPackageImageSrc = '';

    function openEditPackageView(slugOrName, fromTab = 'tab-paket-wisata') {
        let pkg = packagesDatabase[slugOrName];

        if (!pkg) {
            // Find by name if not matching slug
            for (const key in packagesDatabase) {
                if (packagesDatabase[key].name.toLowerCase() === slugOrName.toLowerCase() || key.includes(slugOrName.toLowerCase())) {
                    pkg = packagesDatabase[key];
                    slugOrName = key;
                    break;
                }
            }
        }

        if (!pkg) {
            pkg = {
                slug: slugOrName,
                name: slugOrName,
                price: 'Rp.2.000.000',
                location: 'Yogyakarta',
                destination: 'Yogyakarta',
                category: 'Wisata Budaya',
                duration: 'Durasi 2 Hari 1 Malam',
                meal: 'Makan 4x',
                image: '{{ asset("images/jogja.jpg") }}',
                description: 'Deskripsi paket wisata.',
                itinerary: [
                    { day: 1, slots: [{ time: '08.00 - 12.00', activity: 'Aktivitas tour' }] }
                ]
            };
        }

        document.getElementById('editPkgSlug').value = slugOrName;
        document.getElementById('editFromTab').value = fromTab;
        document.getElementById('editPageMainTitle').textContent = `Edit Paket Wisata - ${pkg.name}`;

        // Populate fields
        document.getElementById('editFormPkgName').value = pkg.name;
        document.getElementById('editFormPkgPrice').value = pkg.price;
        
        const destSelect = document.getElementById('editFormPkgDest');
        if (destSelect) {
            destSelect.value = pkg.destination || pkg.location || 'Yogyakarta';
        }

        const catSelect = document.getElementById('editFormPkgCategory');
        if (catSelect) {
            catSelect.value = pkg.category || 'Wisata Budaya';
        }

        document.getElementById('editFormPkgDuration').value = pkg.duration || '';
        document.getElementById('editFormPkgMeal').value = pkg.meal || '';
        document.getElementById('editFormPkgDesc').value = pkg.description || '';

        // Image
        editUploadedPackageImageSrc = pkg.image || '{{ asset("images/jogja.jpg") }}';
        const editPreview = document.getElementById('editPackageImagePreview');
        const editPreviewWrap = document.getElementById('editPackageImagePreviewWrap');
        const editPlaceholder = document.getElementById('editUploadPlaceholderContent');
        if (editPreview) editPreview.src = editUploadedPackageImageSrc;
        if (editPreviewWrap) editPreviewWrap.style.display = 'block';
        if (editPlaceholder) editPlaceholder.style.display = 'none';

        // Itinerary Days
        const editContainer = document.getElementById('editItineraryDaysContainer');
        const editAlert = document.getElementById('editItineraryEmptyAlert');
        if (editContainer) editContainer.innerHTML = '';

        if (pkg.itinerary && pkg.itinerary.length > 0) {
            if (editAlert) editAlert.style.display = 'none';
            pkg.itinerary.forEach(item => {
                if (item.slots && Array.isArray(item.slots)) {
                    addEditItineraryDay(item.slots);
                } else if (item.time || item.activity) {
                    addEditItineraryDay([{ time: item.time || '', activity: item.activity || '' }]);
                }
            });
        } else {
            addEditItineraryDay([{ time: '08.00 - 12.00', activity: 'Aktivitas wisata & eksplorasi destinasi' }]);
        }

        // Switch pane to Edit Paket & keep sidebar active
        activateTab('tab-edit-paket');
        const pkgSideLink = document.querySelector('.sidebar-nav-link[data-tab="tab-paket-wisata"]');
        if (pkgSideLink) pkgSideLink.classList.add('active');

        window.scrollTo({ top: document.querySelector('.admin-glass-container').offsetTop - 20, behavior: 'smooth' });
    }

    function backFromEditPackage() {
        const fromTab = document.getElementById('editFromTab').value || 'tab-paket-wisata';
        activateTab(fromTab);
    }

    function handleEditPackageImageSelect(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                editUploadedPackageImageSrc = e.target.result;
                const previewImg = document.getElementById('editPackageImagePreview');
                const previewWrap = document.getElementById('editPackageImagePreviewWrap');
                const placeholder = document.getElementById('editUploadPlaceholderContent');
                
                if (previewImg) previewImg.src = editUploadedPackageImageSrc;
                if (previewWrap) previewWrap.style.display = 'block';
                if (placeholder) placeholder.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeEditPackageImagePreview(e) {
        if (e) e.stopPropagation();
        const fileInput = document.getElementById('editPackageImageInput');
        const previewWrap = document.getElementById('editPackageImagePreviewWrap');
        const placeholder = document.getElementById('editUploadPlaceholderContent');
        const previewImg = document.getElementById('editPackageImagePreview');

        if (fileInput) fileInput.value = '';
        if (previewImg) previewImg.src = '';
        if (previewWrap) previewWrap.style.display = 'none';
        if (placeholder) placeholder.style.display = 'block';
        editUploadedPackageImageSrc = '{{ asset("images/jogja.jpg") }}';
    }

    function addEditItineraryDay(initialSlots = null) {
        const editContainer = document.getElementById('editItineraryDaysContainer');
        const editAlert = document.getElementById('editItineraryEmptyAlert');
        
        if (editAlert) editAlert.style.display = 'none';

        const dayCards = editContainer ? editContainer.querySelectorAll('.itinerary-day-card') : [];
        const currentDayIndex = dayCards.length + 1;

        const dayCard = document.createElement('div');
        dayCard.className = 'itinerary-day-card';
        dayCard.innerHTML = `
            <div class="itinerary-day-header">
                <span class="itinerary-day-badge">
                    <i class="fa-regular fa-calendar-check"></i> Hari ke-${currentDayIndex}
                </span>
                <button type="button" class="btn-remove-day" onclick="removeItineraryDay(this, 'editItineraryDaysContainer')" title="Hapus Hari">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </div>
            <div class="itinerary-slots-container"></div>
            <button type="button" class="btn-add-time-slot" onclick="addTimeSlotFromButton(this)">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Jam</span>
            </button>
        `;

        const slotsContainer = dayCard.querySelector('.itinerary-slots-container');
        if (initialSlots && Array.isArray(initialSlots) && initialSlots.length > 0) {
            initialSlots.forEach(s => {
                slotsContainer.appendChild(createTimeSlotRow(s.time || '', s.activity || ''));
            });
        } else {
            slotsContainer.appendChild(createTimeSlotRow('08.00 - 12.00', ''));
        }

        if (editContainer) {
            editContainer.appendChild(dayCard);
            reindexItineraryDays('editItineraryDaysContainer');
        }
    }

    function handleSaveEditPackageForm() {
        const slug = document.getElementById('editPkgSlug').value;
        const fromTab = document.getElementById('editFromTab').value || 'tab-paket-wisata';

        const name = document.getElementById('editFormPkgName').value.trim();
        let price = document.getElementById('editFormPkgPrice').value.trim();
        const dest = document.getElementById('editFormPkgDest').value;
        const category = document.getElementById('editFormPkgCategory').value;
        const duration = document.getElementById('editFormPkgDuration').value.trim();
        const meal = document.getElementById('editFormPkgMeal').value.trim();
        const desc = document.getElementById('editFormPkgDesc').value.trim();

        if (!name || !price || !dest) {
            showToast('Mohon lengkapi nama paket, harga, dan destinasi!', 'info');
            return;
        }

        if (!price.toLowerCase().startsWith('rp')) {
            price = 'Rp.' + price;
        }

        // Collect structured edit itinerary
        const itineraryList = collectItineraryFromContainer('editItineraryDaysContainer');

        // Update database object
        packagesDatabase[slug] = {
            slug: slug,
            name: name,
            price: price,
            location: dest,
            destination: dest,
            category: category,
            duration: duration,
            meal: meal,
            image: editUploadedPackageImageSrc,
            description: desc,
            itinerary: itineraryList
        };

        // Update DOM cards in both lists
        const matchingCards = document.querySelectorAll(`[data-package-slug="${slug}"]`);
        matchingCards.forEach(card => {
            const nameEl = card.querySelector('.package-item-name');
            const locEl = card.querySelector('.package-item-location');
            const priceEl = card.querySelector('.package-item-price');
            const durEl = card.querySelector('.package-item-duration');
            const imgEl = card.querySelector('.package-item-thumb');

            if (nameEl) nameEl.textContent = name;
            if (locEl) locEl.textContent = dest;
            if (priceEl) priceEl.textContent = price;
            if (durEl) durEl.innerHTML = `<i class="fa-regular fa-clock"></i> ${duration}`;
            if (imgEl && editUploadedPackageImageSrc) imgEl.src = editUploadedPackageImageSrc;

            card.setAttribute('data-title', name.toLowerCase());
            card.setAttribute('data-loc', dest.toLowerCase());
        });

        showToast(`Paket wisata "${name}" berhasil diperbarui!`, 'success');
        activateTab(fromTab);
    }

    // ==========================================
    // 3. HAPUS PAKET WISATA HANDLER
    // ==========================================
    function deletePackageConfirm(slugOrName, displayName) {
        displayName = displayName || slugOrName;
        if (confirm(`Apakah Anda yakin ingin menghapus paket "${displayName}"?`)) {
            if (packagesDatabase[slugOrName]) {
                delete packagesDatabase[slugOrName];
            }

            // Remove card from lists
            const matchingCards = document.querySelectorAll(`[data-package-slug="${slugOrName}"]`);
            matchingCards.forEach(card => card.remove());

            // Update badge count
            const badge = document.getElementById('packageBadgeCount');
            if (badge) {
                const remaining = document.querySelectorAll('#fullPackagesList .package-item-card').length;
                badge.textContent = remaining;
            }

            showToast(`Paket wisata "${displayName}" berhasil dihapus.`, 'info');
        }
    }

    // ==========================================
    // 4. DETAIL PEMESANAN ORDER HANDLERS
    // ==========================================
    function showOrderDetail(orderKey) {
        currentViewingOrderKey = orderKey;
        const data = orderDatabase[orderKey] || orderDatabase['alexa'];

        document.getElementById('dtOrderDate').textContent = data.orderDate;
        renderDetailOrderStatus(data.status);

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

        document.querySelectorAll('.tab-content-pane').forEach(p => p.classList.remove('active'));
        document.getElementById('tab-detail-pemesanan').classList.add('active');

        document.querySelectorAll('.sidebar-nav-link').forEach(btn => btn.classList.remove('active'));
        const riwayatBtn = document.querySelector('.sidebar-nav-link[data-tab="tab-riwayat-pemesanan"]');
        if (riwayatBtn) riwayatBtn.classList.add('active');

        window.scrollTo({ top: document.querySelector('.admin-glass-container').offsetTop - 20, behavior: 'smooth' });
    }

    function renderDetailOrderStatus(status) {
        const badge = document.getElementById('dtStatusBadge');
        const actionBtn = document.getElementById('dtActionBtn');
        const actionBtnText = document.getElementById('dtActionBtnText');
        const actionBtnIcon = document.getElementById('dtActionBtnIcon');
        const banner = document.getElementById('dtStatusBanner');
        const bannerTitle = document.getElementById('dtBannerTitle');
        const bannerSub = document.getElementById('dtBannerSubtitle');
        const bannerIcon = document.getElementById('dtBannerIcon');

        if (status === 'Dipending') {
            badge.className = 'dt-status-badge pending';
            badge.textContent = 'Dipending';
            if (actionBtn) {
                actionBtn.className = 'btn-detail-approve';
                if (actionBtnText) actionBtnText.textContent = 'Dikonfirmasi';
                if (actionBtnIcon) actionBtnIcon.className = 'fa-solid fa-clock';
            }
            banner.className = 'detail-status-banner pending';
            bannerTitle.textContent = 'Menunggu Konfirmasi';
            bannerSub.textContent = 'Menunggu pembayaran diverifikasi & disetujui';
            if (bannerIcon) bannerIcon.className = 'fa-regular fa-clock';
        } else if (status === 'Disetujui') {
            badge.className = 'dt-status-badge completed';
            badge.textContent = 'Disetujui';
            if (actionBtn) {
                actionBtn.className = 'btn-detail-approve completed approved';
                if (actionBtnText) actionBtnText.textContent = 'Disetujui';
                if (actionBtnIcon) actionBtnIcon.className = 'fa-solid fa-check';
            }
            banner.className = 'detail-status-banner completed';
            bannerTitle.textContent = 'Disetujui';
            bannerSub.textContent = 'Pesanan telah disetujui dan diverifikasi';
            if (bannerIcon) bannerIcon.className = 'fa-regular fa-circle-check';
        } else if (status === 'Selesai') {
            badge.className = 'dt-status-badge completed';
            badge.textContent = 'Selesai';
            if (actionBtn) {
                actionBtn.className = 'btn-detail-approve completed';
                if (actionBtnText) actionBtnText.textContent = 'Perjalanan Selesai';
                if (actionBtnIcon) actionBtnIcon.className = 'fa-solid fa-check-double';
            }
            banner.className = 'detail-status-banner completed';
            bannerTitle.textContent = 'Perjalanan Selesai';
            bannerSub.textContent = 'Perjalanan telah selesai dan dinikmati pelanggan';
            if (bannerIcon) bannerIcon.className = 'fa-regular fa-circle-check';
        }
    }

    function toggleApproveOrder() {
        const orderData = orderDatabase[currentViewingOrderKey];
        if (!orderData) return;

        if (orderData.status === 'Dipending') {
            orderData.status = 'Disetujui';
            renderDetailOrderStatus('Disetujui');
            const badges = document.querySelectorAll(`[data-order-badge="${currentViewingOrderKey}"]`);
            badges.forEach(b => {
                b.className = 'badge-status completed';
                b.textContent = 'Disetujui';
            });
            updateSummaryCounts();
            showToast(`Pesanan untuk ${orderData.custName} berhasil Disetujui!`, 'success');
        } else if (orderData.status === 'Disetujui') {
            orderData.status = 'Dipending';
            renderDetailOrderStatus('Dipending');
            const badges = document.querySelectorAll(`[data-order-badge="${currentViewingOrderKey}"]`);
            badges.forEach(b => {
                b.className = 'badge-status pending';
                b.textContent = 'Dipending';
            });
            updateSummaryCounts();
            showToast(`Status pesanan ${orderData.custName} diubah kembali menjadi Dipending`, 'info');
        } else if (orderData.status === 'Selesai') {
            showToast(`Pesanan ${orderData.custName} telah berstatus Perjalanan Selesai.`, 'info');
        }
    }

    function updateSummaryCounts() {
        let total = 0;
        let completed = 0;
        let pending = 0;

        for (const key in orderDatabase) {
            total++;
            const st = orderDatabase[key].status;
            if (st === 'Selesai' || st === 'Disetujui') {
                completed++;
            } else if (st === 'Dipending') {
                pending++;
            }
        }

        const totalElem = document.getElementById('summaryTotalCount');
        const compElem = document.getElementById('summaryCompletedCount');
        const pendElem = document.getElementById('summaryPendingCount');

        if (totalElem) totalElem.textContent = total;
        if (compElem) compElem.textContent = completed;
        if (pendElem) pendElem.textContent = pending;
    }

    function showToast(message, type = 'success') {
        const container = document.getElementById('adminToastContainer');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `admin-toast toast-${type}`;
        
        const iconHtml = (type === 'success') 
            ? '<i class="fa-solid fa-circle-check admin-toast-icon"></i>'
            : '<i class="fa-solid fa-circle-info admin-toast-icon"></i>';
            
        toast.innerHTML = `${iconHtml} <span>${message}</span>`;
        container.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                if (toast.parentNode) toast.parentNode.removeChild(toast);
            }, 300);
        }, 3200);
    }

    function backToOrdersList() {
        activateTab('tab-riwayat-pemesanan');
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
            Apakah Anda yakin ingin keluar dari akun Go Travel? Anda harus masuk kembali untuk mengakses halaman ini.
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
