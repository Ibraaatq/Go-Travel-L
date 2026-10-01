@extends('layouts.app')

@section('content')
    <div class="home-container">

        <!-- ==================== HERO / HEADER SECTION ==================== -->
        <section class="hero-section">

            <!-- Hero Main Content with Back Button -->
            <div class="hero-content">
                <a href="{{ url('/') }}" class="hero-back-btn" title="Kembali ke Beranda"
                    aria-label="Kembali ke Beranda">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>

                <h1 class="hero-title">
                    Perjalanan Nyaman, Bersama Bus<br>
                    Pariwisata Terpercaya
                </h1>
                <p class="hero-description">
                    Nikmati layanan sewa bus pariwisata yang aman, nyaman, dan profesional<br class="desktop-br">
                    untuk wisata, study tour, outing kantor, hingga acara keluarga.
                </p>

                <div class="hero-action-buttons">
                    <a href="#daftar-paket" class="btn-hero-white">Lihat paket kami</a>
                    <a href="{{ url('/#destinasi') }}" class="btn-hero-outline">Jelajahi Destinasi</a>
                </div>
            </div>
        </section>

        <!-- ==================== SEARCH & FILTER BAR ==================== -->
        <div class="filter-pill-bar" id="daftar-paket">
            <div class="filter-search-input-group">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="paketSearchInput" placeholder="Search" aria-label="Cari paket wisata">
            </div>
            <div class="filter-category-dropdown">
                <button class="btn-filter-category" id="btnFilterCategory" type="button">
                    <span>Filter Kategori</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="category-dropdown-menu" id="categoryDropdownMenu">
                    <a href="#" class="dropdown-item active" data-category="all">Semua Kategori</a>
                    <a href="#" class="dropdown-item" data-category="jawa">Wisata Jawa</a>
                    <a href="#" class="dropdown-item" data-category="bali">Wisata Bali</a>
                    <a href="#" class="dropdown-item" data-category="sumatera">Wisata Sumatera</a>
                    <a href="#" class="dropdown-item" data-category="1hari">Durasi 1 Hari</a>
                    <a href="#" class="dropdown-item" data-category="menginap">Durasi Menginap</a>
                </div>
            </div>
        </div>

        <!-- ==================== DAFTAR PAKET WISATA (GRID) ==================== -->
        <section class="section-frosted-container paket-list-section">
            <div class="packages-grid paket-page-grid">

                <!-- Card 1: Tangkuban Perahu -->
                <div class="package-card" data-title="tangkuban perahu tour 1 hari" data-category="jawa 1hari">
                    <div class="package-image-container">
                        <img src="{{ asset('images/tangkuban.jpg') }}" alt="Tangkuban Perahu Tour 1 Hari"
                            class="package-image" loading="lazy">
                    </div>
                    <div class="package-content">
                        <div class="package-header-row">
                            <h3 class="package-name">Tangkuban Perahu Tour 1 Hari</h3>
                            <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <div class="package-meta-row">
                            <div class="meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span>1 Hari</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span>Max 40 Orang</span>
                            </div>
                        </div>

                        <div class="package-price-section">
                            <span class="price-caption">Mulai dari</span>
                            <div class="price-amount-wrapper">
                                <span class="price-value">Rp.200.000</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>

                        <div class="package-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <a href="{{ url('/paket-wisata/tangkuban-perahu') }}" class="btn-detail-pill">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 2: Jogja -->
                <div class="package-card" data-title="jogja tour 2 hari" data-category="jawa menginap">
                    <div class="package-image-container">
                        <img src="{{ asset('images/jogja.jpg') }}" alt="Jogja Tour 2 Hari" class="package-image"
                            loading="lazy">
                    </div>
                    <div class="package-content">
                        <div class="package-header-row">
                            <h3 class="package-name">Jogja Tour 2 Hari</h3>
                            <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <div class="package-meta-row">
                            <div class="meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span>5 Hari</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span>Max 40 Orang</span>
                            </div>
                        </div>

                        <div class="package-price-section">
                            <span class="price-caption">Mulai dari</span>
                            <div class="price-amount-wrapper">
                                <span class="price-value">Rp.2.200.000</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>

                        <div class="package-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <a href="{{ url('/paket-wisata/jogja') }}" class="btn-detail-pill">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 3: Malioboro -->
                <div class="package-card" data-title="malioboro tour 1 hari" data-category="jawa 1hari">
                    <div class="package-image-container">
                        <img src="{{ asset('images/malioboro.jpg') }}" alt="Malioboro Tour 1 Hari" class="package-image"
                            loading="lazy">
                    </div>
                    <div class="package-content">
                        <div class="package-header-row">
                            <h3 class="package-name">Malioboro Tour 1 Hari</h3>
                            <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <div class="package-meta-row">
                            <div class="meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span>1 Hari</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span>Max 40 Orang</span>
                            </div>
                        </div>

                        <div class="package-price-section">
                            <span class="price-caption">Mulai dari</span>
                            <div class="price-amount-wrapper">
                                <span class="price-value">Rp.249.000</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>

                        <div class="package-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <a href="{{ url('/paket-wisata/malioboro') }}" class="btn-detail-pill">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 4: Bromo -->
                <div class="package-card" data-title="bromo tour 1 hari" data-category="jawa 1hari">
                    <div class="package-image-container">
                        <img src="{{ asset('images/bromo.jpg') }}" alt="Bromo Tour 1 Hari" class="package-image"
                            loading="lazy">
                    </div>
                    <div class="package-content">
                        <div class="package-header-row">
                            <h3 class="package-name">Bromo Tour 1 Hari</h3>
                            <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <div class="package-meta-row">
                            <div class="meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span>1 Hari</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span>Max 40 Orang</span>
                            </div>
                        </div>

                        <div class="package-price-section">
                            <span class="price-caption">Mulai dari</span>
                            <div class="price-amount-wrapper">
                                <span class="price-value">Rp.499.000</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>

                        <div class="package-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <a href="{{ url('/paket-wisata/bromo') }}" class="btn-detail-pill">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 5: Pantai Pandawa -->
                <div class="package-card" data-title="pantai pandawa tour 1 hari" data-category="bali 1hari">
                    <div class="package-image-container">
                        <img src="{{ asset('images/pandawa.jpg') }}" alt="Pantai Pandawa Tour 1 Hari"
                            class="package-image" loading="lazy">
                    </div>
                    <div class="package-content">
                        <div class="package-header-row">
                            <h3 class="package-name">Pantai Pandawa Tour 1 Hari</h3>
                            <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <div class="package-meta-row">
                            <div class="meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span>1 Hari</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span>Max 40 Orang</span>
                            </div>
                        </div>

                        <div class="package-price-section">
                            <span class="price-caption">Mulai dari</span>
                            <div class="price-amount-wrapper">
                                <span class="price-value">Rp.175.000</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>

                        <div class="package-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <a href="{{ url('/paket-wisata/pantai-pandawa') }}" class="btn-detail-pill">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 6: Bandung -->
                <div class="package-card" data-title="bandung tour 4 hari" data-category="jawa menginap">
                    <div class="package-image-container">
                        <img src="{{ asset('images/bandung.jpg') }}" alt="Bandung Tour 4 Hari" class="package-image"
                            loading="lazy">
                    </div>
                    <div class="package-content">
                        <div class="package-header-row">
                            <h3 class="package-name">Bandung Tour 4 Hari</h3>
                            <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <div class="package-meta-row">
                            <div class="meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span>4 Hari</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span>Max 40 Orang</span>
                            </div>
                        </div>

                        <div class="package-price-section">
                            <span class="price-caption">Mulai dari</span>
                            <div class="price-amount-wrapper">
                                <span class="price-value">Rp.1.800.000</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>

                        <div class="package-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <a href="{{ url('/paket-wisata/bandung') }}" class="btn-detail-pill">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 7: Bali -->
                <div class="package-card" data-title="bali tour 5 hari" data-category="bali menginap">
                    <div class="package-image-container">
                        <img src="{{ asset('images/bali.jpg') }}" alt="Bali Tour 5 Hari" class="package-image"
                            loading="lazy">
                    </div>
                    <div class="package-content">
                        <div class="package-header-row">
                            <h3 class="package-name">Bali Tour 5 Hari</h3>
                            <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <div class="package-meta-row">
                            <div class="meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span>5 Hari</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span>Max 40 Orang</span>
                            </div>
                        </div>

                        <div class="package-price-section">
                            <span class="price-caption">Mulai dari</span>
                            <div class="price-amount-wrapper">
                                <span class="price-value">Rp.2.750.000</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>

                        <div class="package-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <a href="{{ url('/paket-wisata/bali') }}" class="btn-detail-pill">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 8: Lampung -->
                <div class="package-card" data-title="lampung tour 3 hari" data-category="sumatera menginap">
                    <div class="package-image-container">
                        <img src="{{ asset('images/lampung.jpg') }}" alt="Lampung Tour 3 Hari" class="package-image"
                            loading="lazy">
                    </div>
                    <div class="package-content">
                        <div class="package-header-row">
                            <h3 class="package-name">Lampung Tour 3 Hari</h3>
                            <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>

                        <div class="package-meta-row">
                            <div class="meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span>3 Hari</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span>Max 40 Orang</span>
                            </div>
                        </div>

                        <div class="package-price-section">
                            <span class="price-caption">Mulai dari</span>
                            <div class="price-amount-wrapper">
                                <span class="price-value">Rp.975.000</span>
                                <span class="price-unit">/orang</span>
                            </div>
                        </div>

                        <div class="package-rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <a href="{{ url('/paket-wisata/lampung') }}" class="btn-detail-pill">Lihat Detail</a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==================== PAGINATION ==================== -->
        <div class="paket-pagination">
            <span class="page-num active">1</span>
            <a href="#page-2" class="page-num">2</a>
            <a href="#page-3" class="page-num">3</a>
            <a href="#page-4" class="page-num">4</a>
            <a href="#page-5" class="page-num">5</a>
        </div>

    </div>
@endsection
