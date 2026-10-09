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
            @if(session()->has('user'))
                <div class="user-profile-menu" style="position: relative;">
                    <a href="javascript:void(0)" class="nav-profile-btn logged-in {{ request()->is('profile*') || request()->is('dashboard*') || request()->is('admin*') ? 'active' : '' }}" id="userMenuToggle" style="display: flex; align-items: center; gap: 8px; text-decoration: none; cursor: pointer; padding: 6px 14px; background: #fff2eb; border-radius: 9999px; border: 1px solid #ffd8c4;">
                        @if(!empty(session('user.avatar')))
                            <img src="{{ session('user.avatar') }}" alt="{{ session('user.name') }}" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;">
                        @else
                            <i class="fa-regular fa-user" style="font-size: 14px; color: #ea580c;"></i>
                        @endif
                        <span style="font-size: 13.5px; font-weight: 700; color: #ea580c; max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{ session('user.name', 'Profil') }}
                        </span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 10px; color: #ea580c;"></i>
                    </a>
                    <div class="user-dropdown-popover" id="userDropdownMenu" style="display: none; position: absolute; top: calc(100% + 8px); right: 0; min-width: 200px; background: #ffffff; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 1px solid #f1f5f9; padding: 10px; z-index: 1000;">
                        <div style="padding: 6px 10px 10px 10px; border-bottom: 1px solid #f1f5f9;">
                            <div style="font-size: 13px; font-weight: 700; color: #0f172a; line-height: 1.2;">{{ session('user.name') }}</div>
                            <div style="font-size: 11px; color: #64748b; word-break: break-all;">{{ session('user.email') }}</div>
                        </div>
                        <a href="{{ url('/profile') }}" style="display: flex; align-items: center; gap: 8px; padding: 8px 10px; color: #ea580c; font-size: 13px; font-weight: 600; text-decoration: none; border-radius: 8px; margin-top: 6px; transition: background 0.2s;" onmouseover="this.style.background='#fff2eb'" onmouseout="this.style.background='transparent'">
                            <i class="{{ session('user.role') === 'user' ? 'fa-solid fa-clock-rotate-left' : 'fa-solid fa-gauge-high' }}"></i>
                            <span>{{ session('user.role') === 'user' ? 'Riwayat Pemesanan' : 'Dashboard Profil' }}</span>
                        </a>
                        <a href="{{ url('/logout') }}" onclick="if(typeof openLogoutModal === 'function'){ event.preventDefault(); openLogoutModal(); }" style="display: flex; align-items: center; gap: 8px; padding: 8px 10px; color: #ef4444; font-size: 12.5px; font-weight: 600; text-decoration: none; border-radius: 8px; margin-top: 2px; transition: background 0.2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Keluar (Logout)</span>
                        </a>
                    </div>
                </div>
            @else
                <a href="{{ url('/profile') }}" class="nav-profile-btn {{ request()->is('profile*') || request()->is('dashboard*') || request()->is('admin*') ? 'active' : '' }}">
                    <i class="fa-regular fa-user"></i>
                    <span>Profil</span>
                </a>
            @endif
            <!-- Mobile Toggle -->
            <button class="mobile-toggle-btn" id="mobileToggle" aria-label="Toggle Navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>
</header>
