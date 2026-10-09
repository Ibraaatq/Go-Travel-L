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

    /* ==================== FILTER WRAPPER & DYNAMIC ENHANCEMENTS ==================== */
    .filter-wrapper-section {
        max-width: 1200px;
        margin: -24px auto 26px auto;
        padding: 0 20px;
        position: relative;
        z-index: 50;
    }

    .filter-pill-bar {
        background: #ffffff;
        border-radius: 9999px;
        padding: 6px 10px 6px 20px;
        min-height: 54px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(226, 232, 240, 0.9);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .filter-pill-bar:focus-within {
        border-color: #f97316;
        box-shadow: 0 12px 35px rgba(249, 115, 22, 0.15), 0 0 0 3px rgba(249, 115, 22, 0.12);
    }

    .filter-search-input-group {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        position: relative;
    }
    .filter-search-input-group i.fa-magnifying-glass {
        color: #94a3b8;
        font-size: 16px;
        transition: color 0.2s ease;
    }
    .filter-pill-bar:focus-within .filter-search-input-group i.fa-magnifying-glass {
        color: #ea580c;
    }
    .filter-search-input-group input {
        border: none;
        outline: none;
        width: 100%;
        font-family: inherit;
        font-size: 14.5px;
        font-weight: 500;
        color: #1e293b;
        background: transparent;
    }
    .filter-search-input-group input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }
    .btn-clear-search {
        background: #f1f5f9;
        border: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 11px;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0;
        flex-shrink: 0;
    }
    .btn-clear-search:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* Category Dropdown Button & Menu */
    .filter-category-dropdown {
        position: relative;
        flex-shrink: 0;
    }
    .btn-filter-category {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 600;
        color: #334155;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 9999px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    .btn-filter-category:hover,
    .btn-filter-category[aria-expanded="true"] {
        background: #fff7ed;
        color: #ea580c;
        border-color: #fdba74;
    }
    .btn-filter-category .caret-icon {
        font-size: 11px;
        color: #94a3b8;
        transition: transform 0.25s ease;
    }
    .btn-filter-category[aria-expanded="true"] .caret-icon {
        transform: rotate(180deg);
        color: #ea580c;
    }

    .category-dropdown-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: #ffffff;
        border-radius: 16px;
        padding: 8px;
        min-width: 230px;
        box-shadow: 0 16px 36px rgba(15, 23, 42, 0.16);
        z-index: 100;
        border: 1px solid #e2e8f0;
        list-style: none;
        backdrop-filter: blur(10px);
    }
    .category-dropdown-menu.show {
        display: block;
        animation: dropdownFadeIn 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .dropdown-section-title {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94a3b8;
        padding: 6px 12px 3px 12px;
    }
    .dropdown-divider {
        height: 1px;
        background: #f1f5f9;
        margin: 4px 6px;
    }
    .category-dropdown-menu .dropdown-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 9px 12px;
        font-size: 13px;
        color: #475569;
        text-decoration: none;
        font-weight: 500;
        border-radius: 10px;
        transition: all 0.18s ease;
    }
    .category-dropdown-menu .dropdown-item i {
        width: 18px;
        margin-right: 6px;
        color: #94a3b8;
        transition: color 0.18s ease;
    }
    .category-dropdown-menu .dropdown-item:hover {
        background: #fff7ed;
        color: #ea580c;
    }
    .category-dropdown-menu .dropdown-item:hover i {
        color: #ea580c;
    }
    .category-dropdown-menu .dropdown-item.active {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        color: #ffffff;
        font-weight: 600;
    }
    .category-dropdown-menu .dropdown-item.active i {
        color: #ffffff;
    }
    .category-badge-count {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #64748b;
    }
    .category-dropdown-menu .dropdown-item.active .category-badge-count {
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
    }

    /* Quick Filter Chips */
    .quick-filter-chips {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
        overflow-x: auto;
        padding: 4px 2px 8px 2px;
        scrollbar-width: thin;
        -webkit-overflow-scrolling: touch;
    }
    .quick-filter-chips::-webkit-scrollbar {
        height: 4px;
    }
    .quick-filter-chips::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.35);
        border-radius: 999px;
    }
    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 9999px;
        font-size: 12.5px;
        font-weight: 600;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.35);
        backdrop-filter: blur(8px);
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.22s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }
    .filter-chip:hover {
        background: rgba(255, 255, 255, 0.32);
        border-color: rgba(255, 255, 255, 0.6);
        transform: translateY(-1px);
    }
    .filter-chip.active {
        background: #ffffff;
        color: #ea580c;
        border-color: #ffffff;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        font-weight: 700;
    }
    .filter-chip.active i {
        color: #ea580c;
    }
    .filter-chip .chip-count {
        font-size: 11px;
        opacity: 0.9;
    }

    /* Filter Status Row */
    .filter-status-row {
        margin-top: 4px;
        padding: 0 4px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .filter-results-info {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.92);
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    .active-filter-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 3px 10px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.95);
        color: #ea580c;
        font-size: 11.5px;
        font-weight: 700;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        animation: fadeInBadge 0.2s ease forwards;
    }
    @keyframes fadeInBadge {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    .active-filter-badge button {
        background: transparent;
        border: none;
        color: #ea580c;
        cursor: pointer;
        padding: 0;
        display: inline-flex;
        align-items: center;
        font-size: 11px;
    }
    .active-filter-badge button:hover {
        color: #9a3412;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-wrapper-section {
            margin-top: -16px;
            padding: 0 16px;
        }
        .filter-pill-bar {
            flex-direction: row;
            padding: 6px 8px 6px 14px;
            min-height: 48px;
        }
        .filter-search-input-group input {
            font-size: 13.5px;
        }
        .btn-filter-category {
            padding: 7px 12px;
            font-size: 12.5px;
        }
        .category-dropdown-menu {
            right: 0;
            left: auto;
            min-width: 210px;
        }
        .filter-chip {
            padding: 6px 12px;
            font-size: 12px;
        }
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
        <div class="filter-wrapper-section" id="daftar-paket">
            <div class="filter-pill-bar">
                <div class="filter-search-input-group">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="paketSearchInput" placeholder="Cari paket wisata atau lokasi..." aria-label="Cari paket wisata">
                    <button type="button" id="btnClearSearch" class="btn-clear-search" style="display: none;" title="Hapus pencarian">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="filter-category-dropdown">
                    <button class="btn-filter-category" id="btnFilterCategory" type="button" aria-expanded="false">
                        <i class="fa-solid fa-sliders"></i>
                        <span id="selectedCategoryLabel">Semua Kategori</span>
                        <i class="fa-solid fa-chevron-down caret-icon"></i>
                    </button>
                    <div class="category-dropdown-menu" id="categoryDropdownMenu">
                        <a href="javascript:void(0)" class="dropdown-item active" data-category="all">
                            <span><i class="fa-solid fa-layer-group"></i> Semua Kategori</span>
                            <span class="category-badge-count" data-count-for="all">24</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-section-title">Destinasi</div>
                        <a href="javascript:void(0)" class="dropdown-item" data-category="jawa">
                            <span><i class="fa-solid fa-map-location-dot"></i> Wisata Jawa</span>
                            <span class="category-badge-count" data-count-for="jawa">0</span>
                        </a>
                        <a href="javascript:void(0)" class="dropdown-item" data-category="bali">
                            <span><i class="fa-solid fa-umbrella-beach"></i> Wisata Bali</span>
                            <span class="category-badge-count" data-count-for="bali">0</span>
                        </a>
                        <a href="javascript:void(0)" class="dropdown-item" data-category="sumatera">
                            <span><i class="fa-solid fa-mountain-sun"></i> Wisata Sumatera</span>
                            <span class="category-badge-count" data-count-for="sumatera">0</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-section-title">Durasi</div>
                        <a href="javascript:void(0)" class="dropdown-item" data-category="1hari">
                            <span><i class="fa-regular fa-clock"></i> Wisata 1 Hari</span>
                            <span class="category-badge-count" data-count-for="1hari">0</span>
                        </a>
                        <a href="javascript:void(0)" class="dropdown-item" data-category="menginap">
                            <span><i class="fa-solid fa-hotel"></i> Wisata Menginap</span>
                            <span class="category-badge-count" data-count-for="menginap">0</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Filter Chips / Pills (Horizontal Scrollable & Interactive) -->
            <div class="quick-filter-chips" id="quickFilterChips">
                <button type="button" class="filter-chip active" data-category="all">
                    <i class="fa-solid fa-border-all"></i> Semua (<span class="chip-count" data-count-for="all">24</span>)
                </button>
                <button type="button" class="filter-chip" data-category="jawa">
                    <i class="fa-solid fa-map-pin"></i> Jawa (<span class="chip-count" data-count-for="jawa">0</span>)
                </button>
                <button type="button" class="filter-chip" data-category="bali">
                    <i class="fa-solid fa-umbrella-beach"></i> Bali (<span class="chip-count" data-count-for="bali">0</span>)
                </button>
                <button type="button" class="filter-chip" data-category="sumatera">
                    <i class="fa-solid fa-mountain"></i> Sumatera (<span class="chip-count" data-count-for="sumatera">0</span>)
                </button>
                <button type="button" class="filter-chip" data-category="1hari">
                    <i class="fa-regular fa-sun"></i> 1 Hari (<span class="chip-count" data-count-for="1hari">0</span>)
                </button>
                <button type="button" class="filter-chip" data-category="menginap">
                    <i class="fa-solid fa-moon"></i> Menginap (<span class="chip-count" data-count-for="menginap">0</span>)
                </button>
            </div>

            <!-- Active Filter Status Indicator & Results Counter -->
            <div class="filter-status-row" id="filterStatusRow">
                <div class="filter-results-info">
                    Menampilkan <strong id="filterResultCount">24</strong> paket wisata
                    <span id="activeFilterBadge" class="active-filter-badge" style="display: none;">
                        <span id="activeFilterName">Kategori</span>
                        <button type="button" id="btnRemoveFilter" aria-label="Hapus filter">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </span>
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
            const btnClearSearch = document.getElementById('btnClearSearch');
            const categoryBtn = document.getElementById('btnFilterCategory');
            const categoryMenu = document.getElementById('categoryDropdownMenu');
            const categoryItems = categoryMenu ? categoryMenu.querySelectorAll('.dropdown-item') : [];
            const selectedCategoryLabel = document.getElementById('selectedCategoryLabel');
            const filterChips = document.querySelectorAll('.filter-chip');
            const cards = document.querySelectorAll('.package-card');
            const paginationContainer = document.getElementById('paketPagination');
            const pageButtons = document.querySelectorAll('.paket-pagination .page-num');
            const noMsg = document.getElementById('noPaketMessage');
            const btnReset = document.getElementById('btnResetFilter');
            const filterResultCount = document.getElementById('filterResultCount');
            const activeFilterBadge = document.getElementById('activeFilterBadge');
            const activeFilterName = document.getElementById('activeFilterName');
            const btnRemoveFilter = document.getElementById('btnRemoveFilter');

            // Category Labels Map for Display
            const categoryNames = {
                'all': 'Semua Kategori',
                'jawa': 'Wisata Jawa',
                'bali': 'Wisata Bali',
                'sumatera': 'Wisata Sumatera',
                '1hari': 'Durasi 1 Hari',
                'menginap': 'Durasi Menginap'
            };

            // Hitung jumlah paket per kategori secara dinamis
            function updateCategoryCounts() {
                const counts = {
                    'all': cards.length,
                    'jawa': 0,
                    'bali': 0,
                    'sumatera': 0,
                    '1hari': 0,
                    'menginap': 0
                };

                cards.forEach(card => {
                    const cat = (card.getAttribute('data-category') || '').toLowerCase();
                    if (cat.includes('jawa')) counts['jawa']++;
                    if (cat.includes('bali')) counts['bali']++;
                    if (cat.includes('sumatera')) counts['sumatera']++;
                    if (cat.includes('1hari')) counts['1hari']++;
                    if (cat.includes('menginap')) counts['menginap']++;
                });

                // Update angka badge di dropdown & quick chips
                document.querySelectorAll('[data-count-for]').forEach(el => {
                    const key = el.getAttribute('data-count-for');
                    if (counts[key] !== undefined) {
                        el.textContent = counts[key];
                    }
                });
            }

            updateCategoryCounts();

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

            // Set Active Category (tersinkron antara dropdown dan chips)
            function setCategory(catKey) {
                currentCategory = catKey || 'all';

                // Update Label Button
                if (selectedCategoryLabel) {
                    selectedCategoryLabel.textContent = categoryNames[currentCategory] || 'Filter Kategori';
                }

                // Update Active State di Dropdown
                categoryItems.forEach(item => {
                    item.classList.toggle('active', item.getAttribute('data-category') === currentCategory);
                });

                // Update Active State di Chips
                filterChips.forEach(chip => {
                    chip.classList.toggle('active', chip.getAttribute('data-category') === currentCategory);
                });

                // Update Active Filter Badge di Status Bar
                if (currentCategory !== 'all') {
                    if (activeFilterBadge) activeFilterBadge.style.display = 'inline-flex';
                    if (activeFilterName) activeFilterName.textContent = categoryNames[currentCategory] || currentCategory;
                } else {
                    if (activeFilterBadge) activeFilterBadge.style.display = 'none';
                }

                if (categoryMenu) {
                    categoryMenu.classList.remove('show');
                    if (categoryBtn) categoryBtn.setAttribute('aria-expanded', 'false');
                }

                // Reset page ke 1
                currentPage = 1;
                applyFilterAndPagination();
            }

            // Klik item kategori di Dropdown
            categoryItems.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const cat = this.getAttribute('data-category') || 'all';
                    setCategory(cat);
                });
            });

            // Klik tombol Chip Kategori
            filterChips.forEach(chip => {
                chip.addEventListener('click', function (e) {
                    e.preventDefault();
                    const cat = this.getAttribute('data-category') || 'all';
                    setCategory(cat);
                });
            });

            // Tombol Hapus Filter Aktif
            if (btnRemoveFilter) {
                btnRemoveFilter.addEventListener('click', function (e) {
                    e.preventDefault();
                    setCategory('all');
                });
            }

            // Input Search realtime dengan debounce halus
            let searchTimeout = null;
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const val = this.value.trim();
                    searchQuery = val.toLowerCase();

                    // Tampilkan / sembunyikan tombol clear search
                    if (btnClearSearch) {
                        btnClearSearch.style.display = val.length > 0 ? 'inline-flex' : 'none';
                    }

                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        currentPage = 1;
                        applyFilterAndPagination();
                    }, 120);
                });
            }

            // Clear search button
            if (btnClearSearch) {
                btnClearSearch.addEventListener('click', function () {
                    if (searchInput) {
                        searchInput.value = '';
                        searchQuery = '';
                        this.style.display = 'none';
                        searchInput.focus();
                        currentPage = 1;
                        applyFilterAndPagination();
                    }
                });
            }

            // Reset Filter All button
            if (btnReset) {
                btnReset.addEventListener('click', function() {
                    if (searchInput) searchInput.value = '';
                    if (btnClearSearch) btnClearSearch.style.display = 'none';
                    searchQuery = '';
                    setCategory('all');
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

                        // Smooth scroll ke daftar paket
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

                // Update counter teks hasil pencarian
                if (filterResultCount) {
                    filterResultCount.textContent = matchingCards.length;
                }

                // 2. Cek apakah sedang dalam mode filter atau default
                const isFilteredMode = (currentCategory !== 'all' || searchQuery !== '');

                if (isFilteredMode) {
                    // Sembunyikan semua kartu terlebih dahulu
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

                        matchingCards.forEach((item, index) => {
                            item.elem.classList.remove('page-hidden');
                            item.elem.classList.add('fade-in');
                            // Stagger animasi halus
                            item.elem.style.animationDelay = `${Math.min(index * 0.04, 0.4)}s`;
                        });
                    }
                } else {
                    // Mode Standar (Paginasi halaman 1, 2, atau 3)
                    if (noMsg) noMsg.style.display = 'none';
                    if (paginationContainer) paginationContainer.style.display = 'flex';

                    cards.forEach((card, index) => {
                        const pageNum = parseInt(card.getAttribute('data-page')) || 1;
                        if (pageNum === currentPage) {
                            card.classList.remove('page-hidden');
                            card.classList.add('fade-in');
                            card.style.animationDelay = `${(index % 8) * 0.04}s`;
                        } else {
                            card.classList.add('page-hidden');
                            card.classList.remove('fade-in');
                            card.style.animationDelay = '0s';
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

            // Inisialisasi awal
            applyFilterAndPagination();
        });
    </script>
@endsection
