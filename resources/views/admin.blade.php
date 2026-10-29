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
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
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

    /* ==========================================================
           KELOLA PENGGUNA (USER MANAGEMENT) STYLES
           ========================================================== */
    .btn-add-admin {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #0284c7, #0369a1);
        color: #ffffff;
        font-size: 13px;
        font-weight: 700;
        padding: 9px 18px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-add-admin:hover {
        background: linear-gradient(135deg, #0369a1, #075985);
        box-shadow: 0 6px 18px rgba(2, 132, 199, 0.45);
        transform: translateY(-1px);
    }

    .btn-add-admin:active {
        transform: translateY(0);
    }

    .user-controls-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
    }

    .user-stats-pills {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .user-filter-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        color: #475569;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .user-filter-pill:hover {
        border-color: #0284c7;
        color: #0284c7;
    }

    .user-filter-pill.active {
        background: #0284c7;
        border-color: #0284c7;
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(2, 132, 199, 0.3);
    }

    .user-filter-pill .pill-count {
        display: inline-block;
        margin-left: 6px;
        padding: 1px 7px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 700;
        background: rgba(0, 0, 0, 0.08);
    }

    .user-filter-pill.active .pill-count {
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
    }

    .user-search-wrapper {
        position: relative;
        min-width: 250px;
        flex: 1;
        max-width: 360px;
    }

    .user-search-wrapper .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 13px;
    }

    .user-search-input {
        width: 100%;
        padding: 8px 12px 8px 34px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        font-size: 12.5px;
        background: #ffffff;
        color: #0f172a;
        outline: none;
        transition: all 0.2s ease;
    }

    .user-search-input:focus {
        border-color: #0284c7;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
    }

    .user-id-badge {
        display: inline-block;
        padding: 2px 8px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 6px;
        font-weight: 700;
        font-size: 11px;
        letter-spacing: 0.3px;
    }

    .user-avatar-initial {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 12.5px;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
    }

    .badge-self-user {
        display: inline-block;
        padding: 1px 7px;
        background: #dcfce7;
        color: #166534;
        border-radius: 9999px;
        font-size: 9.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid #bbf7d0;
    }

    .badge-user-role {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    .badge-user-role.admin {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .badge-user-role.user {
        background: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }

    .user-action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .btn-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        text-decoration: none;
        background: transparent;
    }

    .btn-action-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    .btn-role-to-user {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .btn-role-to-user:hover:not(:disabled) {
        background: #fee2e2;
        border-color: #f87171;
        transform: translateY(-1px);
    }

    .btn-role-to-admin {
        background: #eff6ff;
        color: #2563eb;
        border-color: #bfdbfe;
    }

    .btn-role-to-admin:hover:not(:disabled) {
        background: #dbeafe;
        border-color: #93c5fd;
        transform: translateY(-1px);
    }

    .btn-role-disabled {
        background: #f1f5f9;
        color: #94a3b8;
        border-color: #e2e8f0;
    }

    .btn-edit-user {
        background: #f8fafc;
        color: #0f172a;
        border-color: #cbd5e1;
    }

    .btn-edit-user:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
        color: #0284c7;
        transform: translateY(-1px);
    }

    .btn-delete-user {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .btn-delete-user:hover:not(:disabled) {
        background: #dc2626;
        color: #ffffff;
        border-color: #dc2626;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
    }

    .btn-delete-disabled {
        background: #f1f5f9;
        color: #94a3b8;
        border-color: #e2e8f0;
    }

    .user-form-modal-box {
        max-width: 480px;
    }

    .form-group-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-group-item .form-label {
        font-size: 12.5px;
        font-weight: 600;
        color: #334155;
    }

    .btn-modal-submit-admin {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #0284c7, #0369a1);
        color: #ffffff;
        padding: 9px 18px;
        border-radius: 10px;
        border: none;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        transition: all 0.2s ease;
    }

    .btn-modal-submit-admin:hover {
        background: linear-gradient(135deg, #0369a1, #075985);
        box-shadow: 0 6px 16px rgba(2, 132, 199, 0.4);
        transform: translateY(-1px);
    }
</style>
@endsection

@php
$userRole = session('user.role', 'admin');
// If not explicitly 'user', default to 'admin' (or if session user has admin credentials)
$isAdmin = ($userRole === 'admin');

if (!isset($orders)) {
try {
$allOrders = \App\Models\Order::latest()->get();
$orders = $allOrders->unique(function ($ord) {
    return $ord->nama_pemesan . '|' . $ord->nama_paket . '|' . $ord->tanggal_keberangkatan . '|' . $ord->jumlah_peserta . '|' . $ord->total_pembayaran;
})->values();
$totalOrders = $orders->count();
$completedOrders = $orders->filter(function($o) {
return in_array(strtolower($o->status), ['selesai', 'disetujui']);
})->count();
$pendingOrders = $orders->filter(function($o) {
return in_array(strtolower($o->status), ['dipending', 'pending']);
})->count();
} catch (\Throwable $e) {
$orders = collect();
$totalOrders = 0;
$completedOrders = 0;
$pendingOrders = 0;
}
}

if (!isset($users)) {
try {
$users = \App\Models\User::latest()->get();
} catch (\Throwable $e) {
$users = collect();
}
}
@endphp

@section('content')
<div class="admin-page-wrapper">

    <!-- Top Action / Back Button & Mode Switcher -->
    <div class="admin-top-nav-row" style="justify-content: space-between;">
        <a href="{{ url('/') }}" class="admin-back-btn" title="Kembali ke Beranda" aria-label="Kembali ke Beranda">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 12.5px; color: #ffffff; font-weight: 600; text-shadow: 0 1px 3px rgba(0,0,0,0.5);">Tampilan: Admin Panel (Full Control)</span>
            <a href="{{ url('/profile') }}" style="padding: 6px 14px; background: rgba(255,255,255,0.9); color: #0284c7; border-radius: 9999px; font-size: 12px; font-weight: 700; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#ffffff'" onmouseout="this.style.background='rgba(255,255,255,0.9)'">
                <i class="fa-solid fa-user"></i> Lihat Tampilan User
            </a>
        </div>
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
                    @if($isAdmin)
                    <span style="display: inline-block; padding: 2px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; background: #fee2e2; color: #dc2626;">
                        Admin
                    </span>
                    @else
                    <span style="display: inline-block; padding: 2px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; background: #e0f2fe; color: #0284c7;">
                        User
                    </span>
                    @endif
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
                        <button type="button" class="sidebar-nav-link" data-tab="tab-kelola-pengguna">
                            <i class="fa-solid fa-users-gear"></i>
                            <span>Kelola Pengguna</span>
                        </button>
                    </li>
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link" data-tab="tab-pesan-masuk">
                            <i class="fa-solid fa-envelope"></i>
                            <span>Pesan Masuk</span>
                            @if(isset($contacts) && $contacts->count() > 0)
                            <span style="margin-left: auto; background: #0284c7; color: white; border-radius: 9999px; padding: 2px 7px; font-size: 11px; font-weight: 700;">{{ $contacts->count() }}</span>
                            @endif
                        </button>
                    </li>
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link" data-tab="tab-wishlist-saya">
                            <i class="fa-solid fa-heart"></i>
                            <span>Wishlist Saya</span>
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
                    {{-- MENU KHUSUS USER BIASA: RIWAYAT, WISHLIST DAN LOGOUT --}}
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link active" data-tab="tab-riwayat-pemesanan">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <span>Riwayat Pemesanan</span>
                        </button>
                    </li>
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link" data-tab="tab-wishlist-saya">
                            <i class="fa-solid fa-heart"></i>
                            <span>Wishlist Saya</span>
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

            {{-- Global Flash Messages --}}
            @if(session('success'))
            <div class="pkg-alert-success" style="background:#f0fdf4;border:1px solid #bbf7d0;border-left:5px solid #16a34a;color:#15803d;padding:14px 18px;border-radius:14px;margin-bottom:20px;font-weight:600;font-size:14px;display:flex;align-items:center;gap:12px;">
                <i class="fa-solid fa-circle-check"></i> <span>{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="pkg-alert-error" style="background:#fef2f2;border:1px solid #fecaca;border-left:5px solid #ef4444;color:#b91c1c;padding:14px 18px;border-radius:14px;margin-bottom:20px;font-weight:600;font-size:14px;display:flex;align-items:center;gap:12px;">
                <i class="fa-solid fa-triangle-exclamation"></i> <span>{{ session('error') }}</span>
            </div>
            @endif

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
                            <span class="summary-number" id="summaryTotalCount">{{ $totalOrders }}</span>
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
                            <span class="summary-number" id="summaryCompletedCount">{{ $completedOrders }}</span>
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
                            <span class="summary-number" id="summaryPendingCount">{{ $pendingOrders }}</span>
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
                        @forelse($packages->take(5) as $pkg)
                        <div class="package-item-card" data-package-id="{{ $pkg->id }}" data-package-slug="{{ $pkg->slug }}" data-title="{{ strtolower($pkg->nama_paket) }}" data-loc="{{ strtolower($pkg->destinasi) }}">
                            <div class="package-item-left">
                                <img src="{{ $pkg->gambar_url }}" alt="{{ $pkg->nama_paket }}" class="package-item-thumb" loading="lazy">
                                <div class="package-item-meta">
                                    <h4 class="package-item-name">{{ $pkg->nama_paket }}</h4>
                                    <span class="package-item-location">{{ $pkg->destinasi }}</span>
                                </div>
                            </div>
                            <div class="package-item-right">
                                <div class="package-item-pricing">
                                    <span class="package-item-price">{{ $pkg->formatted_harga }}</span>
                                    <span class="package-item-duration">
                                        <i class="fa-regular fa-clock"></i> {{ $pkg->durasi }}
                                    </span>
                                </div>
                                <div class="package-item-actions">
                                    <button type="button" class="btn-action-icon edit" title="Edit Paket" onclick="openEditPackageView('{{ $pkg->slug }}', 'tab-dashboard')">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn-action-icon delete" title="Hapus Paket" onclick="deletePackageConfirm('{{ $pkg->slug }}', '{{ addslashes($pkg->nama_paket) }}', '{{ $pkg->id }}')">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div style="padding: 24px; text-align: center; color: #64748b; width: 100%;">
                            Belum ada paket wisata di database.
                        </div>
                        @endforelse
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
                                @forelse($orders->take(5) as $ord)
                                @php
                                $statusLower = strtolower($ord->status);
                                $statusBadgeClass = ($statusLower === 'selesai' || $statusLower === 'disetujui') ? 'completed' : 'pending';
                                $statusLabel = ($statusLower === 'selesai') ? 'Selesai' : (($statusLower === 'disetujui') ? 'Disetujui' : 'Dipending');
                                $createdDateStr = \Carbon\Carbon::parse($ord->created_at)->translatedFormat('d F Y');
                                @endphp
                                <tr>
                                    <td>
                                        <div class="table-text-main">{{ $ord->nama_pemesan }}</div>
                                        <div class="table-text-sub">{{ $ord->nomor_hp }}</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">{{ $ord->nama_paket }}</div>
                                        <div class="table-text-sub">{{ $ord->kota_keberangkatan }}</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">{{ $createdDateStr }}</div>
                                        <div class="table-text-sub">{{ $ord->tanggal_keberangkatan }}</div>
                                    </td>
                                    <td>{{ $ord->jumlah_peserta }} Orang</td>
                                    <td><strong>Rp. {{ number_format($ord->total_pembayaran, 0, ',', '.') }}</strong></td>
                                    <td><span class="badge-status {{ $statusBadgeClass }}" data-order-badge="{{ $ord->id }}">{{ $statusLabel }}</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('{{ $ord->id }}')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 30px; color: #64748b;">
                                        <i class="fa-solid fa-folder-open" style="font-size: 24px; margin-bottom: 8px; display: block; color: #94a3b8;"></i>
                                        Belum ada pesanan masuk.
                                    </td>
                                </tr>
                                @endforelse
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
                            <span id="packageBadgeCount">{{ $packages->count() }}</span>
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

                    <!-- Full Horizontal Package List (Dynamic from Database) -->
                    <div class="packages-horizontal-list" id="fullPackagesList">
                        @forelse($packages as $pkg)
                        <div class="package-item-card full-package-card" data-package-id="{{ $pkg->id }}" data-package-slug="{{ $pkg->slug }}" data-title="{{ strtolower($pkg->nama_paket) }}" data-loc="{{ strtolower($pkg->destinasi) }}">
                            <div class="package-item-left">
                                <img src="{{ $pkg->gambar_url }}" alt="{{ $pkg->nama_paket }}" class="package-item-thumb" loading="lazy">
                                <div class="package-item-meta">
                                    <h4 class="package-item-name">{{ $pkg->nama_paket }}</h4>
                                    <span class="package-item-location">{{ $pkg->destinasi }}</span>
                                </div>
                            </div>
                            <div class="package-item-right">
                                <div class="package-item-pricing">
                                    <span class="package-item-price">{{ $pkg->formatted_harga }}</span>
                                    <span class="package-item-duration">
                                        <i class="fa-regular fa-clock"></i> {{ $pkg->durasi }}
                                    </span>
                                </div>
                                <div class="package-item-actions">
                                    <button type="button" class="btn-action-icon edit" title="Edit Paket" onclick="openEditPackageView('{{ $pkg->slug }}', 'tab-paket-wisata')">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn-action-icon delete" title="Hapus Paket" onclick="deletePackageConfirm('{{ $pkg->slug }}', '{{ addslashes($pkg->nama_paket) }}', '{{ $pkg->id }}')">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div style="padding: 30px; text-align: center; color: #64748b; width: 100%;">
                            Belum ada paket wisata di database.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- ---------------------------------------------------- -->
            <!-- TAB: TAMBAH PAKET WISATA (MATCHING SCREENSHOT)       -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-tambah-paket">

                {{-- Flash messages --}}
                @if(session('success'))
                <div class="pkg-alert-success" style="background:#f0fdf4;border:1px solid #bbf7d0;border-left:5px solid #16a34a;color:#15803d;padding:14px 18px;border-radius:14px;margin-bottom:20px;font-weight:600;font-size:14px;display:flex;align-items:center;gap:12px;">
                    <i class="fa-solid fa-circle-check"></i> <span>{{ session('success') }}</span>
                </div>
                @endif
                @if(session('error'))
                <div class="pkg-alert-error" style="background:#fef2f2;border:1px solid #fecaca;border-left:5px solid #ef4444;color:#b91c1c;padding:14px 18px;border-radius:14px;margin-bottom:20px;font-weight:600;font-size:14px;display:flex;align-items:center;gap:12px;">
                    <i class="fa-solid fa-triangle-exclamation"></i> <span>{{ session('error') }}</span>
                </div>
                @endif
                @if(isset($errors) && $errors->any())
                <div class="pkg-alert-error" style="background:#fef2f2;border:1px solid #fecaca;border-left:5px solid #ef4444;color:#b91c1c;padding:14px 18px;border-radius:14px;margin-bottom:20px;font-size:14px;">
                    <div style="font-weight: 700; display:flex; align-items:center; gap:8px; margin-bottom: 6px;">
                        <i class="fa-solid fa-circle-exclamation"></i> <span>Terdapat kesalahan validasi input:</span>
                    </div>
                    <ul style="margin: 0; padding-left: 24px; font-weight: 500;">
                        @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form
                    id="addPackageForm"
                    action="{{ route('admin.packages.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    onsubmit="return handleSavePackageForm(event)"
                    class="package-form-container">
                    @csrf
                    {{-- Hidden: itinerary dalam format JSON --}}
                    <input type="hidden" id="itineraryJsonInput" name="itinerary">


                    <!-- 1. Tambah Gambar -->
                    <div class="package-form-card">
                        <h3 class="form-section-heading">1. Tambah Gambar</h3>
                        <div class="upload-dropzone" id="packageDropzone" onclick="document.getElementById('packageImageInput').click();">
                            <input type="file" id="packageImageInput" name="gambar" accept="image/png, image/jpeg, image/webp" style="display: none;" onchange="handlePackageImageSelect(this)">


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
                                <input type="text" id="inputFormPkgName" name="nama_paket" class="form-text-input" placeholder="Tulis nama paket wisata" required>
                            </div>

                            <!-- Harga Mulai (Rp) -->
                            <div class="form-field-group">
                                <label class="form-field-label">Harga Mulai (Rp)</label>
                                <input type="text" id="inputFormPkgPrice" name="harga" class="form-text-input" placeholder="Tulis harga" required>
                            </div>


                            <!-- Destinasi -->
                            <div class="form-field-group">
                                <label class="form-field-label">Destinasi</label>
                                <div class="custom-select-wrapper">
                                    <select id="inputFormPkgDest" name="destinasi" class="form-select-control" required>
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
                                    <select id="inputFormPkgCategory" name="kategori" class="form-select-control" required>
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
                                <input type="text" id="inputFormPkgDuration" name="durasi" class="form-text-input" placeholder="Tulis durasi perjalanan" required>
                            </div>

                            <!-- Makan -->
                            <div class="form-field-group">
                                <label class="form-field-label">Makan</label>
                                <input type="text" id="inputFormPkgMeal" name="makan" class="form-text-input" placeholder="Tulis makan yang didapatkan">
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-field-group full-width">
                                <label class="form-field-label">Deskripsi</label>
                                <textarea id="inputFormPkgDesc" name="deskripsi" class="form-textarea-control" placeholder="Tulis deskripsi paket wisata" rows="3"></textarea>
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

                <form id="editPackageForm" action="" method="POST" enctype="multipart/form-data" onsubmit="return handleSaveEditPackageForm(event);" class="package-form-container">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="editPkgId" name="id" value="">
                    <input type="hidden" id="editPkgSlug" name="slug" value="jogja">
                    <input type="hidden" id="editFromTab" value="tab-paket-wisata">
                    <input type="hidden" id="editItineraryJsonInput" name="itinerary" value="">

                    <!-- 1. Ubah Gambar -->
                    <div class="package-form-card">
                        <h3 class="form-section-heading">1. Ubah Gambar</h3>
                        <div class="upload-dropzone" id="editPackageDropzone" onclick="document.getElementById('editPackageImageInput').click();">
                            <input type="file" id="editPackageImageInput" name="gambar" accept="image/png, image/jpeg, image/webp" style="display: none;" onchange="handleEditPackageImageSelect(this)">

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
                                <input type="text" id="editFormPkgName" name="nama_paket" class="form-text-input" placeholder="Ubah nama paket wisata" required>
                            </div>

                            <!-- Harga Mulai (Rp) -->
                            <div class="form-field-group">
                                <label class="form-field-label">Harga Mulai (Rp)</label>
                                <input type="text" id="editFormPkgPrice" name="harga" class="form-text-input" placeholder="Ubah harga" required>
                            </div>

                            <!-- Destinasi -->
                            <div class="form-field-group">
                                <label class="form-field-label">Destinasi</label>
                                <div class="custom-select-wrapper">
                                    <select id="editFormPkgDest" name="destinasi" class="form-select-control" required>
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
                                    <select id="editFormPkgCategory" name="kategori" class="form-select-control" required>
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
                                <input type="text" id="editFormPkgDuration" name="durasi" class="form-text-input" placeholder="Ubah durasi perjalanan" required>
                            </div>

                            <!-- Makan -->
                            <div class="form-field-group">
                                <label class="form-field-label">Makan</label>
                                <input type="text" id="editFormPkgMeal" name="makan" class="form-text-input" placeholder="Ubah makan yang didapatkan">
                            </div>

                            <!-- Deskripsi -->
                            <div class="form-field-group full-width">
                                <label class="form-field-label">Deskripsi</label>
                                <textarea id="editFormPkgDesc" name="deskripsi" class="form-textarea-control" placeholder="Ubah deskripsi paket wisata" rows="3"></textarea>
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
                                @forelse($orders as $ord)
                                @php
                                $statusLower = strtolower($ord->status);
                                $statusBadgeClass = ($statusLower === 'selesai' || $statusLower === 'disetujui') ? 'completed' : 'pending';
                                $statusLabel = ($statusLower === 'selesai') ? 'Selesai' : (($statusLower === 'disetujui') ? 'Disetujui' : 'Dipending');
                                $createdDateStr = \Carbon\Carbon::parse($ord->created_at)->translatedFormat('d F Y');
                                @endphp
                                <tr>
                                    <td>
                                        <div class="table-text-main">{{ $ord->nama_pemesan }}</div>
                                        <div class="table-text-sub">{{ $ord->nomor_hp }}</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">{{ $ord->nama_paket }}</div>
                                        <div class="table-text-sub">{{ $ord->kota_keberangkatan }}</div>
                                    </td>
                                    <td>
                                        <div class="table-text-main">{{ $createdDateStr }}</div>
                                        <div class="table-text-sub">{{ $ord->tanggal_keberangkatan }}</div>
                                    </td>
                                    <td>{{ $ord->jumlah_peserta }} Orang</td>
                                    <td><strong>Rp. {{ number_format($ord->total_pembayaran, 0, ',', '.') }}</strong></td>
                                    <td><span class="badge-status {{ $statusBadgeClass }}" data-order-badge="{{ $ord->id }}">{{ $statusLabel }}</span></td>
                                    <td>
                                        <button type="button" class="btn-detail-outline" onclick="showOrderDetail('{{ $ord->id }}')">
                                            Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; padding: 30px; color: #64748b;">
                                        <i class="fa-solid fa-folder-open" style="font-size: 24px; margin-bottom: 8px; display: block; color: #94a3b8;"></i>
                                        Belum ada riwayat pemesanan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if($isAdmin)
            <!-- ---------------------------------------------------- -->
            <!-- TAB: KELOLA PENGGUNA / USER MANAGEMENT (KHUSUS ADMIN)-->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-kelola-pengguna">
                <div class="admin-section-card">

                    <!-- Header & Title -->
                    <div class="admin-card-header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; margin-bottom: 22px;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <div class="summary-icon-circle" style="background: #e0f2fe; color: #0284c7; width: 44px; height: 44px; font-size: 18px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-users-gear"></i>
                            </div>
                            <div>
                                <h2 class="admin-card-title" style="margin: 0; font-size: 18px; font-weight: 700; color: #0f172a;">Kelola Pengguna</h2>
                                <p style="margin: 2px 0 0 0; font-size: 12.5px; color: #64748b;">Kelola akun pengguna, hak akses administrator, dan pendaftaran admin baru.</p>
                            </div>
                        </div>

                        <!-- Action Button: Tambah Admin Baru -->
                        <div>
                            <button type="button" class="btn-add-admin" onclick="openAddUserModal()">
                                <i class="fa-solid fa-user-plus"></i>
                                <span>Tambah Admin Baru</span>
                            </button>
                        </div>
                    </div>

                    {{-- Feedback Alerts --}}
                    @if(session('success'))
                    <div class="pkg-alert-success" style="background:#f0fdf4;border:1px solid #bbf7d0;border-left:5px solid #16a34a;color:#15803d;padding:12px 16px;border-radius:12px;margin-bottom:20px;font-weight:600;font-size:13px;display:flex;align-items:center;gap:10px;">
                        <i class="fa-solid fa-circle-check"></i> <span>{{ session('success') }}</span>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="pkg-alert-error" style="background:#fef2f2;border:1px solid #fecaca;border-left:5px solid #ef4444;color:#b91c1c;padding:12px 16px;border-radius:12px;margin-bottom:20px;font-weight:600;font-size:13px;display:flex;align-items:center;gap:10px;">
                        <i class="fa-solid fa-triangle-exclamation"></i> <span>{{ session('error') }}</span>
                    </div>
                    @endif

                    <!-- Stats Badges & Search Filter Controls -->
                    <div class="user-controls-bar">
                        <div class="user-stats-pills">
                            <button type="button" class="user-filter-pill active" data-filter="all" onclick="filterUserRole('all', this)">
                                Semua <span class="pill-count" id="countAllUsers">{{ $users->count() }}</span>
                            </button>
                            <button type="button" class="user-filter-pill" data-filter="admin" onclick="filterUserRole('admin', this)">
                                <i class="fa-solid fa-shield-halved" style="font-size: 11px; margin-right: 4px;"></i> Admin <span class="pill-count" id="countAdminUsers">{{ $users->where('role', 'admin')->count() }}</span>
                            </button>
                            <button type="button" class="user-filter-pill" data-filter="user" onclick="filterUserRole('user', this)">
                                <i class="fa-solid fa-user" style="font-size: 11px; margin-right: 4px;"></i> User <span class="pill-count" id="countRegularUsers">{{ $users->where('role', 'user')->count() }}</span>
                            </button>
                        </div>

                        <div class="user-search-wrapper">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input type="text" id="userSearchInput" class="user-search-input" placeholder="Cari ID, nama, atau email...">
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="table-responsive-wrapper" style="margin-top: 16px;">
                        <table class="admin-orders-table user-table" id="usersTable">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">ID</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th style="width: 120px;">Role</th>
                                    <th style="width: 130px;">Terdaftar</th>
                                    <th style="width: 250px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @forelse($users as $usr)
                                @php
                                $currentUserId = session('user.id');
                                $currentUserEmail = session('user.email');
                                $isSelf = ($usr->id == $currentUserId || $usr->email == $currentUserEmail);
                                $roleLower = strtolower($usr->role ?? 'user');
                                $joinedDate = $usr->created_at ? \Carbon\Carbon::parse($usr->created_at)->translatedFormat('d M Y') : '-';

                                $initials = strtoupper(substr($usr->name, 0, 1));
                                $avatarBg = ($roleLower === 'admin') ? 'linear-gradient(135deg, #f43f5e, #e11d48)' : 'linear-gradient(135deg, #0ea5e9, #0284c7)';
                                @endphp
                                <tr class="user-row"
                                    data-id="{{ $usr->id }}"
                                    data-name="{{ strtolower($usr->name) }}"
                                    data-email="{{ strtolower($usr->email) }}"
                                    data-role="{{ $roleLower }}">
                                    <td>
                                        <span class="user-id-badge">#{{ $usr->id }}</span>
                                    </td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            @if($roleLower === 'admin')
                                            <div class="user-avatar-initial" style="background: linear-gradient(135deg, #f43f5e, #e11d48);">
                                                {{ $initials }}
                                            </div>
                                            @else
                                            <div class="user-avatar-initial" style="background: linear-gradient(135deg, #0ea5e9, #0284c7);">
                                                {{ $initials }}
                                            </div>
                                            @endif
                                            <div>
                                                <div class="table-text-main" style="display: flex; align-items: center; gap: 6px;">
                                                    <span>{{ $usr->name }}</span>
                                                    @if($isSelf)
                                                    <span class="badge-self-user">Anda</span>
                                                    @endif
                                                </div>
                                                <div class="table-text-sub">Akun {{ ucfirst($roleLower) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-text-main" style="color: #475569; font-weight: 500;">
                                            <i class="fa-regular fa-envelope" style="color: #94a3b8; margin-right: 5px;"></i>
                                            {{ $usr->email }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($roleLower === 'admin')
                                        <span class="badge-user-role admin">
                                            <i class="fa-solid fa-shield-halved"></i> Admin
                                        </span>
                                        @else
                                        <span class="badge-user-role user">
                                            <i class="fa-solid fa-user"></i> User
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-text-main" style="font-size: 11px; color: #64748b;">
                                            {{ $joinedDate }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-action-buttons">
                                            <!-- 1. Tombol Ubah Role -->
                                            @if($isSelf && $roleLower === 'admin')
                                            <button type="button" class="btn-action-btn btn-role-disabled" title="Tidak dapat mengubah role akun sendiri saat login" disabled>
                                                <i class="fa-solid fa-lock"></i> Ubah Role
                                            </button>
                                            @else
                                            <form action="{{ route('admin.users.updateRole', $usr->id) }}" method="POST" style="margin: 0; display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                @if($roleLower === 'admin')
                                                <input type="hidden" name="role" value="user">
                                                <button type="submit" class="btn-action-btn btn-role-to-user" title="Ubah role pengguna menjadi User biasa" onclick="return confirm('Ubah role pengguna ini menjadi User?');">
                                                    <i class="fa-solid fa-arrow-down"></i> Ke User
                                                </button>
                                                @else
                                                <input type="hidden" name="role" value="admin">
                                                <button type="submit" class="btn-action-btn btn-role-to-admin" title="Tingkatkan role pengguna menjadi Admin" onclick="return confirm('Tingkatkan role pengguna ini menjadi Admin?');">
                                                    <i class="fa-solid fa-arrow-up"></i> Ke Admin
                                                </button>
                                                @endif
                                            </form>
                                            @endif

                                            <!-- 2. Tombol Edit -->
                                            <button type="button" class="btn-action-btn btn-edit-user" onclick="openEditUserModal('{{ $usr->id }}', '{{ addslashes($usr->name) }}', '{{ addslashes($usr->email) }}', '{{ $roleLower }}')" title="Edit Nama, Email, Role, atau Password">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </button>

                                            <!-- 3. Tombol Hapus -->
                                            @if($isSelf)
                                            <button type="button" class="btn-action-btn btn-delete-disabled" title="Tidak dapat menghapus akun sendiri saat login" disabled>
                                                <i class="fa-solid fa-trash-can"></i> Hapus
                                            </button>
                                            @else
                                            <button type="button" class="btn-action-btn btn-delete-user" onclick="openDeleteUserModal('{{ $usr->id }}', '{{ addslashes($usr->name) }}', '{{ $roleLower }}')" title="Hapus Akun Pengguna">
                                                <i class="fa-solid fa-trash-can"></i> Hapus
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="emptyUserRow">
                                    <td colspan="6" style="text-align: center; padding: 40px 20px; color: #64748b;">
                                        <i class="fa-solid fa-users-slash" style="font-size: 32px; color: #94a3b8; margin-bottom: 10px; display: block;"></i>
                                        Belum ada pengguna yang terdaftar di sistem.
                                    </td>
                                </tr>
                                @endforelse
                                <tr id="noSearchResultRow" style="display: none;">
                                    <td colspan="6" style="text-align: center; padding: 36px 20px; color: #64748b;">
                                        <i class="fa-solid fa-magnifying-glass" style="font-size: 26px; color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                                        Tidak ditemukan pengguna yang sesuai dengan pencarian.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endif

            @if($isAdmin)
            <!-- ---------------------------------------------------- -->
            <!-- TAB 4: PENGATURAN PROFIL TAB (KHUSUS ADMIN)          -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-pengaturan">
                <div class="admin-section-card">
                    <div class="admin-card-header">
                        <h2 class="admin-card-title">Pengaturan Akun & Profil</h2>
                    </div>

                    <form class="admin-settings-form" id="formPengaturan" onsubmit="submitPengaturan(event)">
                        @csrf
                        <div class="form-group-row">
                            <label class="form-group-label" for="settingName">Nama Pengguna</label>
                            <input type="text" id="settingName" name="name" class="form-input-control"
                                value="{{ session('user.name', '') }}" required>
                        </div>

                        <div class="form-group-row">
                            <label class="form-group-label" for="settingEmail">Email Pengguna</label>
                            <input type="email" id="settingEmail" name="email" class="form-input-control"
                                value="{{ session('user.email', '') }}" required>
                        </div>

                        <div class="form-group-row">
                            <label class="form-group-label" for="settingPhone">Nomor WhatsApp / Telepon</label>
                            @php
                                $sessionUserId = session('user.id');
                                $adminUserObj  = $sessionUserId ? \App\Models\User::find($sessionUserId) : null;
                                $adminPhone    = $adminUserObj ? ($adminUserObj->phone ?? '') : '';
                            @endphp
                            <input type="tel" id="settingPhone" name="phone" class="form-input-control"
                                value="{{ $adminPhone }}">
                        </div>

                        <div class="form-group-row">
                            <label class="form-group-label" for="settingPass">Ganti Password (Opsional)</label>
                            <input type="password" id="settingPass" name="password" class="form-input-control"
                                placeholder="Biarkan kosong jika tidak ingin mengubah password">
                        </div>

                        <button type="submit" class="btn-save-settings" id="btnSavePengaturan">
                            <i class="fa-solid fa-floppy-disk" style="margin-right: 6px;"></i> Simpan Perubahan
                        </button>
                    </form>

                    <script>
                    function submitPengaturan(e) {
                        e.preventDefault();
                        const btn = document.getElementById('btnSavePengaturan');
                        const originalText = btn.innerHTML;
                        btn.disabled = true;
                        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';

                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                                       || document.querySelector('input[name="_token"]')?.value || '';

                        if (!csrfToken) {
                            showToast('CSRF token tidak ditemukan. Refresh halaman lalu coba lagi.', 'error');
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                            return;
                        }

                        const formData = new FormData();
                        formData.append('_token', csrfToken);
                        formData.append('name',     document.getElementById('settingName').value.trim());
                        formData.append('email',    document.getElementById('settingEmail').value.trim());
                        formData.append('phone',    document.getElementById('settingPhone').value.trim());
                        formData.append('password', document.getElementById('settingPass').value);

                        fetch('/profile/update', {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                            body: formData
                        })
                        .then(res => {
                            if (!res.ok && res.status === 419) {
                                throw new Error('Session expired. Silakan refresh halaman.');
                            }
                            return res.json();
                        })
                        .then(data => {
                            if (data.success) {
                                showToast(data.message || 'Profil berhasil diperbarui!', 'success');
                                // Update tampilan nama di sidebar & navbar langsung
                                const newName = document.getElementById('settingName').value.trim();
                                document.querySelectorAll('.admin-profile-name, .user-menu-name').forEach(el => {
                                    el.textContent = newName;
                                });
                                document.getElementById('settingPass').value = '';
                            } else {
                                showToast(data.message || 'Gagal menyimpan perubahan.', 'error');
                            }
                        })
                        .catch(err => showToast(err.message || 'Terjadi kesalahan jaringan. Coba lagi.', 'error'))
                        .finally(() => {
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        });
                    }
                    </script>
                </div>
            </div>

            <!-- ---------------------------------------------------- -->
            <!-- TAB: PESAN MASUK / CONTACT MESSAGES (KHUSUS ADMIN)  -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-pesan-masuk">
                <div class="admin-section-card">
                    <!-- Header & Title -->
                    <div class="admin-card-header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; margin-bottom: 22px;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <div class="summary-icon-circle" style="background: #e0f2fe; color: #0284c7; width: 44px; height: 44px; font-size: 18px; border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <h2 class="admin-card-title" style="margin: 0; font-size: 18px; font-weight: 700; color: #0f172a;">Pesan Masuk (Hubungi Kami)</h2>
                                <p style="margin: 2px 0 0 0; font-size: 12.5px; color: #64748b;">Daftar pesan dan pertanyaan yang dikirimkan pengunjung melalui formulir kontak.</p>
                            </div>
                        </div>
                        <div>
                            <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; background: #f1f5f9; border-radius: 9999px; font-size: 12px; font-weight: 600; color: #475569;">
                                Total: <strong style="color: #0284c7;">{{ isset($contacts) ? $contacts->count() : 0 }} Pesan</strong>
                            </span>
                        </div>
                    </div>

                    @if(!isset($contacts) || $contacts->isEmpty())
                    <div style="text-align: center; padding: 48px 20px; color: #94a3b8;">
                        <div style="width: 64px; height: 64px; border-radius: 50%; background: #f8fafc; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto; font-size: 24px; color: #cbd5e1;">
                            <i class="fa-regular fa-envelope-open"></i>
                        </div>
                        <h3 style="font-size: 16px; font-weight: 600; color: #475569; margin-bottom: 6px;">Belum Ada Pesan Masuk</h3>
                        <p style="font-size: 13px; margin: 0;">Pesan yang dikirim pengunjung melalui form Hubungi Kami di beranda akan muncul di sini.</p>
                    </div>
                    @else
                    <div class="table-responsive" style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                            <thead>
                                <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; text-align: left; color: #475569;">
                                    <th style="padding: 12px 16px; font-weight: 600;">Waktu</th>
                                    <th style="padding: 12px 16px; font-weight: 600;">Pengirim</th>
                                    <th style="padding: 12px 16px; font-weight: 600;">Kontak</th>
                                    <th style="padding: 12px 16px; font-weight: 600;">Isi Pesan</th>
                                    <th style="padding: 12px 16px; font-weight: 600; text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $c)
                                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s ease;">
                                    <td style="padding: 12px 16px; color: #64748b; white-space: nowrap; vertical-align: top;">
                                        <i class="fa-regular fa-calendar" style="margin-right: 4px;"></i>
                                        {{ $c->created_at ? $c->created_at->format('d M Y, H:i') : '-' }}
                                    </td>
                                    <td style="padding: 12px 16px; font-weight: 600; color: #0f172a; vertical-align: top;">
                                        {{ $c->name ?: ($c->nama_lengkap ?: 'Pengirim') }}
                                    </td>
                                    <td style="padding: 12px 16px; vertical-align: top;">
                                        <div style="display: flex; flex-direction: column; gap: 4px;">
                                            <a href="mailto:{{ $c->email }}" style="color: #0284c7; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                                <i class="fa-regular fa-envelope"></i> {{ $c->email }}
                                            </a>
                                            @php
                                                $rawPhone = $c->phone ?: $c->nomor_telepon;
                                                $waNumber = preg_replace('/[^0-9]/', '', $rawPhone);
                                                if (str_starts_with($waNumber, '0')) {
                                                    $waNumber = '62' . substr($waNumber, 1);
                                                }
                                            @endphp
                                            @if($rawPhone)
                                            <a href="https://wa.me/{{ $waNumber }}" target="_blank" style="color: #16a34a; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; font-weight: 500;">
                                                <i class="fa-brands fa-whatsapp"></i> {{ $rawPhone }}
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="padding: 12px 16px; color: #334155; line-height: 1.5; vertical-align: top; max-width: 380px;">
                                        {{ $c->message ?: $c->pesan }}
                                    </td>
                                    <td style="padding: 12px 16px; text-align: right; vertical-align: top; white-space: nowrap;">
                                        @if($rawPhone)
                                        <a href="https://wa.me/{{ $waNumber }}?text=Halo%20{{ urlencode($c->name ?: $c->nama_lengkap) }},%20terima%20kasih%20sudah%20menghubungi%20Go%20Travel." target="_blank" style="background: #22c55e; color: white; padding: 6px 12px; border-radius: 8px; font-size: 12px; text-decoration: none; margin-right: 6px; display: inline-flex; align-items: center; gap: 4px;" title="Balas via WhatsApp">
                                            <i class="fa-brands fa-whatsapp"></i> Balas
                                        </a>
                                        @endif
                                        <form action="{{ route('admin.contacts.destroy', $c->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus pesan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; padding: 6px 10px; border-radius: 8px; font-size: 12px; cursor: pointer;" title="Hapus pesan">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

            <!-- ---------------------------------------------------- -->
            <!-- TAB: WISHLIST SAYA                                  -->
            <!-- ---------------------------------------------------- -->
            <div class="tab-content-pane" id="tab-wishlist-saya">
                <div class="admin-section-card">
                    <div class="admin-card-header" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                        <div>
                            <h2 class="admin-card-title" style="display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-heart" style="color: #ef4444;"></i>
                                <span>Wishlist Saya</span>
                            </h2>
                            <p style="font-size: 13px; color: #64748b; margin: 4px 0 0 0;">
                                Daftar paket wisata impian yang Anda sukai dan simpan.
                            </p>
                        </div>
                        <span class="badge-status" id="adminWishlistBadge" style="background: #fff2eb; color: #ea580c; border: 1px solid #ffd8c4; font-size: 12px; font-weight: 700;">
                            Total: {{ ($adminWishlists ?? collect())->count() }} Paket
                        </span>
                    </div>

                    @if(isset($adminWishlists) && $adminWishlists->count() > 0)
                    <div class="wishlist-grid" id="adminWishlistGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 18px;">
                        @foreach($adminWishlists as $wish)
                        @php
                        $pkg = $wish->package;
                        @endphp
                        @if($pkg)
                        <div class="wishlist-card" id="adminWishlistCard-{{ $pkg->slug }}" data-slug="{{ $pkg->slug }}" style="background: #ffffff; border-radius: 18px; border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column; transition: all 0.3s ease; position: relative; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);">
                            <div style="position: relative; height: 170px; background: #f1f5f9; overflow: hidden;">
                                <img src="{{ asset($pkg->gambar_url) }}" alt="{{ $pkg->nama_paket }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null;this.src='/images/jogja.jpg';">
                                <span style="position: absolute; top: 12px; left: 12px; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(6px); color: #ffffff; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">
                                    {{ strtoupper($pkg->durasi ?? '1 HARI') }}
                                </span>
                                <button type="button" title="Hapus dari Wishlist" aria-label="Hapus dari Wishlist" onclick="removeFromAdminWishlist('{{ $pkg->slug }}')" style="position: absolute; top: 12px; right: 12px; width: 36px; height: 36px; border-radius: 50%; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(6px); border: 1px solid rgba(226, 232, 240, 0.8); color: #ef4444; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                                    <i class="fa-solid fa-heart-crack"></i>
                                </button>
                            </div>
                            <div style="padding: 16px 18px 18px; display: flex; flex-direction: column; flex: 1;">
                                <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #ea580c; letter-spacing: 0.5px; margin-bottom: 4px;">
                                    {{ $pkg->kategori ?? 'Tour Wisata' }}
                                </span>
                                <h4 style="font-size: 15px; font-weight: 700; color: #0f172a; line-height: 1.35; margin-bottom: 8px;" title="{{ $pkg->nama_paket }}">
                                    {{ $pkg->nama_paket }}
                                </h4>
                                <div style="font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 6px; margin-bottom: 14px;">
                                    <i class="fa-solid fa-location-dot" style="color: #ea580c;"></i>
                                    <span>{{ $pkg->destinasi ?? 'Indonesia' }}</span>
                                </div>
                                <div style="margin-top: auto; display: flex; align-items: center; justify-content: space-between; gap: 12px; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                                    <div>
                                        <div style="font-size: 11px; color: #64748b; font-weight: 600;">Mulai dari</div>
                                        <div style="font-size: 15px; font-weight: 800; color: #ea580c;">Rp. {{ number_format($pkg->harga, 0, ',', '.') }}</div>
                                    </div>
                                    <a href="{{ url('/paket-wisata/' . $pkg->slug) }}" target="_blank" style="padding: 8px 14px; border-radius: 9999px; background: #ea580c; color: #ffffff; font-size: 12px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                                        <span>Lihat</span>
                                        <i class="fa-solid fa-arrow-right" style="font-size: 11px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @else
                    <div id="adminWishlistEmptyState" style="text-align: center; padding: 48px 16px; color: #64748b;">
                        <div style="width: 60px; height: 60px; border-radius: 50%; background: #fff2eb; color: #ea580c; display: inline-flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 14px;">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Belum ada paket wisata di Wishlist</h4>
                        <p style="margin: 0; font-size: 13.5px; color: #64748b; max-width: 400px; margin: 0 auto;">
                            Klik ikon love pada paket wisata untuk menambahkannya ke daftar wishlist Anda.
                        </p>
                        <a href="{{ url('/paket-wisata') }}" class="btn-step-primary" style="display: inline-flex; margin-top: 18px; text-decoration: none; padding: 10px 24px; font-size: 13px;">
                            <i class="fa-solid fa-compass" style="margin-right: 6px;"></i> Jelajahi Paket Wisata
                        </a>
                    </div>
                    @endif
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
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                    <h3 class="detail-card-title" style="margin-bottom: 0;">Bukti Pembayaran</h3>
                                    <span style="font-size: 11px; background: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 6px; font-weight: 600;">
                                        <i class="fa-solid fa-camera"></i> Foto Pengguna
                                    </span>
                                </div>
                                <div class="bukti-photo-wrapper">
                                    <div class="bukti-photo-frame" onclick="openBuktiModal()" style="cursor: pointer; position: relative; border-radius: 14px; overflow: hidden; border: 1.5px solid #e2e8f0; background: #0f172a; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.25s ease;">
                                        <img id="dtBuktiImage" src="{{ asset('images/sample-receipt.jpg') }}" alt="Bukti Transfer" style="width: 100%; max-height: 380px; object-fit: contain; display: block; margin: 0 auto; transition: transform 0.3s ease;">
                                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(15,23,42,0.85)); padding: 12px 14px; color: #fff; display: flex; align-items: center; justify-content: space-between; font-size: 11.5px;">
                                            <span id="dtBuktiFileName" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px;"><i class="fa-solid fa-file-image" style="color: #38bdf8;"></i> Bukti Transfer</span>
                                            <span style="background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 3px 8px; border-radius: 6px; font-weight: 500; font-size: 10.5px;"><i class="fa-solid fa-magnifying-glass-plus"></i> Perbesar</span>
                                        </div>
                                    </div>
                                    <div style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #64748b; padding: 0 4px;">
                                        <span><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> Terverifikasi Pengguna</span>
                                        <a id="dtBuktiDownloadBtn" href="{{ asset('images/sample-receipt.jpg') }}" target="_blank" style="color: #2563eb; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Gambar Penuh
                                        </a>
                                    </div>
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

<!-- ==================== DATASET DARI DATABASE (JSON) ==================== -->
@php
    $orderDatabaseList = [];
    $allPaketList = [];
    try {
        $allPaketList = \App\Http\Controllers\PaketWisataController::getPaketData();
    } catch (\Throwable $e) {
        $allPaketList = [];
    }

    if (isset($orders)) {
        foreach($orders as $ord) {
            $statusLower = strtolower($ord->status ?? '');
            $statusFormatted = ($statusLower === 'selesai') ? 'Selesai' : (($statusLower === 'disetujui') ? 'Disetujui' : 'Dipending');
            $pkg = $allPaketList[$ord->paket_slug] ?? null;
            $pkgImage = $pkg['image'] ?? 'images/jogja.jpg';
            $pkgDuration = $pkg['duration'] ?? '1 Hari';
            $pkgHotel = $pkg['hotel_info'] ?? 'Hotel Rekomendasi';
            $pkgMeal = $pkg['meal_info'] ?? 'Makan Sesuai Program';
            $pricePerPerson = $pkg['price'] ?? ('Rp ' . number_format(($ord->total_pembayaran ?? 0) / max(1, $ord->jumlah_peserta ?? 1), 0, ',', '.'));
            $totalFormatted = 'Rp. ' . number_format($ord->total_pembayaran ?? 0, 0, ',', '.');
            $createdCarbon = \Carbon\Carbon::parse($ord->created_at);

            $orderDatabaseList[(string)$ord->id] = [
                'id' => (int)$ord->id,
                'orderDate' => $createdCarbon->translatedFormat("d F Y"),
                'status' => $statusFormatted,
                'pkgName' => (string)($ord->nama_paket ?? ''),
                'pkgDuration' => (string)$pkgDuration,
                'pkgHotel' => (string)$pkgHotel,
                'pkgMeal' => (string)$pkgMeal,
                'pkgImage' => asset($pkgImage),
                'custName' => (string)($ord->nama_pemesan ?? ''),
                'custEmail' => (string)($ord->email_pemesan ?? ''),
                'custPhone' => (string)($ord->nomor_hp ?? ''),
                'custAddress' => (string)($ord->kota_keberangkatan ?? ''),
                'custNotes' => (string)($ord->catatan ?: "Tidak ada catatan"),
                'bookingDate' => $createdCarbon->translatedFormat("d F Y"),
                'departDate' => (string)($ord->tanggal_keberangkatan ?? ''),
                'departCity' => (string)($ord->kota_keberangkatan ?? ''),
                'pricePerPerson' => $pricePerPerson,
                'participants' => ($ord->jumlah_peserta ?? 1) . ' Orang',
                'payMethod' => ($ord->skema_pembayaran === "dp30") ? "Down Payment (DP 30%)" : "Pembayaran Lunas (100%)",
                'payStatus' => 'Berhasil',
                'payDate' => $createdCarbon->translatedFormat("d F Y"),
                'totalPay' => $totalFormatted,
                'receiptAmount' => $totalFormatted,
                'receiptTime' => $createdCarbon->format("d M Y") . " \u2022 " . $createdCarbon->format("H:i"),
                'receiptId' => 'ORD-' . str_pad($ord->id, 8, "0", STR_PAD_LEFT),
                'receiptTx' => 'TX-' . $ord->id . '-' . strtotime($ord->created_at),
                'receiptMerchant' => 'GO Travel Indonesia',
                'receiptMethod' => 'WhatsApp / Transfer',
                'buktiImage' => (!empty($ord->bukti_pembayaran) && (str_starts_with($ord->bukti_pembayaran, 'http') || str_starts_with($ord->bukti_pembayaran, 'data:'))) ? $ord->bukti_pembayaran : asset('images/sample-receipt.jpg'),
                'buktiFileName' => basename($ord->bukti_pembayaran ?: 'Screenshot_Transfer_Ayomi.png'),
            ];
        }
    }

    $dbPackagesList = [];
    if (isset($packages) && count($packages) > 0) {
        foreach($packages as $dbPkg) {
            $dbPackagesList[$dbPkg->slug] = [
                'id' => (int)$dbPkg->id,
                'slug' => (string)$dbPkg->slug,
                'name' => (string)($dbPkg->nama_paket ?? ''),
                'price' => (string)($dbPkg->formatted_harga ?? ''),
                'location' => (string)($dbPkg->destinasi ?? ''),
                'destination' => (string)($dbPkg->destinasi ?? ''),
                'category' => (string)($dbPkg->kategori ?: 'Wisata Alam'),
                'duration' => (string)($dbPkg->durasi ?? ''),
                'meal' => (string)($dbPkg->makan ?: 'Makan Sesuai Program'),
                'image' => (string)($dbPkg->gambar_url ?? ''),
                'description' => (string)($dbPkg->deskripsi ?: ''),
                'itinerary' => $dbPkg->itinerary ?: [],
            ];
        }
    }
@endphp

<script id="adminOrdersData" type="application/json">
{!! json_encode($orderDatabaseList, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!}
</script>
<script id="adminPackagesData" type="application/json">
{!! json_encode($dbPackagesList, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) !!}
</script>

<!-- ==================== SCRIPT LOGIKA PROFILE & ADMIN DASHBOARD ==================== -->
<script>
    // Master Dataset of Orders dynamically generated from database
    const rawOrdersData = document.getElementById('adminOrdersData');
    const orderDatabase = rawOrdersData ? JSON.parse(rawOrdersData.textContent || '{}') : {};
let currentViewingOrderKey = Object.keys(orderDatabase)[0] || '';

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

        // URL query parameter tab auto-activator (?tab=users or ?tab=tab-kelola-pengguna)
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab');
        if (tabParam === 'users' || tabParam === 'tab-kelola-pengguna') {
            activateTab('tab-kelola-pengguna');
        } else if (tabParam === 'pesan-masuk' || tabParam === 'tab-pesan-masuk') {
            activateTab('tab-pesan-masuk');
        } else if (tabParam && document.getElementById(tabParam)) {
            activateTab(tabParam);
        }

        // Real-time user management search
        const userSearchInput = document.getElementById('userSearchInput');
        if (userSearchInput) {
            userSearchInput.addEventListener('input', function() {
                filterUserTable();
            });
        }

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
    // MASTER DATASET OF PACKAGES (DARI DATABASE + FALLBACK)
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
            itinerary: [{
                    day: 1,
                    slots: [{
                            time: '08.00 - 12.00',
                            activity: 'Tiba di Jogja, explore Candi Prambanan & Tebing Breksi'
                        },
                        {
                            time: '13.00 - 17.00',
                            activity: 'Makan siang kuliner khas Gudeg & sunset di Pantai Parangtritis'
                        }
                    ]
                },
                {
                    day: 2,
                    slots: [{
                            time: '08.00 - 12.00',
                            activity: 'Keraton Ngayogyakarta & Tamansari Water Castle'
                        },
                        {
                            time: '13.00 - 16.00',
                            activity: 'Belanja oleh-oleh di Malioboro & Sentra Bakpia Pathok'
                        }
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
            itinerary: [{
                day: 1,
                slots: [{
                        time: '00.30 - 04.30',
                        activity: 'Meeting point & perjalanan jeep menuju Penanjakan Bromo'
                    },
                    {
                        time: '05.00 - 09.30',
                        activity: 'Golden Sunrise, Kawah Bromo, Pasir Berbisik & Savana Teletubbies'
                    }
                ]
            }]
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
            itinerary: [{
                    day: 1,
                    slots: [{
                            time: '08.00 - 12.00',
                            activity: 'Penyeberangan pelabuhan & eksplorasi Pulau Kelagian'
                        },
                        {
                            time: '13.00 - 17.00',
                            activity: 'Snorkeling di Pahawang Besar & check-in homestay'
                        }
                    ]
                },
                {
                    day: 2,
                    slots: [{
                            time: '06.00 - 11.00',
                            activity: 'Dolphin tour di Teluk Kiluan melihat lumba-lumba'
                        },
                        {
                            time: '13.00 - 16.30',
                            activity: 'Laguna Gayau & bersantai di pantai pasir putih'
                        }
                    ]
                },
                {
                    day: 3,
                    slots: [{
                        time: '08.00 - 12.00',
                        activity: 'Beli oleh-oleh kripik pisang khas Lampung & transfer kembali'
                    }]
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
            itinerary: [{
                    day: 1,
                    slots: [{
                            time: '10.00 - 14.00',
                            activity: 'Penjemputan Bandara Ngurah Rai & check-in hotel'
                        },
                        {
                            time: '15.30 - 19.00',
                            activity: 'Sunset Tanah Lot & makan malam santai'
                        }
                    ]
                },
                {
                    day: 2,
                    slots: [{
                            time: '08.30 - 13.00',
                            activity: 'Kintamani view Gunung & Danau Batur'
                        },
                        {
                            time: '14.00 - 17.30',
                            activity: 'Tegalalang Rice Terrace & Tirta Empul'
                        }
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
            itinerary: [{
                day: 1,
                slots: [{
                        time: '08.00 - 12.30',
                        activity: 'Wisata Kawah Putih Ciwidey & Kebun Teh Rancabali'
                    },
                    {
                        time: '13.30 - 17.00',
                        activity: 'Glamping Lakeside & Situ Patenggang'
                    }
                ]
            }]
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
            itinerary: [{
                day: 1,
                slots: [{
                        time: '09.00 - 12.00',
                        activity: 'Walking tour Malioboro & Titik Nol Kilometer'
                    },
                    {
                        time: '13.00 - 16.00',
                        activity: 'Keraton & belanja batik Pasar Beringharjo'
                    }
                ]
            }]
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
            itinerary: [{
                day: 1,
                slots: [{
                        time: '07.00 - 11.30',
                        activity: 'Eksplorasi Kawah Ratu & Kawah Domas'
                    },
                    {
                        time: '12.30 - 15.30',
                        activity: 'Pemandian Air Panas Ciater & Kebun Teh'
                    }
                ]
            }]
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
            itinerary: [{
                day: 1,
                slots: [{
                        time: '09.00 - 12.00',
                        activity: 'Foto tebing Patung Pandawa Lima & pantai pasir putih'
                    },
                    {
                        time: '13.00 - 16.00',
                        activity: 'Bermain kano laut & bersantai di beach club'
                    }
                ]
            }]
        }
    };

    // Sinkronkan paket dari database ke objek JavaScript packagesDatabase
    const rawPackagesData = document.getElementById('adminPackagesData');
    if (rawPackagesData) {
        try {
            const dbPackages = JSON.parse(rawPackagesData.textContent || '{}');
            Object.assign(packagesDatabase, dbPackages);
        } catch (e) {
            console.error('Failed to parse packages data:', e);
        }
    }

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

        window.scrollTo({
            top: document.querySelector('.admin-glass-container').offsetTop - 20,
            behavior: 'smooth'
        });
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
                    slots.push({
                        time: time,
                        activity: act
                    });
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

    function handleSavePackageForm(event) {
        // Prevent default HTML submit so we can collect itinerary first
        if (event) event.preventDefault();

        const nameInput = document.getElementById('inputFormPkgName');
        const priceInput = document.getElementById('inputFormPkgPrice');
        const destInput = document.getElementById('inputFormPkgDest');
        const categoryInput = document.getElementById('inputFormPkgCategory');
        const durationInput = document.getElementById('inputFormPkgDuration');

        const name = nameInput ? nameInput.value.trim() : '';
        const price = priceInput ? priceInput.value.trim() : '';
        const dest = destInput ? destInput.value : '';
        const category = categoryInput ? categoryInput.value : '';
        const duration = durationInput ? durationInput.value.trim() : '';

        // Validasi sisi klien
        if (!name || !price || !dest || !category || !duration) {
            showToast('Mohon lengkapi nama paket, harga, destinasi, kategori, dan durasi!', 'info');
            return false;
        }

        // Kumpulkan itinerary sebagai JSON lalu masukkan ke hidden input
        const itineraryList = collectItineraryFromContainer('itineraryDaysContainer');
        const itineraryHidden = document.getElementById('itineraryJsonInput');
        if (itineraryHidden) {
            itineraryHidden.value = JSON.stringify(itineraryList);
        }

        // Submit form secara normal ke server (POST /admin/packages)
        const form = document.getElementById('addPackageForm');
        if (form) {
            showToast(`Menyimpan paket "${name}" ke database...`, 'info');
            form.submit();
        }

        return false;
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
                itinerary: [{
                    day: 1,
                    slots: [{
                        time: '08.00 - 12.00',
                        activity: 'Aktivitas tour'
                    }]
                }]
            };
        }

        document.getElementById('editPkgSlug').value = slugOrName;
        document.getElementById('editPkgId').value = pkg.id || '';
        document.getElementById('editFromTab').value = fromTab;
        document.getElementById('editPageMainTitle').textContent = `Edit Paket Wisata - ${pkg.name}`;

        // Set action form dinamis
        const editForm = document.getElementById('editPackageForm');
        if (editForm) {
            editForm.action = pkg.id ? `/admin/packages/${pkg.id}` : `/admin/packages/${slugOrName}`;
        }

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
                } else if (item.schedules && Array.isArray(item.schedules)) {
                    addEditItineraryDay(item.schedules);
                } else if (item.time || item.activity) {
                    addEditItineraryDay([{
                        time: item.time || '',
                        activity: item.activity || ''
                    }]);
                }
            });
        } else {
            addEditItineraryDay([{
                time: '08.00 - 12.00',
                activity: 'Aktivitas wisata & eksplorasi destinasi'
            }]);
        }

        // Switch pane to Edit Paket & keep sidebar active
        activateTab('tab-edit-paket');
        const pkgSideLink = document.querySelector('.sidebar-nav-link[data-tab="tab-paket-wisata"]');
        if (pkgSideLink) pkgSideLink.classList.add('active');

        window.scrollTo({
            top: document.querySelector('.admin-glass-container').offsetTop - 20,
            behavior: 'smooth'
        });
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

    function handleSaveEditPackageForm(event) {
        if (event) event.preventDefault();

        const slug = document.getElementById('editPkgSlug').value;
        const fromTab = document.getElementById('editFromTab').value || 'tab-paket-wisata';

        const name = document.getElementById('editFormPkgName').value.trim();
        let price = document.getElementById('editFormPkgPrice').value.trim();
        const dest = document.getElementById('editFormPkgDest').value;
        const category = document.getElementById('editFormPkgCategory').value;
        const duration = document.getElementById('editFormPkgDuration').value.trim();

        if (!name || !price || !dest) {
            showToast('Mohon lengkapi nama paket, harga, dan destinasi!', 'info');
            return false;
        }

        // Collect structured edit itinerary
        const itineraryList = collectItineraryFromContainer('editItineraryDaysContainer');
        const itineraryHidden = document.getElementById('editItineraryJsonInput');
        if (itineraryHidden) {
            itineraryHidden.value = JSON.stringify(itineraryList);
        }

        const editForm = document.getElementById('editPackageForm');
        if (editForm) {
            showToast(`Menyimpan perubahan paket "${name}"...`, 'info');
            editForm.submit();
        }

        return false;
    }

    // ==========================================
    // 3. HAPUS PAKET WISATA HANDLER
    // ==========================================
    function deletePackageConfirm(slugOrName, displayName, packageId = null) {
        displayName = displayName || slugOrName;
        if (!confirm(`Apakah Anda yakin ingin menghapus paket "${displayName}"?`)) {
            return;
        }

        // Cari ID paket jika belum dipass
        if (!packageId && packagesDatabase[slugOrName] && packagesDatabase[slugOrName].id) {
            packageId = packagesDatabase[slugOrName].id;
        }

        if (packageId) {
            // Buat form dinamis untuk submit DELETE ke server
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/packages/${packageId}`;
            form.style.display = 'none';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        } else {
            // Fallback client-side remove jika tidak ada ID
            if (packagesDatabase[slugOrName]) {
                delete packagesDatabase[slugOrName];
            }
            const matchingCards = document.querySelectorAll(`[data-package-slug="${slugOrName}"]`);
            matchingCards.forEach(card => card.remove());
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

        if (document.getElementById('dtReceiptAmount')) document.getElementById('dtReceiptAmount').textContent = data.receiptAmount;
        if (document.getElementById('dtReceiptTime')) document.getElementById('dtReceiptTime').textContent = data.receiptTime;
        if (document.getElementById('dtReceiptId')) document.getElementById('dtReceiptId').textContent = data.receiptId;
        if (document.getElementById('dtReceiptTx')) document.getElementById('dtReceiptTx').textContent = data.receiptTx;
        if (document.getElementById('dtReceiptMerchant')) document.getElementById('dtReceiptMerchant').textContent = data.receiptMerchant;
        if (document.getElementById('dtReceiptMethod')) document.getElementById('dtReceiptMethod').innerHTML = `<i class="fa-solid fa-circle-check" style="color: #2563eb; margin-right: 4px;"></i> ${data.receiptMethod}`;

        // Update Bukti Pembayaran Image & Link
        const buktiImg = document.getElementById('dtBuktiImage');
        if (buktiImg) {
            buktiImg.src = data.buktiImage || '/images/sample-receipt.jpg';
            buktiImg.onerror = function() {
                this.onerror = null;
                this.src = '/images/sample-receipt.jpg';
            };
        }
        const buktiLink = document.getElementById('dtBuktiDownloadBtn');
        if (buktiLink) {
            buktiLink.href = data.buktiImage || '/images/sample-receipt.jpg';
        }
        const buktiName = document.getElementById('dtBuktiFileName');
        if (buktiName) {
            buktiName.innerHTML = `<i class="fa-solid fa-file-image" style="color: #38bdf8;"></i> ${data.buktiFileName || 'Bukti Transfer'}`;
        }

        document.querySelectorAll('.tab-content-pane').forEach(p => p.classList.remove('active'));
        document.getElementById('tab-detail-pemesanan').classList.add('active');

        document.querySelectorAll('.sidebar-nav-link').forEach(btn => btn.classList.remove('active'));
        const riwayatBtn = document.querySelector('.sidebar-nav-link[data-tab="tab-riwayat-pemesanan"]');
        if (riwayatBtn) riwayatBtn.classList.add('active');

        window.scrollTo({
            top: document.querySelector('.admin-glass-container').offsetTop - 20,
            behavior: 'smooth'
        });
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

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

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

            if (orderData.id) {
                fetch(`/orders/${orderData.id}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: 'disetujui'
                    })
                }).catch(err => console.error('Status sync error:', err));
            }
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

            if (orderData.id) {
                fetch(`/orders/${orderData.id}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        status: 'dipending'
                    })
                }).catch(err => console.error('Status sync error:', err));
            }
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

        const iconHtml = (type === 'success') ?
            '<i class="fa-solid fa-circle-check admin-toast-icon"></i>' :
            '<i class="fa-solid fa-circle-info admin-toast-icon"></i>';

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

    // ==========================================
    // KELOLA PENGGUNA (USER MANAGEMENT) SCRIPT
    // ==========================================
    let currentUserRoleFilter = 'all';

    function filterUserRole(role, btnEl) {
        currentUserRoleFilter = role;
        document.querySelectorAll('.user-filter-pill').forEach(pill => pill.classList.remove('active'));
        if (btnEl) btnEl.classList.add('active');
        filterUserTable();
    }

    function filterUserTable() {
        const searchInput = document.getElementById('userSearchInput');
        const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
        const rows = document.querySelectorAll('.user-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const id = row.getAttribute('data-id') || '';
            const name = row.getAttribute('data-name') || '';
            const email = row.getAttribute('data-email') || '';
            const role = row.getAttribute('data-role') || '';

            const matchesSearch = !query || id.includes(query) || name.includes(query) || email.includes(query);
            const matchesRole = (currentUserRoleFilter === 'all') || (role === currentUserRoleFilter);

            if (matchesSearch && matchesRole) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noResultRow = document.getElementById('noSearchResultRow');
        if (noResultRow) {
            if (visibleCount === 0 && rows.length > 0) {
                noResultRow.style.display = '';
            } else {
                noResultRow.style.display = 'none';
            }
        }
    }

    // Modal: Tambah User / Admin
    function openAddUserModal() {
        const modal = document.getElementById('addUserModal');
        if (modal) {
            modal.classList.add('show');
            const nameInput = document.getElementById('addUserName');
            if (nameInput) setTimeout(() => nameInput.focus(), 100);
        }
    }

    function closeAddUserModal() {
        const modal = document.getElementById('addUserModal');
        if (modal) {
            modal.classList.remove('show');
            const form = document.getElementById('addUserForm');
            if (form) form.reset();
        }
    }

    // Modal: Edit User
    function openEditUserModal(id, name, email, role) {
        const modal = document.getElementById('editUserModal');
        const form = document.getElementById('editUserForm');
        if (!modal || !form) return;

        form.action = `/admin/users/${id}`;
        document.getElementById('editUserId').value = id;
        document.getElementById('editUserName').value = name;
        document.getElementById('editUserEmail').value = email;
        document.getElementById('editUserPassword').value = '';
        document.getElementById('editUserRole').value = role;

        modal.classList.add('show');
        setTimeout(() => document.getElementById('editUserName').focus(), 100);
    }

    function closeEditUserModal() {
        const modal = document.getElementById('editUserModal');
        if (modal) modal.classList.remove('show');
    }

    // Modal: Delete User
    function openDeleteUserModal(id, name, role) {
        const modal = document.getElementById('deleteUserModal');
        const form = document.getElementById('deleteUserForm');
        const nameSpan = document.getElementById('deleteUserNameSpan');
        if (!modal || !form) return;

        form.action = `/admin/users/${id}`;
        if (nameSpan) nameSpan.textContent = `${name} (${role.toUpperCase()})`;

        modal.classList.add('show');
    }

    function closeDeleteUserModal() {
        const modal = document.getElementById('deleteUserModal');
        if (modal) modal.classList.remove('show');
    }

    // Close modals on backdrop click
    window.addEventListener('click', function(e) {
        const pkgModal = document.getElementById('packageFormModal');
        const logoutModal = document.getElementById('logoutModal');
        const addUserModal = document.getElementById('addUserModal');
        const editUserModal = document.getElementById('editUserModal');
        const deleteUserModal = document.getElementById('deleteUserModal');

        if (e.target === pkgModal) closePackageModal();
        if (e.target === logoutModal) closeLogoutModal();
        if (e.target === addUserModal) closeAddUserModal();
        if (e.target === editUserModal) closeEditUserModal();
        if (e.target === deleteUserModal) closeDeleteUserModal();
    });

    // Close modals on Escape key
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePackageModal();
            closeLogoutModal();
            closeAddUserModal();
            closeEditUserModal();
            closeDeleteUserModal();
        }
    });
</script>

<!-- ==================== MODAL 1: TAMBAH ADMIN BARU ==================== -->
<div class="admin-modal-backdrop" id="addUserModal">
    <div class="admin-modal-box user-form-modal-box">
        <div class="admin-modal-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h3 class="admin-modal-title" style="margin: 0; font-size: 17px; font-weight: 700; color: #0f172a;">Tambah Admin Baru</h3>
                    <span style="font-size: 12px; color: #64748b;">Daftarkan akun administrator baru ke sistem Go Travel</span>
                </div>
            </div>
            <button type="button" class="admin-modal-close" onclick="closeAddUserModal()">&times;</button>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" id="addUserForm">
            @csrf
            <div class="modal-form-body" style="display: flex; flex-direction: column; gap: 14px;">
                <div class="form-group-item">
                    <label class="form-label" for="addUserName">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" id="addUserName" class="form-input-control" placeholder="Contoh: Budi Santoso" required>
                </div>

                <div class="form-group-item">
                    <label class="form-label" for="addUserEmail">Alamat Email <span style="color:#ef4444;">*</span></label>
                    <input type="email" name="email" id="addUserEmail" class="form-input-control" placeholder="admin@gotravel.com" required>
                </div>

                <div class="form-group-item">
                    <label class="form-label" for="addUserPassword">Password <span style="color:#ef4444;">*</span></label>
                    <input type="password" name="password" id="addUserPassword" class="form-input-control" placeholder="Minimal 6 karakter" minlength="6" required>
                </div>

                <div class="form-group-item">
                    <label class="form-label" for="addUserRole">Role Pengguna <span style="color:#ef4444;">*</span></label>
                    <select name="role" id="addUserRole" class="form-input-control" style="cursor: pointer;" required>
                        <option value="admin" selected>Admin (Hak Akses Penuh)</option>
                        <option value="user">User (Pengguna Biasa)</option>
                    </select>
                </div>
            </div>

            <div class="modal-actions-footer" style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                <button type="button" class="btn-modal-cancel" onclick="closeAddUserModal()">Batal</button>
                <button type="submit" class="btn-modal-submit-admin">
                    <i class="fa-solid fa-plus" style="margin-right: 6px;"></i> Simpan Admin Baru
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL 2: EDIT PENGGUNA ==================== -->
<div class="admin-modal-backdrop" id="editUserModal">
    <div class="admin-modal-box user-form-modal-box">
        <div class="admin-modal-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 38px; height: 38px; border-radius: 10px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
                <div>
                    <h3 class="admin-modal-title" style="margin: 0; font-size: 17px; font-weight: 700; color: #0f172a;">Edit Data Pengguna</h3>
                    <span style="font-size: 12px; color: #64748b;">Perbarui informasi akun, role, atau kata sandi</span>
                </div>
            </div>
            <button type="button" class="admin-modal-close" onclick="closeEditUserModal()">&times;</button>
        </div>

        <form action="" method="POST" id="editUserForm">
            @csrf
            @method('PUT')
            <input type="hidden" id="editUserId">

            <div class="modal-form-body" style="display: flex; flex-direction: column; gap: 14px;">
                <div class="form-group-item">
                    <label class="form-label" for="editUserName">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" id="editUserName" class="form-input-control" required>
                </div>

                <div class="form-group-item">
                    <label class="form-label" for="editUserEmail">Alamat Email <span style="color:#ef4444;">*</span></label>
                    <input type="email" name="email" id="editUserEmail" class="form-input-control" required>
                </div>

                <div class="form-group-item">
                    <label class="form-label" for="editUserPassword">Password Baru (Opsional)</label>
                    <input type="password" name="password" id="editUserPassword" class="form-input-control" placeholder="Biarkan kosong jika tidak ingin mengubah password" minlength="6">
                </div>

                <div class="form-group-item">
                    <label class="form-label" for="editUserRole">Role Pengguna <span style="color:#ef4444;">*</span></label>
                    <select name="role" id="editUserRole" class="form-input-control" style="cursor: pointer;" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>

            <div class="modal-actions-footer" style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                <button type="button" class="btn-modal-cancel" onclick="closeEditUserModal()">Batal</button>
                <button type="submit" class="btn-modal-submit-admin" style="background: #0284c7;">
                    <i class="fa-solid fa-floppy-disk" style="margin-right: 6px;"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL 3: KONFIRMASI HAPUS PENGGUNA ==================== -->
<div class="admin-modal-backdrop" id="deleteUserModal">
    <div class="admin-modal-box logout-modal-box">
        <div class="logout-icon-wrapper" style="background: #fee2e2; color: #dc2626;">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="logout-modal-title" style="color: #0f172a;">Hapus Pengguna</h3>
        <p class="logout-modal-desc" style="color: #64748b;">
            Apakah Anda yakin ingin menghapus pengguna <strong id="deleteUserNameSpan" style="color: #0f172a;"></strong>? Semua data dan hak akses terkait akun ini akan dihapus secara permanen.
        </p>

        <form action="" method="POST" id="deleteUserForm" style="margin: 0; width: 100%;">
            @csrf
            @method('DELETE')
            <div class="logout-actions-row">
                <button type="button" class="btn-modal-cancel" onclick="closeDeleteUserModal()">
                    Batal
                </button>
                <button type="submit" class="btn-modal-confirm-logout" style="background: #dc2626; border: none; cursor: pointer;">
                    <i class="fa-solid fa-trash-can"></i>
                    <span>Ya, Hapus</span>
                </button>
            </div>
        </form>
    </div>
</div>

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

<script>
    async function removeFromAdminWishlist(slug) {
        if (!confirm('Hapus paket ini dari Wishlist Anda?')) return;
        const card = document.getElementById('adminWishlistCard-' + slug);
        if (card) {
            card.style.opacity = '0.4';
            card.style.pointerEvents = 'none';
        }
        if (typeof toggleWishlist === 'function') {
            await toggleWishlist(null, slug);
            if (card) {
                card.style.transition = 'all 0.3s ease';
                card.style.transform = 'scale(0.8)';
                card.style.opacity = '0';
                setTimeout(() => {
                    card.remove();
                    const grid = document.getElementById('adminWishlistGrid');
                    const badge = document.getElementById('adminWishlistBadge');
                    if (grid) {
                        const remaining = grid.querySelectorAll('.wishlist-card').length;
                        if (badge) badge.textContent = `Total: ${remaining} Paket`;
                        if (remaining === 0) {
                            grid.innerHTML = `
                                <div id="adminWishlistEmptyState" style="text-align: center; padding: 48px 16px; color: #64748b; grid-column: 1 / -1;">
                                    <div style="width: 60px; height: 60px; border-radius: 50%; background: #fff2eb; color: #ea580c; display: inline-flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 14px;">
                                        <i class="fa-regular fa-heart"></i>
                                    </div>
                                    <h4 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Belum ada paket wisata di Wishlist</h4>
                                    <p style="margin: 0; font-size: 13.5px; color: #64748b; max-width: 400px; margin: 0 auto;">
                                        Klik ikon love pada paket wisata untuk menambahkannya ke daftar wishlist Anda.
                                    </p>
                                    <a href="/paket-wisata" class="btn-step-primary" style="display: inline-flex; margin-top: 18px; text-decoration: none; padding: 10px 24px; font-size: 13px;">
                                        <i class="fa-solid fa-compass" style="margin-right: 6px;"></i> Jelajahi Paket Wisata
                                    </a>
                                </div>
                            `;
                        }
                    }
                }, 300);
            }
        }
    }

    function openBuktiModal() {
        const img = document.getElementById('dtBuktiImage');
        if (img && document.getElementById('modalBuktiImg') && document.getElementById('buktiPhotoModal')) {
            document.getElementById('modalBuktiImg').src = img.src;
            document.getElementById('buktiPhotoModal').style.display = 'flex';
        }
    }
    function closeBuktiModal() {
        if (document.getElementById('buktiPhotoModal')) {
            document.getElementById('buktiPhotoModal').style.display = 'none';
        }
    }
</script>

<!-- Lightbox Modal untuk Bukti Pembayaran -->
<div class="admin-modal-backdrop" id="buktiPhotoModal" onclick="closeBuktiModal()" style="display: none; position: fixed; inset: 0; background: rgba(15,23,42,0.88); z-index: 99999; align-items: center; justify-content: center; backdrop-filter: blur(5px); padding: 20px;">
    <div style="position: relative; max-width: 90vw; max-height: 90vh; text-align: center;" onclick="event.stopPropagation()">
        <button type="button" onclick="closeBuktiModal()" style="position: absolute; top: -38px; right: 0; background: none; border: none; color: #fff; font-size: 32px; cursor: pointer; line-height: 1; padding: 4px;">&times;</button>
        <img id="modalBuktiImg" src="" alt="Bukti Transfer Penuh" style="max-width: 85vw; max-height: 82vh; border-radius: 12px; box-shadow: 0 15px 45px rgba(0,0,0,0.6); object-fit: contain; border: 2px solid rgba(255,255,255,0.15);">
        <div style="margin-top: 10px; color: #cbd5e1; font-size: 13px;">
            <i class="fa-solid fa-circle-check" style="color: #10b981;"></i> Foto Bukti Transfer Pemesanan
        </div>
    </div>
</div>
@endsection