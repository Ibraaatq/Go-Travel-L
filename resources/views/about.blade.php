@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('content')
    <div class="home-container">

        <!-- ==================== UPPER SECTION: HERO & TENTANG KAMI CARD ==================== -->
        <section class="about-upper-section">
            <!-- Tombol Panah Kembali -->
            <a href="{{ url('/') }}" class="hero-back-btn" title="Kembali ke Beranda" aria-label="Kembali ke Beranda">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="about-top-grid">
                <!-- Kolom Kiri: Teks Hero -->
                <div class="about-hero-left">
                    <span class="about-hero-subtitle">Tentang Kami</span>
                    <h1 class="about-hero-title">GO Travel</h1>
                    <h2 class="about-hero-tagline">Liburan nyaman, perjalanan tak terlupakan</h2>
                    <p class="about-hero-desc">
                        Kami adalah penyedia layanan perjalanan wisata yang berkomitmen memberikan pengalaman terbaik bagi setiap pelanggan dengan pelayanan profesional, armada nyaman, dan harga terjangkau.
                    </p>
                </div>

                <!-- Kolom Kanan: Card Tentang Kami -->
                <div class="about-top-card">
                    <div class="about-top-card-header-row">
                        <div class="about-top-card-text-col">
                            <h3 class="about-top-card-title">Tentang Kami</h3>
                            <p class="about-top-card-desc">
                                GO Travel hadir untuk menemani setiap perjalanan Anda menuju destinasi impian. Dengan pengalaman dan dedikasi, kami selalu mengutamakan kenyamanan, keamanan, dan kepuasan pelanggan. kami menyediakan berbagai pilihan paket wisata untuk perjalanan keluarga, teman, study tour, maupun rombongan.
                            </p>
                        </div>
                        <div class="about-top-card-image-box">
                            <img src="{{ asset('images/about-bus.jpg') }}" alt="Armada Bus GO Travel" class="about-top-card-image" loading="lazy">
                        </div>
                    </div>

                    <!-- Checklist Keunggulan -->
                    <ul class="about-checklist-list">
                        <li class="about-checklist-item">
                            <i class="fa-solid fa-circle-check about-checklist-icon"></i>
                            <span class="about-checklist-text">Melayani perjalanan wisata ke berbagai destinasi populer di Indonesia.</span>
                        </li>
                        <li class="about-checklist-item">
                            <i class="fa-solid fa-circle-check about-checklist-icon"></i>
                            <span class="about-checklist-text">Armada nyaman dan terawat dengan fasilitas terbaik.</span>
                        </li>
                        <li class="about-checklist-item">
                            <i class="fa-solid fa-circle-check about-checklist-icon"></i>
                            <span class="about-checklist-text">Harga bersahabat dengan pelayanan berkualitas.</span>
                        </li>
                        <li class="about-checklist-item">
                            <i class="fa-solid fa-circle-check about-checklist-icon"></i>
                            <span class="about-checklist-text">Tersedia Rekomendasi Berbagai Paket Wisata.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- ==================== LOWER SECTION: VISI MISI & SYARAT KETENTUAN ==================== -->
        <section class="about-bottom-panel">
            <div class="about-bottom-grid">
                <!-- Kolom Kiri: Visi & Misi -->
                <div class="about-visimisi-col">
                    <h3 class="about-section-heading">Visi Kami</h3>
                    <p class="about-visi-desc">
                        Menjadi penyedia layanan perjalanan wisata terpercaya di Indonesia dengan pelayanan terbaik dan pengalaman wisata yang berkesan.
                    </p>

                    <h3 class="about-section-heading">Misi Kami</h3>
                    <ul class="about-misi-list">
                        <li>Memberikan pelayanan yang ramah, profesional, dan terpercaya.</li>
                        <li>Menyediakan armada yang aman, nyaman, dan berkualitas.</li>
                        <li>Mengutamakan kepuasan pelanggan dalam setiap perjalanan.</li>
                    </ul>
                </div>

                <!-- Kolom Kanan: Syarat & Ketentuan -->
                <div class="about-terms-col">
                    <h3 class="about-section-heading">Syarat & Ketentuan</h3>

                    <div class="about-terms-grid">
                        <!-- Card 1: Pemesanan -->
                        <div class="terms-card">
                            <div class="terms-card-header">
                                <div class="terms-card-icon">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>
                                <h4 class="terms-card-title">Pemesanan</h4>
                            </div>
                            <p class="terms-card-desc">
                                Pemesanan dapat dilakukan maksimal H-1 sebelum tanggal keberangkatan melalui website GO Travel. Pastikan seluruh data pemesan dan peserta telah diisi dengan benar agar proses reservasi dapat diproses tanpa kendala.
                            </p>
                        </div>

                        <!-- Card 2: Pembayaran -->
                        <div class="terms-card">
                            <div class="terms-card-header">
                                <div class="terms-card-icon">
                                    <i class="fa-solid fa-credit-card"></i>
                                </div>
                                <h4 class="terms-card-title">Pembayaran</h4>
                            </div>
                            <p class="terms-card-desc">
                                Pemesanan akan dianggap berhasil setelah pembayaran dikonfirmasi sesuai metode pembayaran yang tersedia. Bukti pembayaran dapat diminta apabila diperlukan untuk proses verifikasi oleh pihak GO Travel.
                            </p>
                        </div>

                        <!-- Card 3: Pembatalan -->
                        <div class="terms-card">
                            <div class="terms-card-header">
                                <div class="terms-card-icon">
                                    <i class="fa-solid fa-xmark"></i>
                                </div>
                                <h4 class="terms-card-title">Pembatalan</h4>
                            </div>
                            <p class="terms-card-desc">
                                Pembatalan atau perubahan jadwal perjalanan dapat dilakukan sesuai dengan kebijakan GO Travel. Permohonan yang diajukan mendekati jadwal keberangkatan dapat dikenakan biaya administrasi atau ketentuan lain yang berlaku.
                            </p>
                        </div>

                        <!-- Card 4: Keberangkatan -->
                        <div class="terms-card">
                            <div class="terms-card-header">
                                <div class="terms-card-icon">
                                    <i class="fa-solid fa-bus"></i>
                                </div>
                                <h4 class="terms-card-title">Keberangkatan</h4>
                            </div>
                            <p class="terms-card-desc">
                                Penumpang diwajibkan hadir minimal 30 menit sebelum jadwal keberangkatan serta membawa bukti pemesanan yang telah diterima. Keterlambatan yang menyebabkan penumpang tertinggal menjadi tanggung jawab masing-masing.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
