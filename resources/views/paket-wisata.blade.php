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
    @php
        $countAll = $packages->count();
        $countJawa = $packages->filter(fn($p) => str_contains(strtolower(($p->kategori ?? '') . ' ' . ($p->destinasi ?? '')), 'jawa'))->count();
        $countBali = $packages->filter(fn($p) => str_contains(strtolower(($p->kategori ?? '') . ' ' . ($p->destinasi ?? '')), 'bali'))->count();
        $countSumatera = $packages->filter(fn($p) => str_contains(strtolower(($p->kategori ?? '') . ' ' . ($p->destinasi ?? '')), 'sumatera') || str_contains(strtolower(($p->kategori ?? '') . ' ' . ($p->destinasi ?? '')), 'lampung'))->count();
        $count1Hari = $packages->filter(fn($p) => str_contains(strtolower(($p->kategori ?? '') . ' ' . ($p->durasi ?? '')), '1hari') || str_contains(strtolower($p->durasi ?? ''), '1 hari'))->count();
        $countMenginap = $packages->filter(fn($p) => str_contains(strtolower(($p->kategori ?? '') . ' ' . ($p->durasi ?? '')), 'menginap') || str_contains(strtolower($p->durasi ?? ''), 'malam') || str_contains(strtolower($p->durasi ?? ''), '2 hari') || str_contains(strtolower($p->durasi ?? ''), '3 hari') || str_contains(strtolower($p->durasi ?? ''), '4 hari') || str_contains(strtolower($p->durasi ?? ''), '5 hari'))->count();
    @endphp

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
                    <a href="{{ route('destinasi') }}" class="btn-hero-outline">Jelajahi Destinasi</a>
                </div>
            </div>
        </section>

        <!-- ==================== SEARCH & FILTER BAR (gaya destinasi) ==================== -->
        <div class="filter-pill-bar destinasi-filter-bar paket-filter-bar" id="daftar-paket">
            <div class="filter-search-input-group destinasi-search-group">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="paketSearchInput" placeholder="Cari paket wisata atau lokasi..." aria-label="Cari paket wisata">
            </div>
            <div class="filter-category-dropdown destinasi-filter-dropdown">
                <button class="btn-filter-category btn-destinasi-filter" id="btnFilterCategory" type="button" aria-expanded="false">
                    <span id="selectedCategoryLabel">Filter Kategori</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="category-dropdown-menu destinasi-dropdown-menu" id="categoryDropdownMenu">
                    <a href="javascript:void(0)" class="dropdown-item active" data-category="all">Semua Kategori</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="jawa">Wisata Jawa</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="bali">Wisata Bali</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="sumatera">Wisata Sumatera</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="1hari">Wisata 1 Hari</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-category="menginap">Wisata Menginap</a>
                </div>
            </div>
        </div>

        <!-- Hasil filter info -->
        <div class="filter-status-row" id="filterStatusRow" style="max-width:1200px;margin:10px auto 0;padding:0 20px;">
            <div class="filter-results-info">
                Menampilkan <strong id="filterResultCount">{{ $countAll }}</strong> paket wisata
            </div>
        </div>

        <!-- ==================== DAFTAR PAKET WISATA (GRID) ==================== -->
        <section class="section-frosted-container paket-list-section">
            <div class="packages-grid paket-page-grid" id="paketGrid">

                @foreach($packages as $package)
                    <div class="package-card" 
                         data-slug="{{ $package->slug }}"
                         data-title="{{ strtolower($package->nama_paket) }} {{ strtolower($package->destinasi) }}" 
                         data-category="{{ strtolower($package->kategori) }}">
                        
                        <div class="package-image-container">
                            <img src="{{ $package->gambar_url }}" 
                                 alt="{{ $package->nama_paket }}"
                                 class="package-image" 
                                 loading="lazy">
                        </div>

                        <div class="package-content">
                            <div class="package-header-row">
                                <h3 class="package-name">{{ $package->nama_paket }}</h3>
                                <button class="wishlist-btn" type="button" aria-label="Simpan ke Wishlist" data-slug="{{ $package->slug }}">
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
                            </div>

                            <a href="{{ url('/paket-wisata/' . $package->slug) }}" class="btn-detail-pill">Lihat Detail</a>
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

    </div>

    <!-- ==================== SCRIPT FILTER, SEARCH, INTERAKTIF ==================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('paketSearchInput');
            const categoryBtn = document.getElementById('btnFilterCategory');
            const categoryMenu = document.getElementById('categoryDropdownMenu');
            const categoryItems = categoryMenu ? categoryMenu.querySelectorAll('.dropdown-item') : [];
            const selectedCategoryLabel = document.getElementById('selectedCategoryLabel');
            const cards = document.querySelectorAll('.package-card');
            const noMsg = document.getElementById('noPaketMessage');
            const btnReset = document.getElementById('btnResetFilter');
            const filterResultCount = document.getElementById('filterResultCount');

            let currentCategory = 'all';

            // Toggle Dropdown
            if (categoryBtn && categoryMenu) {
                categoryBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    categoryMenu.classList.toggle('show');
                });

                document.addEventListener('click', function (e) {
                    if (!categoryBtn.contains(e.target) && !categoryMenu.contains(e.target)) {
                        categoryMenu.classList.remove('show');
                    }
                });

                categoryItems.forEach(item => {
                    item.addEventListener('click', function (e) {
                        e.preventDefault();
                        categoryItems.forEach(i => i.classList.remove('active'));
                        this.classList.add('active');
                        currentCategory = this.getAttribute('data-category') || 'all';
                        if (selectedCategoryLabel) {
                            selectedCategoryLabel.textContent = this.textContent.trim();
                        }
                        categoryMenu.classList.remove('show');
                        filterPaket();
                    });
                });
            }

            // Search Filter
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    filterPaket();
                });
            }

            // Reset button
            if (btnReset) {
                btnReset.addEventListener('click', function () {
                    if (searchInput) searchInput.value = '';
                    currentCategory = 'all';
                    categoryItems.forEach(i => i.classList.remove('active'));
                    const allItem = categoryMenu ? categoryMenu.querySelector('[data-category="all"]') : null;
                    if (allItem) allItem.classList.add('active');
                    if (selectedCategoryLabel) selectedCategoryLabel.textContent = 'Filter Kategori';
                    filterPaket();
                });
            }

            function filterPaket() {
                const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
                let visibleCount = 0;

                cards.forEach(card => {
                    const title = (card.getAttribute('data-title') || '').toLowerCase();
                    const category = (card.getAttribute('data-category') || '').toLowerCase();

                    const matchesQuery = !query || title.includes(query);
                    const matchesCategory = currentCategory === 'all' || category.includes(currentCategory);

                    if (matchesQuery && matchesCategory) {
                        card.classList.remove('page-hidden');
                        card.classList.add('fade-in');
                        visibleCount++;
                    } else {
                        card.classList.add('page-hidden');
                        card.classList.remove('fade-in');
                    }
                });

                if (filterResultCount) filterResultCount.textContent = visibleCount;
                if (noMsg) noMsg.style.display = visibleCount === 0 ? 'block' : 'none';
            }

            // Inisialisasi awal
            filterPaket();
        });
    </script>
@endsection
