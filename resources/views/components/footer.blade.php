<footer class="footer-wrapper">
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="brand-logo-badge">
                        <i class="fa-solid fa-bus"></i>
                    </div>
                    <div class="brand-text-group">
                        <span class="brand-title-go">GO</span>
                        <span class="brand-subtitle-travel" style="color: #ffffff;">Travel</span>
                    </div>
                </div>
                <p class="footer-desc">
                    Layanan sewa bus pariwisata terpercaya dengan armada nyaman, pengemudi profesional, dan rute wisata terlengkap di Indonesia.
                </p>
            </div>

            <div class="footer-links">
                <h4>Menu Navigasi</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ route('paket-wisata') }}">Paket Wisata</a></li>
                    <li><a href="{{ route('destinasi') }}">Destinasi</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Paket Populer</h4>
                <ul>
                    <li><a href="#paket-wisata">Jogja Tour 2 Hari</a></li>
                    <li><a href="#paket-wisata">Bandung Tour 2 Hari</a></li>
                    <li><a href="#paket-wisata">Bali Tour 2 Hari</a></li>
                    <li><a href="#paket-wisata">Lampung Tour 2 Hari</a></li>
                </ul>
            </div>

            <div class="footer-social">
                <h4>Ikuti Kami</h4>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Go Travel. All rights reserved. Bus Pariwisata Terpercaya Indonesia.</p>
        </div>
    </div>
</footer>
