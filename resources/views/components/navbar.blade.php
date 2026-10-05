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
                    <a href="javascript:void(0)" class="nav-profile-btn logged-in" id="userMenuToggle" style="display: flex; align-items: center; gap: 8px; text-decoration: none; cursor: pointer; padding: 4px 12px; background: #fff2eb; border-radius: 9999px; border: 1px solid #ffd8c4;">
                        @if(!empty(session('user.avatar')))
                            <img src="{{ session('user.avatar') }}" alt="{{ session('user.name') }}" style="width: 26px; height: 26px; border-radius: 50%; object-fit: cover;">
                        @else
                            <div style="width: 26px; height: 26px; border-radius: 50%; background: #ea580c; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">
                                {{ strtoupper(substr(session('user.name', 'U'), 0, 1)) }}
                            </div>
                        @endif
                        <span style="font-size: 13px; font-weight: 700; color: #ea580c; max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{ session('user.name') }}
                        </span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 10px; color: #ea580c;"></i>
                    </a>
                    <div class="user-dropdown-popover" id="userDropdownMenu" style="display: none; position: absolute; top: calc(100% + 8px); right: 0; min-width: 190px; background: #ffffff; border-radius: 14px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 1px solid #f1f5f9; padding: 8px; z-index: 1000;">
                        <div style="padding: 8px 10px; border-bottom: 1px solid #f1f5f9;">
                            <div style="font-size: 13px; font-weight: 700; color: #0f172a; line-height: 1.2;">{{ session('user.name') }}</div>
                            <div style="font-size: 11px; color: #64748b; word-break: break-all;">{{ session('user.email') }}</div>
                        </div>
                        <a href="{{ url('/logout') }}" style="display: flex; align-items: center; gap: 8px; padding: 8px 10px; color: #ef4444; font-size: 12.5px; font-weight: 600; text-decoration: none; border-radius: 8px; margin-top: 4px; transition: background 0.2s;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Keluar (Logout)</span>
                        </a>
                    </div>
                </div>
            @else
                <a href="{{ url('/login') }}" class="nav-profile-btn {{ request()->is('login*') ? 'active' : '' }}">
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
