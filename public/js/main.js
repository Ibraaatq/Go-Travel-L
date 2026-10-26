/**
 * Go Travel - Frontend Interactivity
 */
document.addEventListener('DOMContentLoaded', function () {
    // 1. Mobile Navigation Toggle
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function () {
            navMenu.classList.toggle('show');
            const icon = mobileToggle.querySelector('i');
            if (icon) {
                if (navMenu.classList.contains('show')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-xmark');
                } else {
                    icon.classList.remove('fa-xmark');
                    icon.classList.add('fa-bars');
                }
            }
        });
    }

    // 2. Wishlist Heart Button Interactive Toggle & Server Synchronization
    initWishlistStates();

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.wishlist-btn');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();

        const slug = btn.getAttribute('data-slug') || '';
        const id = btn.getAttribute('data-id') || '';
        toggleWishlist(btn, slug || id);
    });

    // 3. Live Search in Paket Wisata (Both Hero Search & Main Filter Bar Search)
    const heroSearchInput = document.getElementById('heroSearchInput');
    const paketSearchInput = document.getElementById('paketSearchInput');
    const searchInputs = [heroSearchInput, paketSearchInput].filter(Boolean);

    function filterPackages(query) {
        const packageCards = document.querySelectorAll('.package-card');
        const cleanQuery = query.toLowerCase().trim();

        packageCards.forEach(card => {
            const title = card.getAttribute('data-title') || card.querySelector('.package-name')?.textContent.toLowerCase() || '';
            if (!cleanQuery || title.includes(cleanQuery)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    searchInputs.forEach(input => {
        input.addEventListener('input', function () {
            const query = this.value;
            // Sync values across search inputs
            searchInputs.forEach(other => {
                if (other !== input) {
                    other.value = query;
                }
            });
            filterPackages(query);
        });
    });

    // 4. Category Filter Dropdown in Paket Wisata
    const btnFilterCategory = document.getElementById('btnFilterCategory');
    const categoryDropdownMenu = document.getElementById('categoryDropdownMenu');

    if (btnFilterCategory && categoryDropdownMenu) {
        btnFilterCategory.addEventListener('click', function (e) {
            e.stopPropagation();
            categoryDropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', function () {
            categoryDropdownMenu.classList.remove('show');
        });

        const dropdownItems = categoryDropdownMenu.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function (e) {
                e.preventDefault();
                dropdownItems.forEach(d => d.classList.remove('active'));
                this.classList.add('active');

                const selectedCategory = this.getAttribute('data-category');
                const btnText = btnFilterCategory.querySelector('span');
                if (btnText) {
                    btnText.textContent = this.textContent;
                }

                const packageCards = document.querySelectorAll('.package-card');
                packageCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category') || '';
                    if (selectedCategory === 'all' || cardCategory.includes(selectedCategory)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });

                categoryDropdownMenu.classList.remove('show');
            });
        });
    }

    // =========================================================================
    // 5. CHECKOUT PAGE DYNAMIC CALCULATION & STEPPER LOGIC
    // =========================================================================
    const checkoutContainer = document.querySelector('.checkout-page-container');
    if (checkoutContainer && window.PACKAGE_DATA) {
        const pkgData = window.PACKAGE_DATA;
        let selectedExtra = 0;
        let selectedCityName = 'Yogyakarta';

        // Format Currency Helper
        function formatRupiah(number) {
            return 'Rp ' + Number(number).toLocaleString('id-ID');
        }

        // Format Date Helper
        function formatIndoDate(dateString) {
            if (!dateString) return '-';
            const parts = dateString.split('-');
            if (parts.length !== 3) return dateString;
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const year = parts[0];
            const monthIndex = parseInt(parts[1], 10) - 1;
            const day = parts[2];
            return `${day} ${months[monthIndex]} ${year}`;
        }

        // Elements
        const cityRadioLabels = document.querySelectorAll('.city-radio-card');
        const inputParticipants = document.getElementById('inputParticipants');
        const btnQtyMinus = document.getElementById('btnQtyMinus');
        const btnQtyPlus = document.getElementById('btnQtyPlus');
        const departureDate = document.getElementById('departureDate');
        const departureTime = document.getElementById('departureTime');
        const meetingPoint = document.getElementById('meetingPoint');

        // Summary Elements
        const summaryCity = document.getElementById('summaryCity');
        const summaryDate = document.getElementById('summaryDate');
        const summaryTime = document.getElementById('summaryTime');
        const summaryQty = document.getElementById('summaryQty');
        const calcQty = document.getElementById('calcQty');
        const summaryPricePerPerson = document.getElementById('summaryPricePerPerson');
        const summarySubtotal = document.getElementById('summarySubtotal');
        const summaryTotal = document.getElementById('summaryTotal');

        // Calculation Function
        function recalculate() {
            const qty = Math.max(1, parseInt(inputParticipants.value, 10) || 1);
            const pricePerPerson = pkgData.basePrice + selectedExtra;
            const subtotal = pricePerPerson * qty;
            const total = subtotal + pkgData.serviceFee;

            if (summaryCity) summaryCity.textContent = selectedCityName;
            if (summaryQty) summaryQty.textContent = `${qty} Orang`;
            if (calcQty) calcQty.textContent = qty;
            if (summaryPricePerPerson) summaryPricePerPerson.textContent = formatRupiah(pricePerPerson);
            if (summarySubtotal) summarySubtotal.textContent = formatRupiah(subtotal);
            if (summaryTotal) summaryTotal.textContent = formatRupiah(total);

            if (departureDate && summaryDate) {
                summaryDate.textContent = formatIndoDate(departureDate.value);
            }
            if (departureTime && summaryTime) {
                summaryTime.textContent = departureTime.value;
            }
        }

        // City Card Selection Handler
        cityRadioLabels.forEach(label => {
            label.addEventListener('click', function () {
                cityRadioLabels.forEach(l => l.classList.remove('selected'));
                this.classList.add('selected');
                const radio = this.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                    selectedExtra = parseInt(radio.getAttribute('data-extra'), 10) || 0;
                    selectedCityName = radio.value;
                    recalculate();
                }
            });
        });

        // Quantity Plus & Minus Handlers
        if (btnQtyMinus && btnQtyPlus && inputParticipants) {
            btnQtyMinus.addEventListener('click', function () {
                let current = parseInt(inputParticipants.value, 10) || 1;
                if (current > 1) {
                    inputParticipants.value = current - 1;
                    recalculate();
                }
            });

            btnQtyPlus.addEventListener('click', function () {
                let current = parseInt(inputParticipants.value, 10) || 1;
                if (current < 45) {
                    inputParticipants.value = current + 1;
                    recalculate();
                }
            });

            inputParticipants.addEventListener('input', function () {
                let val = parseInt(this.value, 10);
                if (isNaN(val) || val < 1) val = 1;
                if (val > 45) val = 45;
                this.value = val;
                recalculate();
            });
        }

        // Date & Time Change Handlers
        if (departureDate) {
            departureDate.addEventListener('change', recalculate);
        }
        if (departureTime) {
            departureTime.addEventListener('change', recalculate);
        }

        // Initial Calculation
        const initialRadio = document.querySelector('input[name="departure_city"]:checked');
        if (initialRadio) {
            selectedExtra = parseInt(initialRadio.getAttribute('data-extra'), 10) || 0;
            selectedCityName = initialRadio.value;
        }
        recalculate();

        // =========================================================================
        // Stepper Navigation (Step 1 -> Step 2 -> Step 3)
        // =========================================================================
        const step1 = document.getElementById('stepContent1');
        const step2 = document.getElementById('stepContent2');
        const step3 = document.getElementById('stepContent3');

        const ind1 = document.getElementById('stepIndicator1');
        const ind2 = document.getElementById('stepIndicator2');
        const ind3 = document.getElementById('stepIndicator3');

        const line1 = document.getElementById('stepLine1');
        const line2 = document.getElementById('stepLine2');

        const btnGoToStep2 = document.getElementById('btnGoToStep2');
        const btnBackToStep1 = document.getElementById('btnBackToStep1');
        const btnGoToStep3 = document.getElementById('btnGoToStep3');
        const btnBackToStep2 = document.getElementById('btnBackToStep2');
        const btnCompleteOrder = document.getElementById('btnCompleteOrder');

        // Step 1 -> Step 2
        if (btnGoToStep2) {
            btnGoToStep2.addEventListener('click', function () {
                if (!departureDate.value) {
                    alert('Silakan pilih tanggal keberangkatan terlebih dahulu.');
                    departureDate.focus();
                    return;
                }

                step1.classList.remove('active');
                step2.classList.add('active');

                ind1.classList.remove('active');
                ind1.classList.add('completed');
                ind2.classList.add('active');
                if (line1) line1.classList.add('completed');

                window.scrollTo({ top: checkoutContainer.offsetTop - 20, behavior: 'smooth' });
            });
        }

        // Step 2 -> Step 1
        if (btnBackToStep1) {
            btnBackToStep1.addEventListener('click', function () {
                step2.classList.remove('active');
                step1.classList.add('active');

                ind2.classList.remove('active');
                ind1.classList.remove('completed');
                ind1.classList.add('active');
                if (line1) line1.classList.remove('completed');

                window.scrollTo({ top: checkoutContainer.offsetTop - 20, behavior: 'smooth' });
            });
        }

        // Step 2 -> Step 3
        if (btnGoToStep3) {
            btnGoToStep3.addEventListener('click', function () {
                const custName = document.getElementById('custName');
                const custWhatsapp = document.getElementById('custWhatsapp');
                const custEmail = document.getElementById('custEmail');

                if (!custName.value.trim()) {
                    alert('Silakan masukkan nama lengkap pemesan.');
                    custName.focus();
                    return;
                }
                if (!custWhatsapp.value.trim()) {
                    alert('Silakan masukkan nomor WhatsApp/HP aktif pemesan.');
                    custWhatsapp.focus();
                    return;
                }
                if (!custEmail.value.trim()) {
                    alert('Silakan masukkan alamat email aktif pemesan.');
                    custEmail.focus();
                    return;
                }

                // Populate Step 3 Confirmation
                const confirmCity = document.getElementById('confirmCity');
                const confirmSchedule = document.getElementById('confirmSchedule');
                const confirmMeetingPoint = document.getElementById('confirmMeetingPoint');
                const confirmQty = document.getElementById('confirmQty');
                const confirmName = document.getElementById('confirmName');
                const confirmPhone = document.getElementById('confirmPhone');
                const confirmTotal = document.getElementById('confirmTotal');

                if (confirmCity) confirmCity.textContent = selectedCityName;
                if (confirmSchedule) confirmSchedule.textContent = `${formatIndoDate(departureDate.value)} (${departureTime.value})`;
                if (confirmMeetingPoint) confirmMeetingPoint.textContent = meetingPoint.value;
                if (confirmQty) confirmQty.textContent = `${inputParticipants.value} Orang`;
                if (confirmName) confirmName.textContent = custName.value;
                if (confirmPhone) confirmPhone.textContent = custWhatsapp.value;
                if (confirmTotal && summaryTotal) confirmTotal.textContent = summaryTotal.textContent;

                step2.classList.remove('active');
                step3.classList.add('active');

                ind2.classList.remove('active');
                ind2.classList.add('completed');
                ind3.classList.add('active');
                if (line2) line2.classList.add('completed');

                window.scrollTo({ top: checkoutContainer.offsetTop - 20, behavior: 'smooth' });
            });
        }

        // Step 3 -> Step 2
        if (btnBackToStep2) {
            btnBackToStep2.addEventListener('click', function () {
                step3.classList.remove('active');
                step2.classList.add('active');

                ind3.classList.remove('active');
                ind2.classList.remove('completed');
                ind2.classList.add('active');
                if (line2) line2.classList.remove('completed');

                window.scrollTo({ top: checkoutContainer.offsetTop - 20, behavior: 'smooth' });
            });
        }

        // Complete Order & WhatsApp Dispatch (Saved to Database)
        if (btnCompleteOrder) {
            btnCompleteOrder.addEventListener('click', function () {
                const custName = document.getElementById('custName')?.value?.trim() || '';
                const custPhone = document.getElementById('custWhatsapp')?.value?.trim() || '';
                const custEmail = document.getElementById('custEmail')?.value?.trim() || '';
                const custOrg = document.getElementById('custOrg')?.value?.trim() || '';
                const orderNotes = document.getElementById('orderNotes')?.value?.trim() || '';
                const selectedPayment = document.querySelector('input[name="payment_scheme"]:checked')?.value === 'dp30' ? 'DP 30%' : 'Lunas 100%';
                const totalBill = summaryTotal?.textContent || '0';

                if (!custName || !custPhone || !custEmail) {
                    alert('Silakan lengkapi data pemesan (Nama, No HP/WA, dan Email) sebelum konfirmasi.');
                    return;
                }

                const originalBtnText = btnCompleteOrder.innerHTML;
                btnCompleteOrder.disabled = true;
                btnCompleteOrder.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan Pesanan...';

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                               || document.querySelector('input[name="_token"]')?.value;

                const payload = {
                    paket_slug: pkgData.slug,
                    nama_paket: pkgData.name,
                    kota_keberangkatan: selectedCityName,
                    tanggal_keberangkatan: departureDate.value ? formatIndoDate(departureDate.value) : '-',
                    titik_kumpul: meetingPoint.value,
                    jumlah_peserta: parseInt(inputParticipants.value) || 1,
                    catatan: orderNotes || null,
                    nama_pemesan: custName,
                    nomor_hp: custPhone,
                    email_pemesan: custEmail,
                    nama_instansi: custOrg || null,
                    skema_pembayaran: selectedPayment,
                    total_pembayaran: totalBill
                };

                fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    const waMessage = 
`*KONFIRMASI PESANAN - GO TRAVEL*
----------------------------------------
*Paket:* ${pkgData.name}
*Kota Asal:* ${selectedCityName}
*Tgl Berangkat:* ${formatIndoDate(departureDate.value)}
*Jam Berangkat:* ${departureTime.value}
*Meeting Point:* ${meetingPoint.value}
*Peserta:* ${inputParticipants.value} Orang
----------------------------------------
*DATA PEMESAN:*
*Nama:* ${custName}
*WhatsApp:* ${custPhone}
*Email:* ${custEmail}
*Instansi/Grup:* ${custOrg || '-'}
*Catatan:* ${orderNotes || '-'}
*Skema Pembayaran:* ${selectedPayment}
----------------------------------------
*TOTAL TAGIHAN:* ${totalBill}
----------------------------------------
Mohon info ketersediaan armada & instruksi transfer selanjutnya. Terima kasih!`;

                    const waUrl = `https://wa.me/6283821382635?text=${encodeURIComponent(waMessage)}`;
                    
                    alert('Pesanan Anda berhasil dikonfirmasi dan tersimpan di database! Anda akan diarahkan ke WhatsApp untuk verifikasi armada.');
                    window.open(waUrl, '_blank');
                    window.location.href = '/profile';
                })
                .catch(err => {
                    console.error('Error saving order:', err);
                    alert('Pesanan Anda tetap diproses via WhatsApp.');
                    const waUrl = `https://wa.me/6283821382635`;
                    window.open(waUrl, '_blank');
                })
                .finally(() => {
                    btnCompleteOrder.disabled = false;
                    btnCompleteOrder.innerHTML = originalBtnText;
                });
            });
        }
    }

    // User Profile Dropdown Menu Toggle
    const userMenuToggle = document.getElementById('userMenuToggle');
    const userDropdownMenu = document.getElementById('userDropdownMenu');

    if (userMenuToggle && userDropdownMenu) {
        userMenuToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            const isShown = userDropdownMenu.style.display === 'block';
            userDropdownMenu.style.display = isShown ? 'none' : 'block';
        });

        document.addEventListener('click', function (e) {
            if (!userMenuToggle.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userDropdownMenu.style.display = 'none';
            }
        });
    }
});

