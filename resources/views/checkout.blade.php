@extends('layouts.app')

@section('styles')
<style>
/* ===== BCA REKENING BOX ===== */
.bca-rekening-box {
    background: #f0f7ff;
    border: 1.5px solid #bfdbfe;
    border-radius: 14px;
    padding: 18px 20px;
    margin-top: 14px;
    margin-bottom: 16px;
}
.bca-logo-row {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}
.bca-logo-badge {
    background: #005bac;
    border-radius: 8px;
    padding: 6px 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.bca-logo-text {
    color: #fff;
    font-weight: 900;
    font-size: 18px;
    letter-spacing: 2px;
    font-family: 'Arial Black', Arial, sans-serif;
}
.bca-rekening-info {
    flex: 1;
}
.bca-norek {
    font-size: 15px;
    color: #1e3a5f;
    font-weight: 600;
}
.bca-atas-nama {
    font-size: 13px;
    color: #475569;
    margin-top: 2px;
}
.btn-copy-norek {
    background: #fff;
    border: 1.5px solid #bfdbfe;
    color: #2563eb;
    border-radius: 8px;
    padding: 7px 14px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
    white-space: nowrap;
}
.btn-copy-norek:hover {
    background: #eff6ff;
    border-color: #2563eb;
}
.btn-copy-norek.copied {
    background: #ecfdf5;
    border-color: #6ee7b7;
    color: #059669;
}
.bca-nominal-transfer {
    margin-top: 12px;
    padding: 10px 14px;
    background: #fff;
    border-radius: 10px;
    border: 1px solid #dbeafe;
    font-size: 13px;
    color: #1e40af;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* ===== UPLOAD BUKTI ===== */
.upload-bukti-wrapper {
    margin-top: 6px;
}
.upload-bukti-label {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
    border: 2px dashed #cbd5e1;
    border-radius: 14px;
    cursor: pointer;
    transition: all 0.2s;
    background: #fafbfc;
}
.upload-bukti-label:hover {
    border-color: #e07b1b;
    background: #fff8f0;
}
.upload-bukti-label.has-file {
    border-color: #10b981;
    border-style: solid;
    background: #f0fdf4;
}
.upload-bukti-icon {
    font-size: 28px;
    color: #e07b1b;
    flex-shrink: 0;
}
.upload-bukti-text {
    display: flex;
    flex-direction: column;
    gap: 2px;
}
.upload-bukti-main {
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
}
.upload-bukti-hint {
    font-size: 12px;
    color: #94a3b8;
}

/* ===== PAYMENT AMOUNT PREVIEW ===== */
.payment-amount-preview {
    padding: 8px 12px;
    background: #fff8f0;
    border-radius: 8px;
    border: 1px solid #fed7aa;
    display: inline-block;
}
</style>
@endsection

@section('content')
<div class="checkout-page-container">

    <!-- ==================== TOP NAVIGATION / BACK BUTTON ==================== -->
    <div class="checkout-top-nav">
        <a href="{{ url('/paket-wisata/' . $paket['slug']) }}" class="checkout-back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Detail Paket</span>
        </a>
        <div class="checkout-breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="{{ url('/paket-wisata') }}">Paket Wisata</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="{{ url('/paket-wisata/' . $paket['slug']) }}">{{ $paket['name'] }}</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Membuat Pesanan</span>
        </div>
    </div>

    <!-- ==================== MAIN 2-COLUMN LAYOUT ==================== -->
    <div class="checkout-layout-grid">

        <!-- ==================== LEFT COLUMN: MEMBUAT PESANAN ==================== -->
        <div class="checkout-left-column">
            <div class="checkout-white-card checkout-form-card">
                
                <!-- Card Header -->
                <div class="checkout-header">
                    <h1 class="checkout-main-title">Membuat Pesanan</h1>
                    <p class="checkout-main-subtitle">Lengkapi Data Pesanan Anda</p>
                </div>

                <!-- Stepper Progress Bar (3 Steps) -->
                <div class="checkout-stepper">
                    <div class="step-item active" id="stepIndicator1">
                        <div class="step-circle">1</div>
                        <span class="step-label">Data Pesanan</span>
                    </div>
                    <div class="step-line" id="stepLine1"></div>
                    <div class="step-item" id="stepIndicator2">
                        <div class="step-circle">2</div>
                        <span class="step-label">Data Pemesan</span>
                    </div>
                    <div class="step-line" id="stepLine2"></div>
                    <div class="step-item" id="stepIndicator3">
                        <div class="step-circle">3</div>
                        <span class="step-label">Konfirmasi</span>
                    </div>
                </div>

                <!-- Form Checkout Multi-Step -->
                <form id="checkoutBookingForm" onsubmit="event.preventDefault();">
                    @csrf
                    
                    <!-- ==================== STEP 1: DATA PESANAN ==================== -->
                    <div class="checkout-step-content active" id="stepContent1">
                        
                        <!-- 1. Pilih Keberangkatan -->
                        <div class="form-section-block">
                            <h3 class="form-section-title">
                                <span class="num-badge">1</span>
                                Pilih Keberangkatan
                            </h3>
                            <p class="form-section-desc">Pilih kota awal keberangkatan rombongan Anda:</p>

                            <!-- City Selection Grid (Cards) -->
                            <div class="departure-cities-grid">
                                @foreach($departureCities as $index => $c)
                                    <label class="city-radio-card {{ $index === 0 ? 'selected' : '' }}">
                                        <input type="radio" name="departure_city" value="{{ $c['city'] }}" 
                                               data-extra="{{ $c['extra'] }}" 
                                               data-extra-label="{{ $c['extra_label'] }}"
                                               {{ $index === 0 ? 'checked' : '' }}>
                                        <div class="city-card-inner">
                                            <div class="city-info">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="city-name">{{ $c['city'] }}</span>
                                            </div>
                                            <span class="city-price-tag">{{ $c['extra_label'] }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <!-- Input Row: Tanggal, Jam, Meeting Point -->
                            <div class="departure-inputs-grid">
                                <div class="custom-form-group">
                                    <label for="departureDate">
                                        <i class="fa-regular fa-calendar-days"></i> Tanggal Keberangkatan <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" id="departureDate" name="departure_date" class="custom-input" required 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                                </div>

                                <div class="custom-form-group">
                                    <label for="departureTime">
                                        <i class="fa-regular fa-clock"></i> Jam Berangkat <span class="text-danger">*</span>
                                    </label>
                                    <select id="departureTime" name="departure_time" class="custom-select" required>
                                        <option value="06:00 WIB">06:00 WIB (Pagi)</option>
                                        <option value="07:00 WIB" selected>07:00 WIB (Pagi)</option>
                                        <option value="08:30 WIB">08:30 WIB (Pagi)</option>
                                        <option value="19:00 WIB">19:00 WIB (Malam / Night Trip)</option>
                                        <option value="20:30 WIB">20:30 WIB (Malam / Night Trip)</option>
                                    </select>
                                </div>

                                <div class="custom-form-group full-width-sm">
                                    <label for="meetingPoint">
                                        <i class="fa-solid fa-map-pin"></i> Meeting Point / Titik Jemput <span class="text-danger">*</span>
                                    </label>
                                    <select id="meetingPoint" name="meeting_point" class="custom-select" required>
                                        <option value="Pool Bus GO Travel (Pusat Kota)" selected>Pool Bus GO Travel (Pusat Kota)</option>
                                        <option value="Stasiun Kereta Api Utama">Stasiun Kereta Api Utama</option>
                                        <option value="Bandara Internasional">Bandara Internasional</option>
                                        <option value="Hotel / Titik Kumpul Khusus (Sesuai Request)">Hotel / Titik Kumpul Khusus (Sesuai Request)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Jumlah Peserta -->
                        <div class="form-section-block">
                            <h3 class="form-section-title">
                                <span class="num-badge">2</span>
                                Jumlah Peserta
                            </h3>
                            <p class="form-section-desc">Tentukan berapa orang yang akan ikut dalam perjalanan wisata ini:</p>

                            <div class="participants-selector-wrapper">
                                <div class="quantity-control">
                                    <button type="button" class="btn-qty btn-qty-minus" id="btnQtyMinus" aria-label="Kurangi Peserta">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <div class="qty-display-box">
                                        <input type="number" id="inputParticipants" name="participants_count" value="10" min="1" max="45" class="qty-number-input">
                                        <span class="qty-unit-label">Orang</span>
                                    </div>
                                    <button type="button" class="btn-qty btn-qty-plus" id="btnQtyPlus" aria-label="Tambah Peserta">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                <div class="qty-hint-badge">
                                    <i class="fa-solid fa-users"></i>
                                    <span>Kapasitas Armada: Max 40 Orang</span>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Catatan (Opsional) -->
                        <div class="form-section-block">
                            <h3 class="form-section-title">
                                <span class="num-badge">3</span>
                                Catatan (Opsional)
                            </h3>
                            <div class="custom-form-group">
                                <textarea id="orderNotes" name="order_notes" rows="3" class="custom-textarea" placeholder="Tuliskan permintaan khusus, menu vegetarian, titik jemput spesifik, atau informasi penting lainnya..."></textarea>
                            </div>
                            
                            <div class="terms-agreement-note">
                                <i class="fa-solid fa-circle-info"></i>
                                <span>Dengan melakukan pemesanan, Anda setuju dengan Syarat & Ketentuan yang berlaku di GO Travel.</span>
                            </div>
                        </div>

                        <!-- Action Buttons Step 1 -->
                        <div class="checkout-action-row">
                            <a href="{{ url('/paket-wisata/' . $paket['slug']) }}" class="btn-step-secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span>Kembali</span>
                            </a>
                            <button type="button" class="btn-step-primary" id="btnGoToStep2">
                                <span>Lanjutkan ke Data Pemesan</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>

                    </div>

                    <!-- ==================== STEP 2: DATA PEMESAN ==================== -->
                    <div class="checkout-step-content" id="stepContent2">
                        <div class="form-section-block">
                            <h3 class="form-section-title">
                                <span class="num-badge"><i class="fa-solid fa-user"></i></span>
                                Identitas Pemesan / Kontak Rombongan
                            </h3>
                            <p class="form-section-desc">E-ticket, invoice, dan konfirmasi armada akan dikirimkan ke kontak ini:</p>

                            <div class="customer-inputs-grid">
                                <div class="custom-form-group">
                                    <label for="custName">Nama Lengkap Pemesan <span class="text-danger">*</span></label>
                                    <input type="text" id="custName" name="customer_name" class="custom-input" placeholder="Contoh: Budi Santoso" required>
                                </div>

                                <div class="custom-form-group">
                                    <label for="custWhatsapp">Nomor WhatsApp / HP <span class="text-danger">*</span></label>
                                    <input type="tel" id="custWhatsapp" name="customer_phone" class="custom-input" placeholder="Contoh: 081234567890" required>
                                </div>

                                <div class="custom-form-group">
                                    <label for="custEmail">Email Pemesan <span class="text-danger">*</span></label>
                                    <input type="email" id="custEmail" name="customer_email" class="custom-input" placeholder="Contoh: budi@gmail.com" required>
                                </div>

                                <div class="custom-form-group">
                                    <label for="custOrg">Nama Instansi / Perusahaan / Keluarga (Opsional)</label>
                                    <input type="text" id="custOrg" name="customer_org" class="custom-input" placeholder="Contoh: PT Maju Jaya / Keluarga Budi">
                                </div>
                            </div>
                        </div>

                        <!-- hidden: skema selalu Lunas 100% -->
                        <input type="hidden" name="payment_scheme" value="full" id="paymentSchemeFixed">

                        <!-- 1. Bayar Sekarang — Transfer BCA (Lunas) -->
                        <div class="form-section-block" id="sectionBayarSekarang">
                            <h3 class="form-section-title">
                                <span class="num-badge">1</span>
                                Bayar Sekarang
                            </h3>
                            <p class="form-section-desc">Selesaikan pembayaran lunas, lalu upload bukti transfer untuk memproses pesanan Anda.</p>

                            <!-- Info Rekening BCA -->
                            <div class="bca-rekening-box">
                                <div class="bca-logo-row">
                                    <div class="bca-logo-badge">
                                        <span class="bca-logo-text">BCA</span>
                                    </div>
                                    <div class="bca-rekening-info">
                                        <div class="bca-norek">No. Rekening: <strong>1234567890</strong></div>
                                        <div class="bca-atas-nama">Atas Nama: <strong>PT GO Travel Indonesia</strong></div>
                                    </div>
                                    <button type="button" class="btn-copy-norek" id="btnCopyNorek" title="Salin nomor rekening">
                                        <i class="fa-regular fa-copy"></i>
                                        <span id="copyNorekLabel">Salin</span>
                                    </button>
                                </div>
                                <div class="bca-nominal-transfer">
                                    <i class="fa-solid fa-circle-info" style="color:#2563eb;"></i>
                                    <span>Transfer sejumlah: <strong id="nominalTransfer">-</strong></span>
                                </div>
                            </div>

                            <!-- Upload Bukti Transfer -->
                            <div class="upload-bukti-wrapper">
                                <label class="upload-bukti-label" id="uploadBuktiLabel" for="inputBuktiTransfer">
                                    <div class="upload-bukti-icon">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>
                                    <div class="upload-bukti-text">
                                        <span class="upload-bukti-main" id="uploadBuktiMainText">Upload Bukti Transfer</span>
                                        <span class="upload-bukti-hint">Format: JPG, PNG, PDF — Maks. 2MB</span>
                                    </div>
                                </label>
                                <input type="file" id="inputBuktiTransfer" name="bukti_transfer_preview"
                                    accept="image/jpeg,image/png,image/jpg,application/pdf"
                                    style="display:none;" onchange="handleBuktiUpload(this)">

                                <!-- Preview -->
                                <div id="buktiPreviewBox" style="display:none; margin-top:12px;">
                                    <img id="buktiPreviewImg" src="" alt="Preview Bukti" style="max-width:100%; max-height:220px; border-radius:10px; border:1.5px solid #e2e8f0; object-fit:contain;">
                                    <div style="display:flex;align-items:center;gap:8px;margin-top:8px;">
                                        <i class="fa-solid fa-circle-check" style="color:#10b981;font-size:15px;"></i>
                                        <span id="buktiFileName" style="font-size:13px;color:#374151;font-weight:600;"></span>
                                        <button type="button" onclick="removeBukti()" style="margin-left:auto;background:none;border:none;color:#ef4444;cursor:pointer;font-size:13px;">
                                            <i class="fa-solid fa-xmark"></i> Hapus
                                        </button>
                                    </div>
                                </div>

                                <!-- Alert belum upload -->
                                <div id="alertBuktiRequired" style="display:none;margin-top:10px;padding:10px 14px;background:#fef2f2;border:1px solid #fecaca;border-radius:10px;color:#b91c1c;font-size:13px;font-weight:600;align-items:center;gap:8px;">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    Harap upload bukti transfer terlebih dahulu sebelum melanjutkan.
                                </div>
                            </div>
                        </div>

                        <!-- 2. Catatan (Opsional) -->
                        <div class="form-section-block">
                            <h3 class="form-section-title">
                                <span class="num-badge">2</span>
                                Catatan (Opsional)
                            </h3>
                            <div class="custom-form-group">
                                <textarea id="orderNotesStep2" name="order_notes_pemesan" rows="3" class="custom-textarea"
                                    placeholder="Permintaan khusus, informasi tambahan, atau hal yang perlu diketahui tim kami..."></textarea>
                            </div>
                            <div class="terms-agreement-note" style="margin-top:10px;">
                                <i class="fa-solid fa-circle-info"></i>
                                <span>Dengan melanjutkan pemesanan, Anda setuju dengan <a href="#" style="color:#e07b1b;font-weight:700;">Syarat &amp; Ketentuan</a> yang berlaku.</span>
                            </div>
                        </div>

                        <!-- Action Buttons Step 2 -->
                        <div class="checkout-action-row">
                            <button type="button" class="btn-step-secondary" id="btnBackToStep1">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span>Kembali ke Data Pesanan</span>
                            </button>
                            <button type="button" class="btn-step-primary" id="btnGoToStep3">
                                <span>Lanjutkan ke Konfirmasi</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- ==================== STEP 3: KONFIRMASI ==================== -->
                    <div class="checkout-step-content" id="stepContent3">
                        <div class="confirmation-review-box">
                            <div class="confirm-icon-badge">
                                <i class="fa-solid fa-clipboard-check"></i>
                            </div>
                            <h3 class="confirm-box-title">Periksa Kembali Pesanan Anda</h3>
                            <p class="confirm-box-desc">Pastikan semua data di bawah ini sudah sesuai sebelum menyelesaikan pesanan.</p>

                            <div class="confirm-summary-details">
                                <div class="confirm-row">
                                    <span>Paket Wisata:</span>
                                    <strong>{{ $paket['name'] }}</strong>
                                </div>
                                <div class="confirm-row">
                                    <span>Kota Keberangkatan:</span>
                                    <strong id="confirmCity">Yogyakarta</strong>
                                </div>
                                <div class="confirm-row">
                                    <span>Jadwal Keberangkatan:</span>
                                    <strong id="confirmSchedule">-</strong>
                                </div>
                                <div class="confirm-row">
                                    <span>Meeting Point:</span>
                                    <strong id="confirmMeetingPoint">-</strong>
                                </div>
                                <div class="confirm-row">
                                    <span>Jumlah Peserta:</span>
                                    <strong id="confirmQty">10 Orang</strong>
                                </div>
                                <div class="confirm-row">
                                    <span>Nama Pemesan:</span>
                                    <strong id="confirmName">-</strong>
                                </div>
                                <div class="confirm-row">
                                    <span>Kontak WhatsApp:</span>
                                    <strong id="confirmPhone">-</strong>
                                </div>
                                <div class="confirm-row confirm-row-total">
                                    <span>Total Pembayaran:</span>
                                    <strong id="confirmTotal" class="text-orange">-</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons Step 3 -->
                        <div class="checkout-action-row">
                            <button type="button" class="btn-step-secondary" id="btnBackToStep2">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span>Ubah Data Pemesan</span>
                            </button>
                            <button type="button" class="btn-step-primary btn-step-final" id="btnCompleteOrder">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Konfirmasi Pesanan</span>
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

        <!-- ==================== RIGHT COLUMN: RINGKASAN PEMESANAN ==================== -->
        <div class="checkout-right-column">
            <div class="checkout-sidebar-sticky">

                <div class="checkout-white-card checkout-summary-card">
                    <h2 class="summary-card-title">Ringkasan Pemesanan</h2>

                    <!-- Header Paket Dipilih -->
                    <div class="summary-package-header">
                        <div class="summary-package-img-wrap">
                            <img src="{{ asset($paket['image']) }}" alt="{{ $paket['name'] }}" class="summary-package-img">
                            <span class="summary-badge-open">Open Trip</span>
                        </div>
                        <div class="summary-package-info">
                            <h3 class="summary-pkg-name">{{ $paket['name'] }}</h3>
                            <div class="summary-pkg-meta">
                                <div><i class="fa-regular fa-clock"></i> {{ $paket['duration'] }}</div>
                                <div><i class="fa-solid fa-hotel"></i> {{ $paket['hotel_info'] }}</div>
                                <div><i class="fa-solid fa-utensils"></i> {{ $paket['meal_info'] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-divider"></div>

                    <!-- Rincian Perjalanan -->
                    <div class="summary-section-group">
                        <h4 class="summary-group-title">Rincian Perjalanan</h4>
                        <div class="summary-details-list">
                            <div class="summary-detail-item">
                                <span class="lbl">Kota Keberangkatan</span>
                                <span class="val font-semibold" id="summaryCity">Yogyakarta</span>
                            </div>
                            <div class="summary-detail-item">
                                <span class="lbl">Tanggal Keberangkatan</span>
                                <span class="val font-semibold" id="summaryDate">-</span>
                            </div>
                            <div class="summary-detail-item">
                                <span class="lbl">Jam Berangkat</span>
                                <span class="val font-semibold" id="summaryTime">07:00 WIB</span>
                            </div>
                            <div class="summary-detail-item">
                                <span class="lbl">Jumlah Peserta</span>
                                <span class="val font-semibold" id="summaryQty">10 Orang</span>
                            </div>
                            <div class="summary-detail-item">
                                <span class="lbl">Harga per Orang</span>
                                <span class="val font-semibold" id="summaryPricePerPerson">{{ $paket['price'] }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="summary-divider"></div>

                    <!-- Rincian Biaya -->
                    <div class="summary-section-group">
                        <div class="summary-price-calc">
                            <div class="calc-row">
                                <span class="lbl">Subtotal (<span id="calcQty">10</span> peserta)</span>
                                <span class="val" id="summarySubtotal">-</span>
                            </div>
                            <div class="calc-row">
                                <span class="lbl">Biaya Layanan & Asuransi</span>
                                <span class="val" id="summaryServiceFee">Rp 25.000</span>
                            </div>
                            <div class="calc-row-total">
                                <span class="lbl-total">Total</span>
                                <span class="val-total" id="summaryTotal">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kotak Hijau Keamanan -->
                    <div class="summary-trust-badge">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>Transaksi aman & terpercaya</span>
                    </div>

                    <div class="summary-divider"></div>

                    <!-- Termasuk dalam Paket -->
                    <div class="summary-section-group">
                        <h4 class="summary-group-title">Termasuk dalam Paket</h4>
                        <ul class="summary-inclusion-checklist">
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>Transportasi Bus Pariwisata</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>Makan sesuai program</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>{{ $paket['hotel_info'] }}</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>Tiket masuk wisata</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>Driver & Tour Guide</span>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

<!-- Pass dynamic data to JavaScript -->
<script>
    window.PACKAGE_DATA = {
        name: @json($paket['name']),
        slug: @json($paket['slug']),
        basePrice: {{ (int) $paket['price_raw'] }},
        duration: @json($paket['duration']),
        serviceFee: 25000
    };

    // ===== Upload Bukti Transfer =====
    let buktiFileObject = null;

    function handleBuktiUpload(input) {
        const file = input.files[0];
        if (!file) return;

        // Validasi ukuran (maks 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            return;
        }

        buktiFileObject = file;
        const label = document.getElementById('uploadBuktiLabel');
        label.classList.add('has-file');

        document.getElementById('uploadBuktiMainText').textContent = 'Ganti Bukti Transfer';
        document.getElementById('buktiFileName').textContent = file.name;
        document.getElementById('alertBuktiRequired').style.display = 'none';

        // Preview gambar (hanya untuk image)
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                window.buktiBase64Data = e.target.result;
                document.getElementById('buktiPreviewImg').src = e.target.result;
                document.getElementById('buktiPreviewBox').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            // PDF — tampilkan nama file saja
            window.buktiBase64Data = null;
            document.getElementById('buktiPreviewImg').src = '';
            document.getElementById('buktiPreviewBox').style.display = 'block';
        }
    }

    function removeBukti() {
        buktiFileObject = null;
        window.buktiBase64Data = null;
        document.getElementById('inputBuktiTransfer').value = '';
        document.getElementById('uploadBuktiLabel').classList.remove('has-file');
        document.getElementById('uploadBuktiMainText').textContent = 'Upload Bukti Transfer';
        document.getElementById('buktiPreviewBox').style.display = 'none';
        document.getElementById('buktiPreviewImg').src = '';
    }

    // ===== Salin No Rekening =====
    document.addEventListener('DOMContentLoaded', function () {
        const btnCopy = document.getElementById('btnCopyNorek');
        if (btnCopy) {
            btnCopy.addEventListener('click', function () {
                navigator.clipboard.writeText('1234567890').then(function () {
                    btnCopy.classList.add('copied');
                    document.getElementById('copyNorekLabel').textContent = 'Tersalin!';
                    setTimeout(function () {
                        btnCopy.classList.remove('copied');
                        document.getElementById('copyNorekLabel').textContent = 'Salin';
                    }, 2500);
                }).catch(function () {
                    // Fallback untuk browser lama
                    const el = document.createElement('textarea');
                    el.value = '1234567890';
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);
                    document.getElementById('copyNorekLabel').textContent = 'Tersalin!';
                    setTimeout(function () {
                        document.getElementById('copyNorekLabel').textContent = 'Salin';
                    }, 2500);
                });
            });
        }

        // ===== Nominal transfer = selalu total penuh (Lunas 100%) =====
        function updateNominalTransfer() {
            const qty = window.currentQty || parseInt(document.getElementById('inputParticipants')?.value) || 10;
            const total = (window.PACKAGE_DATA.basePrice * qty) + window.PACKAGE_DATA.serviceFee;
            const formatted = 'Rp ' + total.toLocaleString('id-ID');
            const nominalEl = document.getElementById('nominalTransfer');
            if (nominalEl) nominalEl.textContent = formatted;
        }

        // ===== Validasi bukti sebelum lanjut ke Step 3 =====
        const btnGoToStep3 = document.getElementById('btnGoToStep3');
        if (btnGoToStep3) {
            btnGoToStep3.addEventListener('click', function (e) {
                // Cek data pemesan
                const custName = document.getElementById('custName');
                const custWhatsapp = document.getElementById('custWhatsapp');
                const custEmail = document.getElementById('custEmail');

                if (custName && !custName.value.trim()) {
                    custName.focus();
                    custName.style.borderColor = '#ef4444';
                    return;
                }
                if (custWhatsapp && !custWhatsapp.value.trim()) {
                    custWhatsapp.focus();
                    custWhatsapp.style.borderColor = '#ef4444';
                    return;
                }
                if (custEmail && !custEmail.value.trim()) {
                    custEmail.focus();
                    custEmail.style.borderColor = '#ef4444';
                    return;
                }

                // Cek bukti transfer
                if (!buktiFileObject) {
                    document.getElementById('alertBuktiRequired').style.display = 'flex';
                    document.getElementById('sectionBayarSekarang').scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }

                document.getElementById('alertBuktiRequired').style.display = 'none';
                // Lanjut ke step 3 — trigger event di main JS
                document.dispatchEvent(new CustomEvent('goToStep3Confirmed'));
            }, true); // capture phase agar override handler lain
        }

        // Init nominal
        setTimeout(updateNominalTransfer, 300);
    });
</script>
@endsection
