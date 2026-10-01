@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/destinasi.css') }}">
@endsection

@section('content')
    <div class="home-container">

        <!-- ==================== HERO SECTION DESTINASI ==================== -->
        <section class="hero-section hero-destinasi">
            <div class="hero-content hero-destinasi-content">
                <!-- Tombol Panah Kembali -->
                <a href="{{ url('/') }}" class="hero-back-btn" title="Kembali ke Beranda" aria-label="Kembali ke Beranda">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>

                <!-- Judul & Deskripsi -->
                <h1 class="hero-title hero-destinasi-title">
                    Destinasi Wisata
                </h1>
                <p class="hero-description hero-destinasi-desc">
                    Jelajahi berbagai destinasi menarik bersama GO Travel. Temukan tempat terbaik untuk liburan Anda.
                </p>
            </div>
        </section>

        <!-- ==================== SEARCH & FILTER BAR ==================== -->
        <div class="filter-pill-bar destinasi-filter-bar" id="daftar-destinasi">
            <div class="filter-search-input-group destinasi-search-group">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="destinasiSearchInput" placeholder="Search" aria-label="Cari destinasi wisata">
            </div>
            <div class="filter-category-dropdown destinasi-filter-dropdown">
                <button class="btn-filter-category btn-destinasi-filter" id="btnDestinasiCategory" type="button" aria-expanded="false">
                    <span id="selectedCategoryText">Filter Kategori</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="category-dropdown-menu destinasi-dropdown-menu" id="destinasiDropdownMenu">
                    <a href="javascript:void(0)" class="dropdown-item active" data-filter="all">Semua Kategori</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-filter="jawa">Wisata Jawa</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-filter="bali">Wisata Bali</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-filter="sumatera">Wisata Sumatera</a>
                    <a href="javascript:void(0)" class="dropdown-item" data-filter="populer">Destinasi Populer</a>
                </div>
            </div>
        </div>

        <!-- ==================== CONTAINER DAFTAR DESTINASI (FROSTED GLASS) ==================== -->
        <section class="section-frosted-container destinasi-frosted-container">
            <div class="destinasi-grid" id="destinasiGrid">

                @php
                    $list = isset($destinasiList) ? $destinasiList : \App\Http\Controllers\DestinasiController::getDestinasiData();
                @endphp

                @foreach($list as $key => $dest)
                    <div class="destinasi-card" data-city="{{ strtolower($dest['name']) }} {{ strtolower($dest['slug']) }}" data-category="{{ strtolower($dest['category']) }}">
                        <div class="destinasi-image-wrapper">
                            <img src="{{ asset($dest['image']) }}" alt="{{ $dest['name'] }}" class="destinasi-image" loading="lazy">
                        </div>
                        <div class="destinasi-content">
                            <h3 class="destinasi-title">{{ $dest['name'] }}</h3>
                            <p class="destinasi-desc">{{ $dest['description'] }}</p>
                            <div class="destinasi-footer">
                                <a href="{{ url('/destinasi/' . $dest['slug']) }}" class="btn-destinasi-arrow" title="Lihat paket wisata {{ $dest['name'] }}" aria-label="Lihat paket wisata {{ $dest['name'] }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pesan Jika Tidak Ditemukan -->
            <div id="noDestinasiMessage" style="display: none; text-align: center; padding: 40px 20px; color: #ffffff;">
                <i class="fa-solid fa-location-dot" style="font-size: 36px; color: rgba(255,255,255,0.6); margin-bottom: 12px; display: block;"></i>
                <h4 style="font-size: 18px; font-weight: 700; margin-bottom: 6px;">Destinasi Tidak Ditemukan</h4>
                <p style="font-size: 13px; color: rgba(255,255,255,0.8);">Coba gunakan kata kunci lain untuk mencari destinasi liburan Anda.</p>
            </div>
        </section>

    </div>

    <!-- ==================== SCRIPT FILTER & SEARCH INTERAKTIF ==================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('destinasiSearchInput');
            const categoryBtn = document.getElementById('btnDestinasiCategory');
            const categoryMenu = document.getElementById('destinasiDropdownMenu');
            const categoryItems = categoryMenu ? categoryMenu.querySelectorAll('.dropdown-item') : [];
            const selectedCategoryText = document.getElementById('selectedCategoryText');
            const cards = document.querySelectorAll('.destinasi-card');
            const noMsg = document.getElementById('noDestinasiMessage');

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
                        currentCategory = this.getAttribute('data-filter') || 'all';
                        if (selectedCategoryText) {
                            selectedCategoryText.textContent = this.textContent.trim();
                        }
                        categoryMenu.classList.remove('show');
                        filterDestinasi();
                    });
                });
            }

            // Search Filter
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    filterDestinasi();
                });
            }

            function filterDestinasi() {
                const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
                let visibleCount = 0;

                cards.forEach(card => {
                    const city = (card.getAttribute('data-city') || '').toLowerCase();
                    const title = (card.querySelector('.destinasi-title')?.textContent || '').toLowerCase();
                    const desc = (card.querySelector('.destinasi-desc')?.textContent || '').toLowerCase();
                    const category = (card.getAttribute('data-category') || '').toLowerCase();

                    const matchesQuery = !query || city.includes(query) || title.includes(query) || desc.includes(query);
                    const matchesCategory = currentCategory === 'all' || category.includes(currentCategory);

                    if (matchesQuery && matchesCategory) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (noMsg) {
                    noMsg.style.display = visibleCount === 0 ? 'block' : 'none';
                }
            }
        });
    </script>
@endsection
