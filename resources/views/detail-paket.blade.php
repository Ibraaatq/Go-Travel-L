@extends('layouts.app')

@section('content')
<div class="detail-page-container">

    <!-- ==================== TOP NAVIGATION / BACK BUTTON ==================== -->
    <div class="detail-top-nav">
        <a href="{{ url('/paket-wisata') }}" class="detail-back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Paket Wisata</span>
        </a>
        <div class="detail-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="{{ url('/paket-wisata') }}">Paket Wisata</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>{{ $paket['name'] }}</span>
        </div>
    </div>

    <!-- ==================== MAIN 2-COLUMN LAYOUT ==================== -->
    <div class="detail-layout-grid">

        <!-- ==================== LEFT COLUMN: INFORMASI PAKET ==================== -->
        <div class="detail-left-column">

            <!-- Card Utama Informasi Paket -->
            <div class="detail-white-card detail-main-info-card">
                
                <!-- Main Destination Image -->
                <div class="detail-image-wrapper">
                    <img src="{{ asset($paket['image']) }}" alt="{{ $paket['name'] }}" class="detail-hero-image">
                    <span class="detail-category-badge">{{ strtoupper($paket['duration']) }}</span>
                </div>

                <div class="detail-info-header">
                    <div class="detail-header-top">
                        <h1 class="detail-title">{{ $paket['name'] }}</h1>
                        <button class="wishlist-btn detail-wishlist-btn" aria-label="Simpan ke Wishlist">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                    </div>

                    <!-- Rating & Reviews -->
                    <div class="detail-rating-row">
                        <div class="stars-group">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <span class="rating-score">{{ $paket['rating'] }}</span>
                        <span class="reviews-count">({{ $paket['reviews_count'] }} ulasan wisatawan)</span>
                    </div>

                    <!-- Quick Meta Badges -->
                    <div class="detail-badges-row">
                        <div class="detail-meta-badge">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>{{ $paket['location'] }}</span>
                        </div>
                        <div class="detail-meta-badge">
                            <i class="fa-regular fa-clock"></i>
                            <span>{{ $paket['duration'] }}</span>
                        </div>
                        <div class="detail-meta-badge">
                            <i class="fa-solid fa-users"></i>
                            <span>{{ $paket['max_people'] }}</span>
                        </div>
                    </div>

                    <!-- Price Block -->
                    <div class="detail-price-banner">
                        <div class="price-text-col">
                            <span class="price-start-label">Harga Mulai dari</span>
                            <div class="price-display-wrapper">
                                <span class="price-main-value">{{ $paket['price'] }}</span>
                                <span class="price-per-person">/ orang (All-in)</span>
                            </div>
                        </div>
                        <div class="price-guarantee-badge">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Harga Terjangkau & Transparan</span>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="detail-description-box">
                        <h3 class="detail-section-subtitle">Tentang Paket Ini</h3>
                        <p class="detail-desc-text">{{ $paket['description'] }}</p>
                    </div>

                    <!-- Highlight Destinasi Utama -->
                    <div class="detail-highlights-box">
                        <h3 class="detail-section-subtitle">Destinasi Utama yang Dikunjungi</h3>
                        <div class="highlights-grid">
                            @foreach($paket['highlights'] as $hl)
                                <div class="highlight-item">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>{{ $hl }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Fasilitas Mini Cards (4 Box) -->
                <div class="detail-mini-facilities">
                    <h3 class="detail-section-subtitle">Fasilitas Utama</h3>
                    <div class="mini-facilities-grid">
                        @foreach($paket['facilities'] as $fac)
                            <div class="mini-facility-card">
                                <div class="mini-fac-icon">
                                    <i class="{{ $fac['icon'] }}"></i>
                                </div>
                                <div class="mini-fac-text">
                                    <span class="mini-fac-title">{{ $fac['title'] }}</span>
                                    <span class="mini-fac-desc">{{ $fac['desc'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Card: Fasilitas yang Termasuk & Tidak Termasuk (Ukuran Penuh Seperti Awal) -->
            <div class="detail-white-card detail-features-card">
                <h2 class="detail-card-heading">
                    <i class="fa-solid fa-list-check"></i>
                    Fasilitas & Layanan
                </h2>

                <div class="inclusion-exclusion-grid">
                    <!-- Termasuk -->
                    <div class="inc-box inc-positive">
                        <h4 class="inc-box-title">
                            <i class="fa-solid fa-check text-green"></i>
                            Fasilitas yang Termasuk
                        </h4>
                        <ul class="inc-list">
                            @foreach($paket['inclusions'] as $item)
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Tidak Termasuk -->
                    <div class="inc-box inc-negative">
                        <h4 class="inc-box-title">
                            <i class="fa-solid fa-xmark text-red"></i>
                            Tidak Termasuk
                        </h4>
                        <ul class="exc-list">
                            @foreach($paket['exclusions'] as $item)
                                <li>
                                    <i class="fa-solid fa-xmark"></i>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <!-- ==================== RIGHT COLUMN: ITINERARY, CHECKOUT & INFORMASI TAMBAHAN ==================== -->
        <div class="detail-right-column">
            
            <div class="detail-sidebar-sticky">

                <!-- Card Itinerary Perjalanan -->
                <div class="detail-white-card detail-itinerary-card">
                    <div class="itinerary-header">
                        <div class="itinerary-header-badge">
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <div>
                            <h3 class="itinerary-title">Itinerary Perjalanan</h3>
                            <span class="itinerary-subtitle">Rencana rute dan jadwal aktivitas</span>
                        </div>
                    </div>

                    <div class="itinerary-days-container">
                        @foreach($paket['itinerary'] as $dayIndex => $dayData)
                            <div class="itinerary-day-block">
                                <div class="itinerary-day-badge">
                                    <span class="day-num-tag">{{ $dayData['day'] }}</span>
                                    <span class="day-title-text">{{ $dayData['title'] }}</span>
                                </div>

                                <div class="itinerary-timeline">
                                    @foreach($dayData['schedules'] as $sch)
                                        <div class="timeline-event">
                                            <div class="timeline-dot"></div>
                                            <div class="timeline-content">
                                                <span class="timeline-time">{{ $sch['time'] }}</span>
                                                <p class="timeline-desc">{{ $sch['activity'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Card Checkout & Booking (Pesan Paket Wisata) -->
                <div class="detail-white-card detail-checkout-card">
                    <h3 class="checkout-card-title">Pesan Paket Wisata</h3>
                    <p class="checkout-card-desc">Konfirmasi pemesanan cepat via WhatsApp atau formulir reservasi resmi.</p>

                    <div class="checkout-price-row">
                        <div>
                            <span class="checkout-price-label">Total Mulai Dari</span>
                            <span class="checkout-price-val">{{ $paket['price'] }}</span>
                        </div>
                        <span class="checkout-tax-badge">Termasuk Pajak</span>
                    </div>

                    <!-- Tombol Checkout -->
                    <a href="{{ url('/checkout/' . $paket['slug']) }}" class="btn-checkout-orange" id="btnCheckout">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Checkout / Pesan Sekarang</span>
                    </a>

                    <a href="{{ url('/#contact') }}" class="btn-consult-outline">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span>Konsultasi Rombongan</span>
                    </a>

                    <div class="checkout-guarantee-note">
                        <i class="fa-solid fa-lock"></i>
                        <span>Pemesanan aman & dilayani oleh customer support 24/7</span>
                    </div>
                </div>

                <!-- Card: Informasi Penting & Ketentuan (Di Bawah Pesan Paket Wisata) -->
                <div class="detail-white-card detail-important-card">
                    <h2 class="detail-card-heading">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Informasi Penting
                    </h2>
                    <div class="important-info-list">
                        @foreach($paket['important_info'] as $info)
                            <div class="important-info-item">
                                <i class="fa-solid fa-bell"></i>
                                <p>{{ $info }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Card: Informasi Perjalanan & Armada (Di Bawah Informasi Penting) -->
                <div class="detail-white-card detail-travel-info-card">
                    <h2 class="detail-card-heading">
                        <i class="fa-solid fa-bus-simple"></i>
                        Informasi Perjalanan & Armada
                    </h2>
                    <div class="travel-info-details">
                        <div class="travel-info-point">
                            <div class="point-icon"><i class="fa-solid fa-map-pin"></i></div>
                            <div class="point-content">
                                <strong>Titik Kumpul (Meeting Point)</strong>
                                <p>Penjemputan fleksibel di area kota atau stasiun/bandara yang disepakati sesuai reservasi rombongan.</p>
                            </div>
                        </div>
                        <div class="point-point-divider"></div>
                        <div class="travel-info-point">
                            <div class="point-icon"><i class="fa-solid fa-shield-virus"></i></div>
                            <div class="point-content">
                                <strong>Standar Keselamatan & Kenyamanan</strong>
                                <p>Armada bus dirawat berkala, full AC, driver berlisensi resmi dan berpengalaman di rute pariwisata.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
