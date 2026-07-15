// AUTOCOMPLETE
(function () {
    const input    = document.getElementById('searchKeyword');
    const dropdown = document.getElementById('autocompleteDropdown');
    if (!input || !dropdown) return;

    const data = window.allLowongan || [];
    let focusedIndex = -1;

    function highlight(text, keyword) {
        if (!keyword) return text;
        const regex = new RegExp(`(${keyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }

    function renderDropdown(keyword) {
        focusedIndex = -1;
        if (!keyword.trim()) { closeDropdown(); return; }

        const kw = keyword.toLowerCase();
        const matches = data.filter(item =>
            item.posisi.toLowerCase().includes(kw) ||
            (item.kategori && item.kategori.toLowerCase().includes(kw)) ||
            item.lokasi.toLowerCase().includes(kw)
        ).slice(0, 6);

        if (matches.length === 0) {
            dropdown.innerHTML = `<div class="autocomplete-empty"><i class="fas fa-search" style="margin-right:6px"></i>Tidak ada hasil untuk "<strong>${keyword}</strong>"</div>`;
        } else {
            dropdown.innerHTML = matches.map((item, i) => `
                <div class="autocomplete-item" data-posisi="${item.posisi}" data-index="${i}">
                    <img src="${item.gambar}" alt="${item.posisi}" onerror="this.style.display='none'">
                    <div class="autocomplete-info">
                        <strong>${highlight(item.posisi, keyword)}</strong>
                        <span><i class="fas fa-map-marker-alt" style="color:#2563eb;margin-right:4px"></i>${item.lokasi}
                        ${item.kategori ? ` &nbsp;·&nbsp; ${item.kategori}` : ''}</span>
                    </div>
                    <i class="fas fa-arrow-right" style="color:#cbd5e1;font-size:12px"></i>
                </div>
            `).join('');

            dropdown.querySelectorAll('.autocomplete-item').forEach(el => {
                el.addEventListener('mousedown', function (e) {
                    e.preventDefault();
                    selectItem(this.dataset.posisi);
                });
            });
        }

        dropdown.classList.add('show');
    }

    function selectItem(posisi) {
        input.value = posisi;
        closeDropdown();
        filterJobs();
        document.getElementById('lowongan')?.scrollIntoView({ behavior: 'smooth' });
    }

    function closeDropdown() {
        dropdown.classList.remove('show');
        dropdown.innerHTML = '';
        focusedIndex = -1;
    }

    input.addEventListener('input', () => renderDropdown(input.value));
    input.addEventListener('blur', () => setTimeout(closeDropdown, 150));
    input.addEventListener('focus', () => { if (input.value) renderDropdown(input.value); });

    // Keyboard navigation
    input.addEventListener('keydown', function (e) {
        const items = dropdown.querySelectorAll('.autocomplete-item');
        if (!items.length) {
            if (e.key === 'Enter') { doSearch(); closeDropdown(); }
            return;
        }
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            focusedIndex = Math.min(focusedIndex + 1, items.length - 1);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            focusedIndex = Math.max(focusedIndex - 1, -1);
        } else if (e.key === 'Enter') {
            e.preventDefault();
            if (focusedIndex >= 0) selectItem(items[focusedIndex].dataset.posisi);
            else { doSearch(); closeDropdown(); }
            return;
        } else if (e.key === 'Escape') {
            closeDropdown(); return;
        }
        items.forEach((el, i) => el.classList.toggle('focused', i === focusedIndex));
        if (focusedIndex >= 0) items[focusedIndex].scrollIntoView({ block: 'nearest' });
    });
})();

// Kategori filter
const kategoriCards = document.querySelectorAll('.kategori-card');
const jobCards = document.querySelectorAll('.job-card');
let activeKategori = '';

function categoryMatches(kat, active) {
    if (!active) return true;

    const aliases = {
        administrasi: ['administrasi', 'admin'],
        teknik: ['teknik', 'teknisi'],
        keuangan: ['keuangan', 'akuntansi', 'akutansi'],
        it: ['it', 'tech', 'teknologi'],
        marketing: ['marketing', 'digital marketing'],
        retail: ['retail'],
        'human resource': ['human resource', 'hr', 'recruiter']
    };

    const terms = aliases[active] || [active];
    return terms.some(term => kat.includes(term));
}

function filterJobs() {
    const keyword = (document.getElementById('searchKeyword')?.value || '').toLowerCase();
    const lokasi  = (document.getElementById('searchLokasi')?.value  || '').toLowerCase();

    jobCards.forEach(card => {
        const title = card.querySelector('.job-title')?.innerText.toLowerCase() || '';
        const city  = card.querySelector('.job-meta')?.innerText.toLowerCase()  || '';
        const kat   = card.dataset.kategori || '';

        const match =
            title.includes(keyword) &&
            city.includes(lokasi) &&
            categoryMatches(kat, activeKategori);

        card.style.display = match ? '' : 'none';
    });
}

window.doSearch = function () {
    filterJobs();

    const section = document.getElementById('lowongan');
    if (!section) return;

    // Animasi tombol
    const btn = document.querySelector('.btn-search');
    if (btn) {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari...';
        btn.disabled = true;
        setTimeout(() => {
            btn.innerHTML = 'Cari Kerja';
            btn.disabled = false;
        }, 900);
    }

    // Scroll smooth ke section lowongan dengan delay kecil
    setTimeout(() => {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Animasi pulse pada section setelah scroll tiba
        setTimeout(() => {
            section.classList.add('section-highlight');
            setTimeout(() => section.classList.remove('section-highlight'), 1000);
        }, 700);
    }, 400);
};

kategoriCards.forEach(card => {
    card.addEventListener('click', () => {
        kategoriCards.forEach(c => c.classList.remove('active'));
        card.classList.add('active');
        activeKategori = card.dataset.kategori;

        // scroll ke lowongan
        document.getElementById('lowongan')?.scrollIntoView({ behavior: 'smooth' });
        filterJobs();
    });
});

// Navbar lokasi select
document.getElementById('navLokasi')?.addEventListener('change', function () {
    const el = document.getElementById('searchLokasi');
    if (el) el.value = this.value;
    filterJobs();
});

// Apply button
document.querySelectorAll('.btn-apply').forEach(btn => {
    btn.addEventListener('click', function () {
        const id      = this.dataset.id;
        const posisi  = this.dataset.posisi;
        const lokasi  = this.dataset.lokasi;

        if (!confirm(`Yakin ingin melamar sebagai ${posisi} di ${lokasi}?`)) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch(window.lokerinajaApplyUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': csrfToken || ''
            },
            body: `id_lowongan=${id}`
        })
        .then(r => r.json())
        .then(data => {
            if (data.redirect) {
                window.location.href = data.redirect;
                return;
            }

            if (data.status === 'success') {
                showToast('Lamaran berhasil dikirim!', 'success');
            } else {
                showToast('Gagal mengirim lamaran.', 'error');
            }
        })
        .catch(() => showToast('Terjadi kesalahan, coba lagi.', 'error'));
    });
});

// Featured cards
document.querySelectorAll('.featured-card').forEach(card => {
    card.addEventListener('click', () => {
        showToast('Fitur detail lowongan segera hadir!', 'info');
    });
});

// Footer helpers
window.showInfo = function(msg) {
    showToast(msg, 'info');
};

window.scrollToSection = function(id) {
    document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
};

window.subscribeEmail = function(e) {
    e.preventDefault();
    const input = document.getElementById('subscribeInput');
    if (input?.value) {
        showToast('Terima kasih! Email ' + input.value + ' berhasil didaftarkan.', 'success');
        input.value = '';
    }
};

// Toast notification
function showToast(msg, type = 'success') {
    const existing = document.getElementById('toast');
    if (existing) existing.remove();

    const colors = {
        success: '#16a34a',
        error:   '#dc2626',
        info:    '#2563eb'
    };

    const toast = document.createElement('div');
    toast.id = 'toast';
    toast.textContent = msg;
    Object.assign(toast.style, {
        position:     'fixed',
        bottom:       '90px',
        right:        '24px',
        background:   colors[type] || colors.success,
        color:        'white',
        padding:      '14px 22px',
        borderRadius: '12px',
        fontFamily:   'Plus Jakarta Sans, sans-serif',
        fontWeight:   '600',
        fontSize:     '14px',
        boxShadow:    '0 8px 24px rgba(0,0,0,.2)',
        zIndex:       '9999',
        opacity:      '0',
        transform:    'translateY(10px)',
        transition:   'all .3s ease'
    });

    document.body.appendChild(toast);
    requestAnimationFrame(() => {
        toast.style.opacity  = '1';
        toast.style.transform = 'translateY(0)';
    });

    setTimeout(() => {
        toast.style.opacity   = '0';
        toast.style.transform = 'translateY(10px)';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
