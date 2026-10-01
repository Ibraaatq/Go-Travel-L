@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/destinasi.css') }}">
@endsection

@section('content')
    <div class="home-container">

        <!-- ==================== HERO SECTION DESTINASI DETAIL ==================== -->
        <section class="hero-section hero-destinasi">
            <div class="hero-content hero-destinasi-content">
                <!-- Tombol Panah Kembali -->
                <a href="{{ url('/destinasi') }}" class="hero-back-btn" title="Kembali ke Daftar Destinasi" aria-label="Kembali ke Daftar Destinasi">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>

                <!-- Judul & Deskripsi -->
                <h1 class="hero-title hero-destinasi-title">
                    Paket Wisata {{ $destinasi['name'] }}
                </h1>
                <p class="hero-description hero-destinasi-desc">
                    {{ $destinasi['description'] }}
                </p>
            </div>
        </section>

        @if(count($packages) > 0)
            <!-- ==================== SEARCH & FILTER BAR ==================== -->
            <div class="filter-pill-bar destinasi-filter-bar">
                <div class="filter-search-input-group destinasi-search-group">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="paketSearchInput" placeholder="Cari paket di {{ $destinasi['name'] }}" aria-label="Cari paket wisata">
                </div>
            </div>

            <!-- ==================== DAFTAR PAKET TERSEDIA ==================== -->
            <section class="section-frosted-container paket-list-section">
                <div class="packages-grid paket-page-grid" id="paketGrid">
                    @foreach($packages as $pkg)
                        <div class="package-card" data-title="{{ strtolower($pkg['name']) }}">
                            <div class="package-image-container">
                                <img src="{{ asset($pkg['image']) }}" alt="{{ $pkg['name'] }}" class="package-image" loading="lazy">
                            </div>
                            <div class="package-content">
                                <div class="package-header-row">
                                    <h3 class="package-name">{{ $pkg['name'] }}</h3>
                                    <button class="wishlist-btn" aria-label="Simpan ke Wishlist">
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
                                        <span>{{ $pkg['max_people'] }}</span>
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
                                    @for($i = 0; $i < floor($pkg['rating'] ?? 5); $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </div>

                                <a href="{{ url('/paket-wisata/' . $pkg['slug']) }}" class="btn-detail-pill">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @else
            <!-- ==================== STATE KOSONG (BELUM ADA PAKET) ==================== -->
            <section class="section-frosted-container destinasi-frosted-container" style="text-align: center; padding: 60px 24px;">
                <div style="max-width: 520px; margin: 0 auto; color: #ffffff;">
                    <div style="width: 72px; height: 72px; background: rgba(255, 255, 255, 0.16); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; border: 1px solid rgba(255, 255, 255, 0.3);">
                        <i class="fa-solid fa-map-location-dot" style="font-size: 32px; color: #ffefe5;"></i>
                    </div>

                    <h2 style="font-size: 24px; font-weight: 700; margin-bottom: 10px; text-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                        Belum Ada Paket Wisata
                    </h2>
                    
                    <p style="font-size: 14px; color: rgba(255, 255, 255, 0.88); line-height: 1.6; margin-bottom: 28px;">
                        Saat ini paket wisata untuk destinasi <strong>{{ $destinasi['name'] }}</strong> belum tersedia. Tim kami sedang menyiapkan pilihan rute dan paket terbaik untuk Anda.
                    </p>

                    <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                        <a href="{{ url('/destinasi') }}" class="btn-hero-white">
                            Lihat Destinasi Lain
                        </a>
                        <a href="{{ url('/paket-wisata') }}" class="btn-hero-outline">
                            Semua Paket Wisata
                        </a>
                    </div>
                </div>
            </section>
        @endif

    </div>

    @if(count($packages) > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('paketSearchInput');
                const cards = document.querySelectorAll('.package-card');

                if (searchInput) {
                    searchInput.addEventListener('input', function () {
                        const query = this.value.toLowerCase().trim();
                        cards.forEach(card => {
                            const title = (card.getAttribute('data-title') || '').toLowerCase();
                            if (!query || title.includes(query)) {
                                card.style.display = 'flex';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });
                }
            });
        </script>
    @endif
@endsection