// 6. Form Submit Handler (Hubungi Kami -> Saved to Database)
function handleFormSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn ? submitBtn.innerHTML : 'Kirim Pesan';
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                   || form.querySelector('input[name="_token"]')?.value;

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
    }

    const formData = new FormData(form);

    fetch('/contact', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const name = form.nama_lengkap.value;
            alert(`Terima kasih ${name}, pesan Anda telah tersimpan dan terkirim! Tim Go Travel akan segera menghubungi Anda.`);
            form.reset();
        } else {
            alert(data.message || 'Terjadi kesalahan saat mengirim pesan.');
        }
    })
    .catch(err => {
        console.error('Error submitting contact form:', err);
        alert('Terima kasih, pesan Anda telah diterima! Tim kami akan segera merespon.');
        form.reset();
    })
    .finally(() => {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    });
}

/**
 * ========================================================
 * WISHLIST GLOBAL HANDLERS & ASYNC SYNCHRONIZATION
 * ========================================================
 */

function showWishlistToast(message, type = 'info') {
    let container = document.getElementById('globalToastContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'globalToastContainer';
        container.style.cssText = 'position:fixed;top:24px;right:24px;z-index:99999;display:flex;flex-direction:column;gap:12px;pointer-events:none;max-width:380px;width:calc(100% - 48px);';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    const isSuccess = type === 'success';
    const isError = type === 'error';
    const borderColor = isSuccess ? '#ea580c' : (isError ? '#ef4444' : '#0284c7');
    const iconClass = isSuccess ? 'fa-heart' : (isError ? 'fa-circle-exclamation' : 'fa-circle-info');
    const iconColor = borderColor;

    toast.style.cssText = `background:#ffffff;color:#0f172a;border-radius:16px;padding:14px 18px;box-shadow:0 12px 32px rgba(15,23,42,0.18);display:flex;align-items:center;gap:12px;border-left:5px solid ${borderColor};font-size:13.5px;font-weight:600;pointer-events:auto;transform:translateX(120%);opacity:0;transition:all 0.3s cubic-bezier(0.16,1,0.3,1);font-family:inherit;`;
    toast.innerHTML = `
        <i class="fa-solid ${iconClass}" style="color:${iconColor};font-size:18px;flex-shrink:0;"></i>
        <div style="flex:1;line-height:1.4;">${message}</div>
    `;

    container.appendChild(toast);

    requestAnimationFrame(() => {
        toast.style.transform = 'translateX(0)';
        toast.style.opacity = '1';
    });

    setTimeout(() => {
        toast.style.transform = 'translateX(120%)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 350);
    }, 3500);
}

function updateHeartIconState(btn, isActive) {
    if (isActive) {
        btn.classList.add('active');
        const icon = btn.querySelector('i');
        if (icon) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid');
            icon.style.color = '#ef4444';
        }
    } else {
        btn.classList.remove('active');
        const icon = btn.querySelector('i');
        if (icon) {
            icon.classList.remove('fa-solid');
            icon.classList.add('fa-regular');
            icon.style.color = '';
        }
    }
}

