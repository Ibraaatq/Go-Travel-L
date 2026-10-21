@extends('layouts.app')

@section('content')
<div class="home-container">

    <!-- ==================== HERO SECTION ==================== -->
    <section class="hero-section">
        <!-- Hero Main Content -->
        <div class="hero-content">
            <h1 class="hero-title">
                Perjalanan Nyaman, Bersama Bus<br>
                Pariwisata Terpercaya
            </h1>
            <p class="hero-description">
                Nikmati layanan sewa bus pariwisata yang aman, nyaman, dan profesional<br class="desktop-br">
                untuk wisata, study tour, outing kantor, hingga acara keluarga.
            </p>

            <div class="hero-action-buttons">
                <a href="{{ route('paket-wisata') }}" class="btn-hero-translucent">Lihat Paket Wisata</a>
                <a href="{{ route('destinasi') }}" class="btn-hero-outline">Jelajahi Destinasi</a>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION: KEUNGGULAN KAMI ==================== -->
    <section class="section-frosted-container" id="about">
        <h2 class="section-glass-header">Keunggulan Kami</h2>
        
        <div class="features-grid">
            <!-- Feature Card 1 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-bus"></i>
                </div>
                <h3 class="feature-title">Bus Nyaman & Bersih</h3>
                <p class="feature-description">
                    Armada terbaik dengan fasilitas lengkap untuk perjalanan Anda
                </p>
            </div>

            <!-- Feature Card 2 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <h3 class="feature-title">Harga Terjangkau</h3>
                <p class="feature-description">
                    Dapatkan harga terbaik dengan layanan berkualitas
                </p>
            </div>

            <!-- Feature Card 3 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-life-ring"></i>
                </div>
                <h3 class="feature-title">Driver Profesional</h3>
                <p class="feature-description">
                    Pengemudi berpengalaman dan ramah untuk perjalanan aman
                </p>
            </div>

            <!-- Feature Card 4 -->
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <h3 class="feature-title">Destinasi Menarik</h3>
                <p class="feature-description">
                    Berbagai pilihan destinasi wisata populer di seluruh Indonesia
                </p>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION: PAKET WISATA POPULER ==================== -->
    <section class="section-frosted-container" id="paket-wisata">
        <h2 class="section-glass-header">Paket Wisata Populer</h2>

        <div class="packages-grid">
            @if(isset($popularPackages) && count($popularPackages) > 0)
                @foreach($popularPackages as $package)
                    <!-- Package Card: {{ $package->nama_paket }} -->
                    <div class="package-card" data-slug="{{ $package->slug }}">
                        <div class="package-image-container">
                            <img src="{{ $package->gambar_url }}" alt="{{ $package->nama_paket }}" class="package-image" loading="lazy">
                            <span class="package-tag-badge">{{ $package->destinasi }}</span>
                        </div>
                        <div class="package-content">
                            <div class="package-header-row">
                                <h3 class="package-name" title="{{ $package->nama_paket }}">{{ $package->nama_paket }}</h3>
                                <button class="wishlist-btn" type="button" aria-label="Simpan ke Wishlist" onclick="toggleWishlist(this, '{{ $package->slug }}')">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>

                            <div class="package-meta-row">
                                <div class="meta-item">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>{{ $package->durasi }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fa-solid fa-users"></i>
                                    <span>Max 40 Orang</span>
                                </div>
                            </div>

                            <div class="package-price-section">
                                <span class="price-caption">Mulai dari</span>
                                <div class="price-amount-wrapper">
                                    <span class="price-value">{{ $package->formatted_harga }}</span>
                                    <span class="price-unit">/orang</span>
                                </div>
                            </div>

                            <div class="package-rating-stars">
                                @for($i = 0; $i < 5; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                <span class="rating-text-score">(5.0)</span>
                            </div>

                            <a href="{{ route('paket-wisata.show', $package->slug) }}" class="btn-detail-pill">
                                <span>Lihat Detail</span>
                                <i class="fa-solid fa-arrow-right-long btn-detail-arrow"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #fff;">
                    <p>Belum ada paket wisata yang tersedia.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ==================== SECTION: HUBUNGI KAMI ==================== -->
    <section class="section-contact-wrapper" id="contact">
        <div class="contact-two-columns">
            <!-- Left Column: Information & Services -->
            <div class="contact-left-col">
                <div class="contact-badge-header">
                    <span class="contact-badge-text">Hubungi Kami</span>
                    <div class="contact-badge-underline"></div>
                </div>

                <h2 class="contact-main-heading">
                    Kami Siap Membantu<br>
                    Perjalanan Anda
                </h2>

                <p class="contact-intro-desc">
                    Punya pertanyaan, butuh informasi paket, atau ingin booking untuk rombongan? Tim kami siap membantu memberikan solusi terbaik untuk perjalanan Anda.
                </p>

                <!-- 2x2 Services Grid -->
                <div class="contact-services-grid">
                    <!-- Service 1 -->
                    <div class="service-item">
                        <div class="service-icon-badge">
                            <i class="fa-solid fa-ticket"></i>
                        </div>
                        <div class="service-text-group">
                            <h4 class="service-title">Bantuan Reservasi</h4>
                            <p class="service-desc">
                                Kami membantu proses pemesanan, perubahan jadwal, hingga konfirmasi booking.
                            </p>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="service-item">
                        <div class="service-icon-badge">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>
                        <div class="service-text-group">
                            <h4 class="service-title">Respon Cepat</h4>
                            <p class="service-desc">
                                Tim customer service siap membantu melalui WhatsApp, telepon, maupun email.
                            </p>
                        </div>
                    </div>

                    <!-- Service 3 -->
                    <div class="service-item">
                        <div class="service-icon-badge">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </div>
                        <div class="service-text-group">
                            <h4 class="service-title">Custom Itinerary</h4>
                            <p class="service-desc">
                                Kami membantu menyusun itinerary sesuai tujuan dan durasi perjalanan.
                            </p>
                        </div>
                    </div>

                    <!-- Service 4 -->
                    <div class="service-item">
                        <div class="service-icon-badge">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="service-text-group">
                            <h4 class="service-title">Booking Rombongan</h4>
                            <p class="service-desc">
                                Melayani reservasi untuk sekolah, perusahaan, keluarga, maupun komunitas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Contact Form Card -->
            <div class="contact-right-col" id="booking-form">
                <div class="contact-form-card">
                    <h3 class="form-card-title">Hubungi Tim Kami</h3>
                    <p class="form-card-subtitle">
                        Isi formulir di bawah ini dan kami akan segera merespon Anda
                    </p>

                    <form id="contactForm" class="contact-form" action="{{ url('/contact') }}" method="POST" onsubmit="handleFormSubmit(event)">
                        @csrf
                        <div class="form-row-two-cols">
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor_telepon">Nomor Telepon</label>
                                <input type="tel" id="nomor_telepon" name="nomor_telepon" placeholder="Masukkan nomor telepon" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                        </div>

                        <div class="form-group">
                            <label for="pesan">Pesan</label>
                            <textarea id="pesan" name="pesan" rows="3" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>

                        <button type="submit" class="btn-submit-orange">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== SECTION: INFORMASI KONTAK ==================== -->
    <section class="section-contact-info-wrapper">
        <div class="contact-info-pill-card">
            <!-- Info 1: Alamat -->
            <div class="info-column-item">
                <div class="info-icon-badge">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <h4 class="info-col-title">Alamat Kantor</h4>
                <p class="info-col-text">
                    Jl. Salim Batubara No. 118,<br>
                    Kupang Teba, Kec. Teluk<br>
                    Betung Utara, Kota Bandar<br>
                    Lampung, Lampung 35212
                </p>
            </div>

            <!-- Info 2: Telepon/WA -->
            <div class="info-column-item">
                <div class="info-icon-badge">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <h4 class="info-col-title">Telepon/Whatsapp</h4>
                <p class="info-col-text">
                    +62 838-2138-2635<br>
                    +62 822-9445-0185<br>
                    +62 882-8600-4629<br>
                    +62 895-1037-9602
                </p>
            </div>

            <!-- Info 3: Email -->
            <div class="info-column-item">
                <div class="info-icon-badge">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h4 class="info-col-title">Email</h4>
                <p class="info-col-text">
                    gotravel@gmail.com
                </p>
            </div>

            <!-- Info 4: Jam Operasional -->
            <div class="info-column-item">
                <div class="info-icon-badge">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <h4 class="info-col-title">Jam Operasional</h4>
                <p class="info-col-text">
                    senin - minggu<br>
                    08.00 am - 08.00 pm
                </p>
            </div>
        </div>
    </section>

</div>
@endsection
