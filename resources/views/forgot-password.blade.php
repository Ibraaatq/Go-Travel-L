<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - GO Travel</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Login CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        .auth-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ea580c;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 700;
            margin-bottom: 18px;
            transition: color 0.2s ease, transform 0.2s ease;
        }
        .auth-back-link:hover {
            color: #c2410c;
            transform: translateX(-3px);
        }
        .auth-info-box {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            color: #9a3412;
            line-height: 1.45;
        }
    </style>
</head>

<body class="auth-page-body">
    <!-- Blurred Background with Overlay -->
    <div class="auth-bg-overlay"></div>

    <!-- Main Card Container -->
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
                    Setiap perjalanan dimulai dengan satu langkah. Amankan akunmu dan lanjutkan liburan impianmu.
                </p>
            </div>
        </div>

        <!-- ==================== KOLOM KANAN: FORM RESET PASSWORD ==================== -->
        <div class="login-form-col">
            <!-- Back to Login Button -->
            <a href="{{ url('/login') }}" class="auth-back-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali ke Halaman Login</span>
            </a>

            <!-- Header Text -->
            <div class="login-header-group">
                <h1 class="login-main-title">Reset Password</h1>
                <p class="login-main-subtitle">
                    Masukkan email terdaftar dan buat password baru untuk akun GO Travel Anda.
                </p>
            </div>

            <!-- Petunjuk Singkat -->
            <div class="auth-info-box">
                <i class="fa-solid fa-shield-halved" style="font-size: 16px; margin-top: 2px;"></i>
                <span>Gunakan kombinasi minimal 6 karakter dengan huruf dan angka agar akun Anda tetap aman.</span>
            </div>

            @if(session('error'))
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 10px 16px; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-circle-exclamation" style="color: #ef4444;"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 10px 16px; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 16px;">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form Reset Password -->
            <form action="{{ url('/forgot-password') }}" method="POST" id="resetPasswordForm">
                @csrf

                <!-- Email Field -->
                <div class="auth-form-group">
                    <label for="email" class="auth-label">Alamat Email Terdaftar</label>
                    <div class="auth-input-wrapper">
                        <input type="email" id="email" name="email" class="auth-input" placeholder="contoh: user@gmail.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <!-- Password Baru Field -->
                <div class="auth-form-group">
                    <label for="password" class="auth-label">Password Baru</label>
                    <div class="auth-input-wrapper">
                        <input type="password" id="password" name="password" class="auth-input auth-input-password" placeholder="Minimal 6 karakter" required>
                        <button type="button" class="auth-password-toggle" id="togglePassword" aria-label="Toggle password visibility">
                            <i class="fa-regular fa-eye-slash" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Konfirmasi Password Baru Field -->
                <div class="auth-form-group">
                    <label for="password_confirmation" class="auth-label">Konfirmasi Password Baru</label>
                    <div class="auth-input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="auth-input auth-input-password" placeholder="Ulangi password baru" required>
                        <button type="button" class="auth-password-toggle" id="toggleConfirmPassword" aria-label="Toggle confirm password visibility">
                            <i class="fa-regular fa-eye-slash" id="toggleConfirmPasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-auth-submit" style="margin-top: 10px;">
                    Simpan Password Baru
                </button>
            </form>

            <div style="margin-top: 20px; text-align: center; font-size: 13px; color: #64748b;">
                Sudah ingat password Anda? 
                <a href="{{ url('/login') }}" style="color: #ea580c; font-weight: 700; text-decoration: none;">Masuk di sini</a>
            </div>

        </div>
    </div>

    <!-- Interactive Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupToggle(toggleId, inputId, iconId) {
                const btn = document.getElementById(toggleId);
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);

                if (btn && input && icon) {
                    btn.addEventListener('click', function() {
                        const isPassword = input.getAttribute('type') === 'password';
                        input.setAttribute('type', isPassword ? 'text' : 'password');
                        if (isPassword) {
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        } else {
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        }
                    });
                }
            }

            setupToggle('togglePassword', 'password', 'togglePasswordIcon');
            setupToggle('toggleConfirmPassword', 'password_confirmation', 'toggleConfirmPasswordIcon');
        });
    </script>
</body>

</html>
