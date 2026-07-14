// ====== Auto-submit filter saat radio/select berubah ======
document.querySelectorAll(".js-submit").forEach(function (el) {
    el.addEventListener("change", function () {
        const form = document.getElementById("filterForm");
        if (form) form.submit();
    });
});

// ====== Lamar (apply) via fetch ======
document.querySelectorAll(".apply-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
        const id = btn.dataset.id;
        const posisi = btn.dataset.posisi;
        const lokasi = btn.dataset.lokasi;

        if (!confirm(`Yakin ingin melamar sebagai ${posisi} di ${lokasi}?`)) return;

        const token = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        const params = new URLSearchParams();
        params.append("id_lowongan", id);
        params.append("posisi", posisi);
        params.append("lokasi", lokasi);

        const original = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = "Mengirim...";

        fetch("/apply", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "X-CSRF-TOKEN": token,
                "X-Requested-With": "XMLHttpRequest",
            },
            body: params.toString(),
        })
            .then((res) => res.text())
            .then((data) => {
                let payload = null;
                try {
                    payload = JSON.parse(data);
                } catch (e) {
                    payload = null;
                }

                if (payload && payload.redirect) {
                    window.location.href = payload.redirect;
                    return;
                }

                if ((payload && payload.status === "success") || data.trim() === "success") {
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Terkirim';
                    btn.classList.add("applied");
                    alert("Lamaran berhasil dikirim! 🎉");
                } else {
                    btn.disabled = false;
                    btn.innerHTML = original;
                    alert("Gagal mengirim lamaran.");
                }
            })
            .catch(() => {
                btn.disabled = false;
                btn.innerHTML = original;
                alert("Terjadi kesalahan jaringan.");
            });
    });
});
