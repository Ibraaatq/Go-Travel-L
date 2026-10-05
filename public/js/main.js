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

    // 2. Wishlist Heart Button Interactive Toggle
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            this.classList.toggle('active');
            const heartIcon = this.querySelector('i');
            if (heartIcon) {
                if (this.classList.contains('active')) {
                    heartIcon.classList.remove('fa-regular');
                    heartIcon.classList.add('fa-solid');
                } else {
                    heartIcon.classList.remove('fa-solid');
                    heartIcon.classList.add('fa-regular');
                }
            }
        });
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

        // Complete Order & WhatsApp Dispatch
        if (btnCompleteOrder) {
            btnCompleteOrder.addEventListener('click', function () {
                const custName = document.getElementById('custName')?.value || '-';
                const custPhone = document.getElementById('custWhatsapp')?.value || '-';
                const custEmail = document.getElementById('custEmail')?.value || '-';
                const custOrg = document.getElementById('custOrg')?.value || '-';
                const orderNotes = document.getElementById('orderNotes')?.value || '-';
                const selectedPayment = document.querySelector('input[name="payment_scheme"]:checked')?.value === 'dp30' ? 'DP 30%' : 'Lunas 100%';
                const totalBill = summaryTotal?.textContent || '-';

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
*Instansi/Grup:* ${custOrg}
*Catatan:* ${orderNotes}
*Skema Pembayaran:* ${selectedPayment}
----------------------------------------
*TOTAL TAGIHAN:* ${totalBill}
----------------------------------------
Mohon info ketersediaan armada & instruksi transfer selanjutnya. Terima kasih!`;

                const waUrl = `https://wa.me/6283821382635?text=${encodeURIComponent(waMessage)}`;
                window.open(waUrl, '_blank');
            });
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
    }
});

// 6. Form Submit Handler (Demo / Notification)
function handleFormSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const name = form.nama_lengkap.value;
    
    alert(`Terima kasih ${name}, pesan Anda telah terkirim! Tim Go Travel akan segera menghubungi Anda.`);
    form.reset();
}
