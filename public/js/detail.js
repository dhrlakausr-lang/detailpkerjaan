const modal = document.getElementById("applyModal");
const openButtons = document.querySelectorAll(".open-apply");
const closeButton = document.querySelector(".close-modal");
const saveButton = document.querySelector(".js-save");
const shareButton = document.querySelector(".js-share");
const reportButton = document.querySelector(".report-btn");
const profileTrigger = document.querySelector(".profile-trigger");
const profileMenu = document.getElementById("profileMenu");
const backButton = document.querySelector(".js-back");
const firstInput = modal ? modal.querySelector("input[name='username']") : null;

function showToast(message) {
    const oldToast = document.querySelector(".toast");

    if (oldToast) {
        oldToast.remove();
    }

    const toast = document.createElement("div");
    toast.className = "toast";
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 2400);
}

function openModal() {
    if (!modal) {
        return;
    }

    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    document.body.classList.add("modal-open");

    setTimeout(() => {
        if (firstInput) {
            firstInput.focus();
        }
    }, 80);
}

function closeModal() {
    if (!modal) {
        return;
    }

    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("modal-open");
}

openButtons.forEach((button) => {
    button.addEventListener("click", openModal);
});

if (closeButton) {
    closeButton.addEventListener("click", closeModal);
}

if (modal) {
    modal.addEventListener("click", (event) => {
        if (event.target === modal) {
            closeModal();
        }
    });
}

document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
        closeModal();
    }
});

if (saveButton) {
    saveButton.addEventListener("click", () => {
        saveButton.classList.toggle("is-saved");
        const saved = saveButton.classList.contains("is-saved");
        saveButton.setAttribute("aria-label", saved ? "Lowongan tersimpan" : "Simpan lowongan");
        showToast(saved ? "Lowongan disimpan." : "Lowongan dihapus dari simpanan.");
    });
}

if (shareButton) {
    shareButton.addEventListener("click", async () => {
        const shareData = {
            title: document.title,
            text: "Cek lowongan kerja ini.",
            url: window.location.href
        };

        if (navigator.share) {
            try {
                await navigator.share(shareData);
                return;
            } catch (error) {
                if (error.name === "AbortError") {
                    return;
                }
            }
        }

        if (navigator.clipboard) {
            await navigator.clipboard.writeText(window.location.href);
            showToast("Link lowongan disalin.");
            return;
        }

        showToast("Salin URL dari address bar untuk membagikan.");
    });
}

if (reportButton) {
    reportButton.addEventListener("click", () => {
        showToast("Terima kasih. Laporan kamu akan ditinjau.");
    });
}

if (backButton) {
    backButton.addEventListener("click", () => {
        if (window.history.length > 1) {
            window.history.back();
            return;
        }

        window.location.href = "/";
    });
}

if (profileTrigger && profileMenu) {
    profileTrigger.addEventListener("click", (event) => {
        event.stopPropagation();
        const isOpen = profileMenu.classList.toggle("is-open");
        profileTrigger.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });

    profileMenu.addEventListener("click", (event) => {
        event.stopPropagation();
    });

    document.addEventListener("click", () => {
        profileMenu.classList.remove("is-open");
        profileTrigger.setAttribute("aria-expanded", "false");
    });
}
