<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GO Travel</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Login CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="auth-page-body">
    <!-- Blurred Background with Overlay -->
    <div class="auth-bg-overlay"></div>

    <!-- Main Login Card Container -->
    <div class="login-card-container">

        <!-- ==================== KOLOM KIRI: BANNER BROMO ==================== -->
        <div class="login-banner-col">
            <div class="login-banner-overlay"></div>
            <div class="login-banner-content">
                <h2 class="login-banner-title">
                    Explore More<br>
                    Travel Better
                </h2>
                <p class="login-banner-subtitle">
                    Setiap perjalanan dimulai dengan satu langkah. Temukan destinasi impianmu di sini.
                </p>
            </div>
        </div>

        <!-- ==================== KOLOM KANAN: FORM LOGIN ==================== -->
        <div class="login-form-col">
            <!-- Header Text -->
            <div class="login-header-group">
                <h1 class="login-main-title">Welcome to GO TRAVEL</h1>
                <p class="login-main-subtitle">
                    Silakan masuk ke akun milikmu untuk menikmati layanan terbaik dari kami.
                </p>
            </div>

            <!-- Tab Switcher (Login / Register) -->
            <div class="auth-tab-pill">
                <a href="{{ url('/login') }}" class="auth-tab-btn active" id="tabLogin">Login</a>
                <a href="{{ url('/register') }}" class="auth-tab-btn" id="tabRegister">Register</a>
            </div>

            <!-- Form Login -->
            <form action="{{ url('/login') }}" method="POST" id="loginForm">
                @csrf
                
                <!-- Email Field -->
                <div class="auth-form-group">
                    <label for="email" class="auth-label">Email</label>
                    <div class="auth-input-wrapper">
                        <input type="email" id="email" name="email" class="auth-input" placeholder="Enter your email" required autofocus>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="auth-form-group">
                    <label for="password" class="auth-label">Password</label>
                    <div class="auth-input-wrapper">
                        <input type="password" id="password" name="password" class="auth-input auth-input-password" placeholder="Enter your password" required>
                        <button type="button" class="auth-password-toggle" id="togglePassword" aria-label="Toggle password visibility">
                            <i class="fa-regular fa-eye-slash" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Lupa Password -->
                <div class="auth-remember-row">
                    <label class="auth-remember-label">
                        <input type="checkbox" name="remember" id="rememberMe">
                        <span>Remember me</span>
                    </label>
                    <a href="javascript:void(0)" class="auth-forgot-link">Lupa Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-auth-submit">
                    Login
                </button>
            </form>

            <!-- Divider -->
            <div class="auth-divider">
                <span>Or login with</span>
            </div>

            <!-- Social Login Buttons -->
            <div class="auth-social-group">
                <!-- Google Button (Opens Account Chooser Modal) -->
                <button type="button" class="btn-social-auth btn-trigger-google-modal" id="btnLoginGoogle">
                    <svg class="social-google-icon" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.98 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    <span>Google</span>
                </button>

                <!-- Facebook Button -->
                <a href="{{ route('auth.facebook') }}" class="btn-social-auth" id="btnLoginFacebook">
                    <i class="fa-brands fa-facebook social-facebook-icon"></i>
                    <span>Facebook</span>
                </a>
            </div>

        </div>
    </div>

    <!-- Google Account Chooser Modal -->
    @include('components.google-account-modal')

    <!-- Interactive Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Password Visibility Toggle
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (togglePassword && passwordInput && toggleIcon) {
                togglePassword.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'text') {
                        toggleIcon.classList.remove('fa-eye-slash');
                        toggleIcon.classList.add('fa-eye');
                    } else {
                        toggleIcon.classList.remove('fa-eye');
                        toggleIcon.classList.add('fa-eye-slash');
                    }
                });
            }

            // Google Account Chooser Modal Handler
            const googleModal = document.getElementById('googleAccountModal');
            const btnOpenGoogle = document.getElementById('btnLoginGoogle');
            const btnCloseGoogle = document.getElementById('closeGoogleModal');
            const listView = document.getElementById('googleAccountsListView');
            const customView = document.getElementById('googleCustomAccountView');
            const loadingView = document.getElementById('googleLoadingView');
            const btnUseAnother = document.getElementById('btnUseAnotherGoogleAccount');
            const btnBackToList = document.getElementById('btnBackToAccountList');
            const customForm = document.getElementById('googleCustomForm');
            const hiddenForm = document.getElementById('googleAuthSubmitForm');
            const hiddenName = document.getElementById('hiddenGoogleName');
            const hiddenEmail = document.getElementById('hiddenGoogleEmail');
            const hiddenAvatar = document.getElementById('hiddenGoogleAvatar');
            const loadingText = document.getElementById('googleLoadingText');

            function openModal() {
                if (googleModal) {
                    listView.style.display = 'block';
                    customView.style.display = 'none';
                    loadingView.style.display = 'none';
                    googleModal.classList.add('show');
                    googleModal.setAttribute('aria-hidden', 'false');
                }
            }

            function closeModal() {
                if (googleModal) {
                    googleModal.classList.remove('show');
                    googleModal.setAttribute('aria-hidden', 'true');
                }
            }

            if (btnOpenGoogle) {
                btnOpenGoogle.addEventListener('click', openModal);
            }

            if (btnCloseGoogle) {
                btnCloseGoogle.addEventListener('click', closeModal);
            }

            if (googleModal) {
                googleModal.addEventListener('click', function (e) {
                    if (e.target === googleModal) {
                        closeModal();
                    }
                });
            }

            // Switch to custom account input form
            if (btnUseAnother) {
                btnUseAnother.addEventListener('click', function () {
                    listView.style.display = 'none';
                    customView.style.display = 'block';
                    document.getElementById('customGoogleName').focus();
                });
            }

            // Back to list view
            if (btnBackToList) {
                btnBackToList.addEventListener('click', function () {
                    customView.style.display = 'none';
                    listView.style.display = 'block';
                });
            }

            // Account selection process
            function selectGoogleAccount(name, email, avatar) {
                listView.style.display = 'none';
                customView.style.display = 'none';
                loadingView.style.display = 'flex';
                loadingText.innerText = 'Masuk sebagai ' + name + '...';

                hiddenName.value = name;
                hiddenEmail.value = email;
                hiddenAvatar.value = avatar || '';

                setTimeout(function () {
                    hiddenForm.submit();
                }, 800);
            }

            // Attach click to account list items
            const accountButtons = document.querySelectorAll('.google-account-item:not(#btnUseAnotherGoogleAccount)');
            accountButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const name = this.getAttribute('data-name');
                    const email = this.getAttribute('data-email');
                    const avatar = this.getAttribute('data-avatar');
                    selectGoogleAccount(name, email, avatar);
                });
            });

            // Submit custom account
            if (customForm) {
                customForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const name = document.getElementById('customGoogleName').value.trim();
                    const email = document.getElementById('customGoogleEmail').value.trim();
                    if (name && email) {
                        selectGoogleAccount(name, email, 'https://ui-avatars.com/api/?name=' + encodeURIComponent(name) + '&background=4285F4&color=fff');
                    }
                });
            }
        });
    </script>
</body>
</html>
