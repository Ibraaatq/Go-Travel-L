<!-- Google Account Chooser Modal Dialog -->
<div class="google-modal-backdrop" id="googleAccountModal" aria-hidden="true">
    <div class="google-modal-container" role="dialog" aria-modal="true" aria-labelledby="googleModalTitle">
        <!-- Close Button -->
        <button type="button" class="google-modal-close-btn" id="closeGoogleModal" aria-label="Tutup modal">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <!-- Google Header -->
        <div class="google-modal-header">
            <div class="google-logo-wrapper">
                <svg viewBox="0 0 24 24" width="28" height="28">
                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.98 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                </svg>
            </div>
            <h3 class="google-modal-title" id="googleModalTitle">Pilih Akun Google</h3>
            <p class="google-modal-subtitle">untuk melanjutkan ke <strong class="text-orange-highlight">GO Travel</strong></p>
        </div>

        <!-- Account List View -->
        <div class="google-accounts-view" id="googleAccountsListView">
            <div class="google-account-list">
                <!-- Account Option 1 -->
                <button type="button" class="google-account-item" data-name="Ahmad Fauzi" data-email="ahmad.fauzi@gmail.com" data-avatar="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80">
                    <div class="google-avatar-box">
                        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100&auto=format&fit=crop&q=80" alt="Ahmad Fauzi" class="google-avatar-img">
                    </div>
                    <div class="google-account-info">
                        <div class="google-account-name">Ahmad Fauzi</div>
                        <div class="google-account-email">ahmad.fauzi@gmail.com</div>
                    </div>
                    <i class="fa-solid fa-chevron-right google-account-arrow"></i>
                </button>

                <!-- Account Option 2 -->
                <button type="button" class="google-account-item" data-name="Okta S." data-email="okta.dev@gmail.com" data-avatar="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?w=100&auto=format&fit=crop&q=80">
                    <div class="google-avatar-box">
                        <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?w=100&auto=format&fit=crop&q=80" alt="Okta S." class="google-avatar-img">
                    </div>
                    <div class="google-account-info">
                        <div class="google-account-name">Okta S.</div>
                        <div class="google-account-email">okta.dev@gmail.com</div>
                    </div>
                    <i class="fa-solid fa-chevron-right google-account-arrow"></i>
                </button>

                <!-- Account Option 3 -->
                <button type="button" class="google-account-item" data-name="Traveler Official" data-email="gotraveler.official@gmail.com" data-avatar="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80">
                    <div class="google-avatar-box">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop&q=80" alt="Traveler Official" class="google-avatar-img">
                    </div>
                    <div class="google-account-info">
                        <div class="google-account-name">Traveler Official</div>
                        <div class="google-account-email">gotraveler.official@gmail.com</div>
                    </div>
                    <i class="fa-solid fa-chevron-right google-account-arrow"></i>
                </button>

                <!-- Use Another Account Button -->
                <button type="button" class="google-account-item google-use-another-btn" id="btnUseAnotherGoogleAccount">
                    <div class="google-avatar-box google-avatar-placeholder">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="google-account-info">
                        <div class="google-account-name font-semibold">Gunakan akun lain</div>
                        <div class="google-account-email">Masuk dengan email Google lainnya</div>
                    </div>
                    <i class="fa-solid fa-chevron-right google-account-arrow"></i>
                </button>
            </div>
        </div>

        <!-- Custom Account Form (Hidden by default) -->
        <div class="google-custom-account-view" id="googleCustomAccountView" style="display: none;">
            <form id="googleCustomForm" class="google-custom-form">
                <div class="google-input-group">
                    <label for="customGoogleName" class="google-input-label">Nama Lengkap</label>
                    <input type="text" id="customGoogleName" class="google-form-input" placeholder="Masukkan nama Anda" required>
                </div>
                <div class="google-input-group">
                    <label for="customGoogleEmail" class="google-input-label">Email Google</label>
                    <input type="email" id="customGoogleEmail" class="google-form-input" placeholder="contoh: nama@gmail.com" required>
                </div>
                <div class="google-custom-actions">
                    <button type="button" class="google-btn-back" id="btnBackToAccountList">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </button>
                    <button type="submit" class="google-btn-proceed">
                        Lanjutkan
                    </button>
                </div>
            </form>
        </div>

        <!-- Loading View (Hidden by default) -->
        <div class="google-loading-view" id="googleLoadingView" style="display: none;">
            <div class="google-spinner"></div>
            <p class="google-loading-text" id="googleLoadingText">Menghubungkan akun Google ke GO Travel...</p>
        </div>

        <!-- Hidden Form to submit selected Google Account to Laravel -->
        <form id="googleAuthSubmitForm" action="{{ route('auth.google.select') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="name" id="hiddenGoogleName">
            <input type="hidden" name="email" id="hiddenGoogleEmail">
            <input type="hidden" name="avatar" id="hiddenGoogleAvatar">
        </form>

        <!-- Footer Disclaimer -->
        <div class="google-modal-footer">
            <p class="google-disclaimer">
                Untuk melanjutkan, Google akan membagikan nama, alamat email, dan foto profil Anda dengan <strong>GO Travel</strong>.
            </p>
        </div>
    </div>
</div>
