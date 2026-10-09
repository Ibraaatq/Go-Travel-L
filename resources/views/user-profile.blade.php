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
            background: #e0f2fe;
            color: #0369a1;
            border-radius: 9999px;
            font-size: 11.5px;
            font-weight: 700;
            margin-top: 8px;
        }
    </style>
@endsection

@section('content')
<div class="admin-page-wrapper">

    <!-- Top Action / Back Button & Mode Switcher -->
    <div class="admin-top-nav-row" style="justify-content: space-between;">
        <a href="{{ url('/') }}" class="admin-back-btn" title="Kembali ke Beranda" aria-label="Kembali ke Beranda">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 12.5px; color: #ffffff; font-weight: 600; text-shadow: 0 1px 3px rgba(0,0,0,0.5);">Tampilan: Profil User</span>
            <a href="{{ url('/admin') }}" style="padding: 6px 14px; background: rgba(255,255,255,0.9); color: #ea580c; border-radius: 9999px; font-size: 12px; font-weight: 700; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#ffffff'" onmouseout="this.style.background='rgba(255,255,255,0.9)'">
                <i class="fa-solid fa-user-shield"></i> Beralih ke Mode Admin
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
                    {{ session('user.name', 'Pengguna GO Travel') }}
                </h2>
                <p class="sidebar-user-email">
                    {{ session('user.email', 'user@gmail.com') }}
                </p>
                <div class="user-role-badge">
                    <i class="fa-solid fa-user"></i> Pengguna (User)
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

            <!-- Welcome Header Card -->
            <div class="admin-section-card" style="background: linear-gradient(135deg, #fff2eb 0%, #ffffff 100%); border-color: #ffd8c4;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h2 class="admin-card-title" style="font-size: 22px; color: #ea580c; margin-bottom: 6px;">
                            Halo, {{ session('user.name', 'Pengguna') }}! 👋
                        </h2>
                        <p style="font-size: 13.5px; color: #64748b; margin: 0;">
                            Selamat datang di portal akun Anda. Informasi profil Anda ditampilkan di bawah ini.
                        </p>
                    </div>
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: #ea580c; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 4px 14px rgba(234, 88, 12, 0.3);">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>
            </div>

            <!-- Notice Alert (Read-Only Info) -->
            <div class="user-notice-box">
                <div class="user-notice-icon">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="user-notice-content">
                    <h4>Informasi Hak Akses Profil</h4>
                    <p>
                        Halaman profil pengguna bersifat <strong>read-only</strong>. Pengguna tidak dapat menambah atau mengubah data profil maupun paket wisata. Perubahan data dan pengelolaan sistem sepenuhnya dikelola oleh <strong>Admin</strong>.
                    </p>
                </div>
            </div>

            <!-- Detailed Profile Information (Read-Only Table) -->
            <div class="user-info-card">
                <div class="admin-card-header" style="margin-bottom: 12px;">
                    <h3 class="admin-card-title">Detail Informasi Profil</h3>
                    <span class="badge-status confirmed" style="background: #e0f2fe; color: #0284c7; border-color: #bae6fd;">
                        <i class="fa-solid fa-shield-halved" style="margin-right: 4px;"></i> Akses Terverifikasi
                    </span>
                </div>

                <table class="user-info-table">
                    <tr>
                        <td class="user-info-label">Nama Pengguna</td>
                        <td class="user-info-val">{{ session('user.name', 'Pengguna GO Travel') }}</td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Alamat Email</td>
                        <td class="user-info-val">{{ session('user.email', 'user@gmail.com') }}</td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Metode Autentikasi</td>
                        <td class="user-info-val" style="text-transform: capitalize;">
                            <i class="fa-solid fa-right-to-bracket" style="color: #ea580c; margin-right: 6px;"></i>
                            {{ session('user.provider', 'Local Email') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Tipe Akun / Role</td>
                        <td class="user-info-val">
                            <span style="padding: 3px 10px; background: #f1f5f9; color: #475569; border-radius: 8px; font-size: 12px; font-weight: 700;">
                                User / Pengguna
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="user-info-label">Status Keanggotaan</td>
                        <td class="user-info-val">
                            <span class="badge-status completed" style="font-size: 11.5px;">
                                <i class="fa-solid fa-circle-check" style="margin-right: 4px;"></i> Aktif
                            </span>
                        </td>
                    </tr>
                </table>
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
