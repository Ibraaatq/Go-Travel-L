@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <style>
        .user-info-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
            margin-bottom: 24px;
        }
        .user-info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        .user-info-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }
        .user-info-table tr:last-child td {
            border-bottom: none;
        }
        .user-info-label {
            font-weight: 600;
            color: #64748b;
            width: 220px;
        }
        .user-info-val {
            font-weight: 700;
            color: #0f172a;
        }
        .user-notice-box {
            background: #fff8f4;
            border: 1px solid #ffd8c4;
            border-radius: 20px;
            padding: 20px 24px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
        }
        .user-notice-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff2eb;
            color: #ea580c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .user-notice-content h4 {
            font-size: 15px;
            font-weight: 700;
            color: #ea580c;
            margin-bottom: 4px;
        }
        .user-notice-content p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
            margin: 0;
        }
        .user-alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-left: 5px solid #ef4444;
            color: #b91c1c;
            padding: 14px 18px;
            border-radius: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 14px;
        }
        .user-alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 5px solid #16a34a;
            color: #15803d;
            padding: 14px 18px;
            border-radius: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            font-size: 14px;
        }
        .btn-user-logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 32px;
            background: #ef4444;
            color: #ffffff;
            border: none;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(239, 68, 68, 0.3);
            text-decoration: none;
        }
        .btn-user-logout:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
            color: #ffffff;
        }
        .user-role-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            background: #fff2eb;
            color: #ea580c;
            border-radius: 9999px;
            font-size: 11.5px;
            font-weight: 700;
            margin-top: 8px;
        }
        .user-role-badge.admin {
            background: #e0f2fe;
            color: #0369a1;
        }
    </style>
@endsection

@php
    // Data user diambil langsung dari MySQL oleh route /profile
    // Variabel $dbUser & $userOrders sudah di-inject dari routes/web.php
    $currentUser = $dbUser ?? null;
    $isAdmin = ($currentUser && $currentUser->role === 'admin');
@endphp

