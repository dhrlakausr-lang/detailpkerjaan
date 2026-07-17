const modal = document.getElementById("applyModal");
const openButtons = document.querySelectorAll(".open-apply");
const closeButton = document.querySelector(".close-modal");
const saveButtons = document.querySelectorAll(".js-save");
const shareButton = document.querySelector(".js-share");
const shareMenu = document.querySelector(".js-share-menu");
const copyLinkButton = document.querySelector(".js-copy-link");
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

saveButtons.forEach((saveButton) => {
    saveButton.addEventListener("click", async (event) => {
        event.preventDefault();
        event.stopPropagation();

        const token = document.querySelector("meta[name='csrf-token']")?.content;
        const icon = saveButton.querySelector("i");

        try {
            const response = await fetch(saveButton.dataset.toggleUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token || ""
                },
                body: JSON.stringify({
                    source_type: saveButton.dataset.sourceType,
                    source_id: saveButton.dataset.sourceId
                })
            });

            const data = await response.json();

            if (response.status === 401 && data.redirect) {
                window.location.href = data.redirect;
                return;
            }

            if (!response.ok) {
                showToast(data.message || "Lowongan gagal disimpan.");
                return;
            }

            saveButton.classList.toggle("is-saved", data.saved);
            saveButton.setAttribute("aria-label", data.saved ? "Lowongan tersimpan" : "Simpan lowongan");

            if (icon) {
                icon.className = `${data.saved ? "fa-solid" : "fa-regular"} fa-bookmark`;
            }

            showToast(data.message);
        } catch (error) {
            showToast("Koneksi gagal. Coba lagi.");
        }
    });
});

if (shareButton) {
    shareButton.addEventListener("click", (event) => {
        event.stopPropagation();

        if (!shareMenu) {
            return;
        }

        const isOpen = !shareMenu.classList.contains("hidden");
        shareMenu.classList.toggle("hidden", isOpen);
        shareButton.setAttribute("aria-expanded", isOpen ? "false" : "true");
    });
}

if (shareMenu) {
    shareMenu.addEventListener("click", (event) => {
        event.stopPropagation();
    });
}

if (copyLinkButton) {
    copyLinkButton.addEventListener("click", async () => {
        const url = copyLinkButton.dataset.url || window.location.href;

        if (navigator.clipboard) {
            await navigator.clipboard.writeText(url);
            showToast("Link lowongan disalin.");
        } else {
            showToast("Salin URL dari address bar untuk membagikan.");
        }

        if (shareMenu) {
            shareMenu.classList.add("hidden");
            shareButton?.setAttribute("aria-expanded", "false");
        }
    });
}

document.addEventListener("click", () => {
    if (shareMenu) {
        shareMenu.classList.add("hidden");
        shareButton?.setAttribute("aria-expanded", "false");
    }
});

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
