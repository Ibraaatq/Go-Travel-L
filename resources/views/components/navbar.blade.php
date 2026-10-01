<header class="navbar-wrapper">
    <nav class="navbar-pill-container">
        <!-- Logo Go Travel -->
        <a href="{{ url('/') }}" class="navbar-brand">
            <div class="brand-logo-badge">
                <i class="fa-solid fa-bus"></i>
            </div>
            <div class="brand-text-group">
                <span class="brand-title-go">GO</span>
                <span class="brand-subtitle-travel">Travel</span>
            </div>
        </a>

        <!-- Desktop Menu -->
        <ul class="navbar-nav-menu" id="navMenu">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/paket-wisata') }}" class="nav-link {{ request()->is('paket-wisata*') ? 'active' : '' }}">Paket Wisata</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/destinasi') }}" class="nav-link {{ request()->is('destinasi*') ? 'active' : '' }}">Destinasi</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about*') ? 'active' : '' }}">About</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/#contact') }}" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- Profil Button -->
        <div class="navbar-action-group">
            <a href="{{ url('/login') }}" class="nav-profile-btn {{ request()->is('login*') ? 'active' : '' }}">
                <i class="fa-regular fa-user"></i>
                <span>Profil</span>
            </a>
            <!-- Mobile Toggle -->
            <button class="mobile-toggle-btn" id="mobileToggle" aria-label="Toggle Navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>
</header>