@section('content')
<div class="admin-page-wrapper">

    <!-- Top Action / Back Button & Mode Switcher -->
    <div class="admin-top-nav-row" style="justify-content: space-between;">
        <a href="{{ url('/') }}" class="admin-back-btn" title="Kembali ke Beranda" aria-label="Kembali ke Beranda">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 12.5px; color: #ffffff; font-weight: 600; text-shadow: 0 1px 3px rgba(0,0,0,0.5);">
                Tampilan: Profil Pengguna
            </span>
            
            {{-- TOMBOL MODE ADMIN HANYA MUNCUL JIKA USER BENAR-BENAR BERPERAN SEBAGAI ADMIN --}}
            @if($isAdmin)
                <a href="{{ url('/admin') }}" style="padding: 6px 14px; background: rgba(255,255,255,0.9); color: #0284c7; border-radius: 9999px; font-size: 12px; font-weight: 700; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#ffffff'" onmouseout="this.style.background='rgba(255,255,255,0.9)'">
                    <i class="fa-solid fa-user-shield"></i> Beralih ke Mode Admin
                </a>
            @endif
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
                        <img src="{{ session('user.avatar') }}" alt="{{ $currentUser->name ?? 'User' }}">
                    @else
                        <i class="fa-solid {{ $isAdmin ? 'fa-user-shield' : 'fa-user' }}"></i>
                    @endif
                </div>
                <h2 class="sidebar-user-name">
                    {{ $currentUser->name ?? 'Pengguna GO Travel' }}
                </h2>
                <p class="sidebar-user-email">
                    {{ $currentUser->email ?? 'user@gmail.com' }}
                </p>
                <div class="user-role-badge {{ $isAdmin ? 'admin' : '' }}">
                    <i class="fa-solid {{ $isAdmin ? 'fa-shield-halved' : 'fa-user' }}"></i> 
                    {{ $isAdmin ? 'Administrator' : 'Pengguna (User)' }}
                </div>
            </div>

            <!-- Sidebar Nav Menu -->
            <nav>
                <ul class="sidebar-nav-list">
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link active">
                            <i class="fa-solid fa-id-card"></i>
                            <span>Profil Saya</span>
                        </button>
                    </li>
                    @if($isAdmin)
                        <li class="sidebar-nav-item">
                            <a href="{{ url('/admin') }}" class="sidebar-nav-link" style="text-decoration: none;">
                                <i class="fa-solid fa-gauge-high"></i>
                                <span>Dashboard Admin</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-nav-item">
                        <button type="button" class="sidebar-nav-link nav-logout" onclick="openLogoutModal()">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- ==================== KOLOM KANAN: USER CONTENT ==================== -->
        <main class="admin-main-content">

            {{-- Flash Messages (Akses Ditolak / Berhasil) --}}
            @if(session('error'))
                <div class="user-alert-error">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size: 18px;"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if(session('success'))
                <div class="user-alert-success">
                    <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Welcome Header Card -->
            <div class="admin-section-card" style="background: linear-gradient(135deg, #fff2eb 0%, #ffffff 100%); border-color: #ffd8c4;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h2 class="admin-card-title" style="font-size: 22px; color: #ea580c; margin-bottom: 6px;">
                            Halo, {{ $currentUser->name ?? 'Pengguna' }}! 👋
                        </h2>
                        <p style="font-size: 13.5px; color: #64748b; margin: 0;">
                            Selamat datang di portal akun Anda. Informasi profil Anda ditampilkan langsung dari database.
                        </p>
                    </div>
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: #ea580c; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 4px 14px rgba(234, 88, 12, 0.3);">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>
            </div>

            <!-- Detailed Profile Information (Real Data from MySQL) -->
            <div class="user-info-card">
                <div class="admin-card-header" style="margin-bottom: 12px;">
                    <h3 class="admin-card-title">Detail Informasi Profil</h3>
                    <span class="badge-status completed" style="font-size: 12px;">
                        <i class="fa-solid fa-database" style="margin-right: 4px;"></i> Terhubung ke Database MySQL
                    </span>
                </div>

                <table class="user-info-table">
                    <tr>
                        <td class="user-info-label">Nama Pengguna</td>
                        <td class="user-info-val">{{ $currentUser->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Alamat Email</td>
                        <td class="user-info-val">{{ $currentUser->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="user-info-label">ID Akun (Database)</td>
                        <td class="user-info-val">#USR-{{ $currentUser->id ?? '1' }}</td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Tipe Akun / Role</td>
                        <td class="user-info-val">
                            <span style="padding: 3px 10px; background: {{ $isAdmin ? '#e0f2fe' : '#f1f5f9' }}; color: {{ $isAdmin ? '#0369a1' : '#475569' }}; border-radius: 8px; font-size: 12px; font-weight: 700;">
                                {{ ucfirst($currentUser->role ?? 'user') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Metode Autentikasi</td>
                        <td class="user-info-val" style="text-transform: capitalize;">
                            <i class="fa-solid fa-right-to-bracket" style="color: #ea580c; margin-right: 6px;"></i>
                            {{ session('user.provider', 'Local Database') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Terdaftar Sejak</td>
                        <td class="user-info-val">
                            {{ $currentUser && $currentUser->created_at ? $currentUser->created_at->translatedFormat('d F Y') : 'Aktif' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Status Akun</td>
                        <td class="user-info-val">
                            <span class="badge-status completed" style="font-size: 11.5px;">
                                <i class="fa-solid fa-circle-check" style="margin-right: 4px;"></i> Aktif
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- User Orders Table -->
            <div class="user-info-card">
                <div class="admin-card-header" style="margin-bottom: 12px;">
                    <h3 class="admin-card-title">Riwayat Pemesanan Saya</h3>
                    <span style="font-size: 12.5px; color: #64748b; font-weight: 600;">
                        Total: {{ $userOrders->count() }} Pesanan
                    </span>
                </div>

                @if($userOrders->count() > 0)
                    <div class="table-responsive-wrapper">
                        <table class="admin-orders-table">
                            <thead>
                                <tr>
                                    <th>Paket Wisata</th>
                                    <th>Tgl Keberangkatan</th>
                                    <th>Peserta</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userOrders as $ord)
                                    @php
                                        $st = strtolower($ord->status);
                                        $badgeCls = ($st === 'selesai' || $st === 'disetujui') ? 'completed' : 'pending';
                                        $label = ($st === 'selesai') ? 'Selesai' : (($st === 'disetujui') ? 'Disetujui' : 'Dipending');
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="table-text-main">{{ $ord->nama_paket }}</div>
                                            <div class="table-text-sub">{{ $ord->kota_keberangkatan }} • {{ $ord->titik_kumpul }}</div>
                                        </td>
                                        <td>{{ $ord->tanggal_keberangkatan }}</td>
                                        <td>{{ $ord->jumlah_peserta }} Orang</td>
                                        <td><strong>Rp. {{ number_format($ord->total_pembayaran, 0, ',', '.') }}</strong></td>
                                        <td><span class="badge-status {{ $badgeCls }}">{{ $label }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 28px 16px; color: #64748b;">
                        <i class="fa-solid fa-ticket" style="font-size: 32px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                        <p style="margin: 0; font-size: 13.5px;">Belum ada pesanan tiket yang terdaftar untuk akun ini.</p>
                        <a href="{{ url('/paket-wisata') }}" class="btn-step-primary" style="display: inline-flex; margin-top: 14px; text-decoration: none; padding: 10px 20px; font-size: 13px;">
                            Jelajahi Paket Wisata
                        </a>
                    </div>
                @endif
            </div>

            <!-- Action Area: Logout Pop-up Button -->
            <div class="admin-section-card" style="text-align: center; padding: 32px 24px;">
                <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">
                    Keluar Sesi Akun
                </h3>
                <p style="font-size: 13px; color: #64748b; margin-bottom: 20px;">
                    Klik tombol di bawah ini untuk membuka konfirmasi keluar akun.
                </p>
                <button type="button" class="btn-user-logout" onclick="openLogoutModal()">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar (Logout)</span>
                </button>
            </div>

        </main>

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
            Apakah Anda yakin ingin keluar dari akun GO Travel? Anda harus masuk kembali untuk mengakses portal layanan kami.
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

    window.addEventListener('click', function(e) {
        const logoutModal = document.getElementById('logoutModal');
        if (e.target === logoutModal) {
            closeLogoutModal();
        }
    });

    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLogoutModal();
        }
    });
</script>
@endsection