async function toggleWishlist(btnElement, packageIdentifier) {
    if (!packageIdentifier) {
        if (btnElement) {
            packageIdentifier = btnElement.getAttribute('data-slug') || btnElement.getAttribute('data-id');
        }
    }

    if (!packageIdentifier) {
        showWishlistToast('Identifikasi paket wisata tidak ditemukan.', 'error');
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    try {
        if (btnElement) {
            btnElement.style.pointerEvents = 'none';
            btnElement.style.transform = 'scale(0.85)';
        }

        const response = await fetch('/wishlist/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ slug: packageIdentifier })
        });

        const data = await response.json();

        if (response.status === 401 || data.logged_in === false) {
            showWishlistToast('Silakan login terlebih dahulu untuk menyimpan paket ke wishlist!', 'error');
            setTimeout(() => {
                if (window.location.pathname !== '/login') {
                    window.location.href = '/login?redirect=' + encodeURIComponent(window.location.href);
                }
            }, 1200);
            return;
        }

        if (data.success) {
            const isAdded = data.status === 'added';
            const allMatchingButtons = document.querySelectorAll(`.wishlist-btn[data-slug="${data.slug}"], .wishlist-btn[data-id="${data.package_id}"]`);
            
            allMatchingButtons.forEach(btn => updateHeartIconState(btn, isAdded));
            if (btnElement && !allMatchingButtons.length) {
                updateHeartIconState(btnElement, isAdded);
            }

            showWishlistToast(data.message, isAdded ? 'success' : 'info');

            // Dispatch global event agar halaman profil atau admin dapat mengupdate list tanpa refresh
            window.dispatchEvent(new CustomEvent('wishlist-updated', { detail: data }));
        } else {
            showWishlistToast(data.message || 'Gagal memperbarui wishlist.', 'error');
        }
    } catch (err) {
        console.error('Wishlist toggle error:', err);
        showWishlistToast('Terjadi kesalahan jaringan saat memperbarui wishlist.', 'error');
    } finally {
        if (btnElement) {
            btnElement.style.pointerEvents = '';
            btnElement.style.transform = '';
        }
    }
}

async function initWishlistStates() {
    try {
        const response = await fetch('/wishlist/user-ids', {
            headers: { 'Accept': 'application/json' }
        });
        if (!response.ok) return;

        const data = await response.json();
        if (!data.logged_in || !Array.isArray(data.wishlist_slugs)) return;

        const activeSlugs = new Set(data.wishlist_slugs.map(s => String(s).toLowerCase()));
        const activeIds = new Set((data.wishlist_ids || []).map(id => String(id)));

        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            const slug = (btn.getAttribute('data-slug') || '').toLowerCase();
            const id = String(btn.getAttribute('data-id') || '');

            if ((slug && activeSlugs.has(slug)) || (id && activeIds.has(id))) {
                updateHeartIconState(btn, true);
            } else {
                updateHeartIconState(btn, false);
            }
        });
    } catch (err) {
        // Silently fail if guest or offline
    }
}

