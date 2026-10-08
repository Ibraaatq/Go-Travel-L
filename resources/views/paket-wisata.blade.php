@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/paket-wisata.css') }}">
<style>
    /* Transisi halus saat ganti halaman / filter */
    .package-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease, opacity 0.25s ease;
    }
    .package-card.page-hidden {
        display: none !important;
    }
    .package-card.fade-in {
        animation: fadeInCard 0.35s ease forwards;
    }
    @keyframes fadeInCard {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .wishlist-btn.active i {
        font-weight: 900;
        color: #ef4444;
    }
</style>
@endsection

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
                <button class="btn-filter-category" id="btnFilterCategory" type="button" aria-expanded="false">
                    <span id="selectedCategoryLabel">Filter Kategori</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="category-dropdown-menu" id="categoryDropdownMenu">
                    <a href="javascript:void(0)" class="dropdown-item active" data-category="all">Semua Kategori</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="jawa">Wisata Jawa</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="bali">Wisata Bali</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="sumatera">Wisata Sumatera</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="1hari">Durasi 1 Hari</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="menginap">Durasi Menginap</a>
                </div>
            </div>
        </div>

        <!-- ==================== DAFTAR PAKET WISATA (GRID) ==================== -->
        <section class="section-frosted-container paket-list-section">
            <div class="packages-grid paket-page-grid" id="paketGrid">

                @php
                    $packages = isset($allPackages) ? $allPackages : \App\Http\Controllers\PaketWisataController::getPaketData();
                    $activePage = isset($currentPage) ? (int)$currentPage : 1;
                @endphp

                @foreach($packages as $key => $pkg)
                    <div class="package-card" 
                         data-slug="{{ $pkg['slug'] }}"
                         data-page="{{ $pkg['page'] ?? 1 }}" 
                         data-title="{{ strtolower($pkg['name']) }} {{ strtolower($pkg['location']) }}" 
                         data-category="{{ strtolower($pkg['category']) }}">
                        
                        <div class="package-image-container">
                            <img src="{{ asset($pkg['image']) }}" 
                                 alt="{{ $pkg['name'] }}"
                                 class="package-image" 
                                 loading="lazy">
                        </div>

                        <div class="package-content">
                            <div class="package-header-row">
                                <h3 class="package-name">{{ $pkg['name'] }}</h3>
                                <button class="wishlist-btn" type="button" aria-label="Simpan ke Wishlist" data-slug="{{ $pkg['slug'] }}">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>

                            <div class="package-meta-row">
                                <div class="meta-item">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>{{ $pkg['duration'] }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fa-solid fa-users"></i>
                                    <span>{{ $pkg['max_people'] ?? 'Max 40 Orang' }}</span>
                                </div>
                            </div>

                            <div class="package-price-section">
                                <span class="price-caption">Mulai dari</span>
                                <div class="price-amount-wrapper">
                                    <span class="price-value">{{ $pkg['price'] }}</span>
                                    <span class="price-unit">/orang</span>
                                </div>
                            </div>

                            <div class="package-rating-stars">
                                @php
                                    $ratingCount = (isset($pkg['rating']) && $pkg['rating'] >= 5.0) ? 5 : (int)floor($pkg['rating'] ?? 5);
                                    if ($ratingCount < 4) $ratingCount = 4;
                                @endphp
                                @for($i = 0; $i < $ratingCount; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>

                            <a href="{{ url('/paket-wisata/' . $pkg['slug']) }}" class="btn-detail-pill">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pesan jika tidak ditemukan pencarian -->
            <div id="noPaketMessage" style="display: none; text-align: center; padding: 50px 20px; color: #ffffff;">
                <i class="fa-solid fa-bus" style="font-size: 42px; color: rgba(255,255,255,0.7); margin-bottom: 16px; display: block;"></i>
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 8px;">Paket Wisata Tidak Ditemukan</h3>
                <p style="font-size: 14px; color: rgba(255,255,255,0.85); max-width: 480px; margin: 0 auto;">
                    Tidak ada paket wisata yang cocok dengan pencarian atau filter yang dipilih. Silakan coba kata kunci lain atau pilih semua kategori.
                </p>
                <button type="button" id="btnResetFilter" style="margin-top: 18px; padding: 9px 22px; border-radius: 9999px; background: #ffffff; color: var(--primary-orange); border: none; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    Reset Pencarian
                </button>
            </div>
        </section>

        <!-- ==================== PAGINATION ==================== -->
        <div class="paket-pagination" id="paketPagination">
            <a href="javascript:void(0)" class="page-num {{ $activePage == 1 ? 'active' : '' }}" data-page="1">1</a>
            <a href="javascript:void(0)" class="page-num {{ $activePage == 2 ? 'active' : '' }}" data-page="2">2</a>
            <a href="javascript:void(0)" class="page-num {{ $activePage == 3 ? 'active' : '' }}" data-page="3">3</a>
        </div>

    </div>

    <!-- ==================== SCRIPT FILTER, SEARCH, PAGINASI INTERAKTIF ==================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('paketSearchInput');
            const categoryBtn = document.getElementById('btnFilterCategory');
            const categoryMenu = document.getElementById('categoryDropdownMenu');
            const categoryItems = categoryMenu ? categoryMenu.querySelectorAll('.dropdown-item') : [];
            const selectedCategoryLabel = document.getElementById('selectedCategoryLabel');
            const cards = document.querySelectorAll('.package-card');
            const paginationContainer = document.getElementById('paketPagination');
            const pageButtons = document.querySelectorAll('.paket-pagination .page-num');
            const noMsg = document.getElementById('noPaketMessage');
            const btnReset = document.getElementById('btnResetFilter');

            // Baca page awal dari URL atau attribute server
            const urlParams = new URLSearchParams(window.location.search);
            let currentPage = parseInt(urlParams.get('page')) || {{ $activePage }};
            if (currentPage < 1 || currentPage > 3) currentPage = 1;

            let currentCategory = 'all';
            let searchQuery = '';

            // Toggle Dropdown Filter Kategori
            if (categoryBtn && categoryMenu) {
                categoryBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const isShown = categoryMenu.classList.contains('show');
                    categoryMenu.classList.toggle('show', !isShown);
                    categoryBtn.setAttribute('aria-expanded', !isShown ? 'true' : 'false');
                });

                document.addEventListener('click', function (e) {
                    if (!categoryBtn.contains(e.target) && !categoryMenu.contains(e.target)) {
                        categoryMenu.classList.remove('show');
                        categoryBtn.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Klik item kategori
            categoryItems.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    categoryItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    currentCategory = this.getAttribute('data-category') || 'all';
                    if (selectedCategoryLabel) {
                        selectedCategoryLabel.textContent = this.textContent.trim();
                    }

                    if (categoryMenu) {
                        categoryMenu.classList.remove('show');
                    }

                    // Reset ke halaman 1 saat ganti kategori
                    currentPage = 1;
                    applyFilterAndPagination();
                });
            });

            // Input Search realtime
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    searchQuery = this.value.trim().toLowerCase();
                    // Reset ke halaman 1 saat mencari
                    currentPage = 1;
                    applyFilterAndPagination();
                });
            }

            // Reset Filter button
            if (btnReset) {
                btnReset.addEventListener('click', function() {
                    if (searchInput) searchInput.value = '';
                    searchQuery = '';
                    currentCategory = 'all';
                    if (selectedCategoryLabel) selectedCategoryLabel.textContent = 'Filter Kategori';
                    categoryItems.forEach(i => {
                        i.classList.toggle('active', i.getAttribute('data-category') === 'all');
                    });
                    currentPage = 1;
                    applyFilterAndPagination();
                });
            }

            // Klik Tombol Paginasi
            pageButtons.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetPage = parseInt(this.getAttribute('data-page'));
                    if (targetPage && targetPage !== currentPage) {
                        currentPage = targetPage;
                        applyFilterAndPagination(true);

                        // Smooth scroll ke bagian atas daftar paket
                        const targetElem = document.getElementById('daftar-paket');
                        if (targetElem) {
                            targetElem.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                });
            });

            // Fungsi Utama Filter dan Paginasi
            function applyFilterAndPagination(shouldScroll = false) {
                let matchingCards = [];

                // 1. Saring kartu berdasarkan pencarian & kategori
                cards.forEach(card => {
                    const cardTitle = card.getAttribute('data-title') || '';
                    const cardCategory = card.getAttribute('data-category') || '';
                    const cardPage = parseInt(card.getAttribute('data-page')) || 1;

                    let matchCat = (currentCategory === 'all') || cardCategory.includes(currentCategory);
                    let matchSearch = (searchQuery === '') || cardTitle.includes(searchQuery);

                    if (matchCat && matchSearch) {
                        matchingCards.push({ elem: card, originalPage: cardPage });
                    }
                });

                // 2. Jika ada query / filter tertentu, kita tampilkan hasil terfilter
                const isFilteredMode = (currentCategory !== 'all' || searchQuery !== '');

                if (isFilteredMode) {
                    // Dalam mode filter, tampilkan kartu yang cocok langsung (atau kelompokkan)
                    cards.forEach(card => {
                        card.classList.add('page-hidden');
                        card.classList.remove('fade-in');
                    });

                    if (matchingCards.length === 0) {
                        if (noMsg) noMsg.style.display = 'block';
                        if (paginationContainer) paginationContainer.style.display = 'none';
                    } else {
                        if (noMsg) noMsg.style.display = 'none';
                        if (paginationContainer) paginationContainer.style.display = 'none';

                        matchingCards.forEach(item => {
                            item.elem.classList.remove('page-hidden');
                            item.elem.classList.add('fade-in');
                        });
                    }
                } else {
                    // Mode Standar (Menampilkan 8 kartu per halaman: 1, 2, atau 3)
                    if (noMsg) noMsg.style.display = 'none';
                    if (paginationContainer) paginationContainer.style.display = 'flex';

                    cards.forEach(card => {
                        const pageNum = parseInt(card.getAttribute('data-page')) || 1;
                        if (pageNum === currentPage) {
                            card.classList.remove('page-hidden');
                            card.classList.add('fade-in');
                        } else {
                            card.classList.add('page-hidden');
                            card.classList.remove('fade-in');
                        }
                    });

                    // Update tombol aktif pagination
                    pageButtons.forEach(btn => {
                        const p = parseInt(btn.getAttribute('data-page'));
                        btn.classList.toggle('active', p === currentPage);
                    });

                    // Update URL browser tanpa reload
                    const newUrl = new URL(window.location);
                    if (currentPage === 1) {
                        newUrl.searchParams.delete('page');
                    } else {
                        newUrl.searchParams.set('page', currentPage);
                    }
                    window.history.replaceState({ page: currentPage }, '', newUrl);
                }
            }

            // Wishlist Toggle
            const wishlistButtons = document.querySelectorAll('.wishlist-btn');
            wishlistButtons.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.toggle('active');
                    const icon = this.querySelector('i');
                    if (this.classList.contains('active')) {
                        icon.classList.remove('fa-regular');
                        icon.classList.add('fa-solid');
                    } else {
                        icon.classList.remove('fa-solid');
                        icon.classList.add('fa-regular');
                    }
                });
            });

            // Jalankan inisialisasi awal
            applyFilterAndPagination();
        });
    </script>
@endsection
