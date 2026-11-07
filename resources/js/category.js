document.addEventListener("DOMContentLoaded", () => {
    const inputWarna = document.getElementById("warna");
    const colorPicker = document.getElementById("color_picker");
    const badgePreview = document.getElementById("badge-preview");
    const swatches = document.querySelectorAll(".btn-swatch");

    // Warna teks kontras untuk latar hex terang/gelap
    function readableColor(hex) {
        const n = parseInt(hex.slice(1), 16);
        const l = (n >> 16 & 255) * 0.299 + (n >> 8 & 255) * 0.587 + (n & 255) * 0.114;
        return l > 160 ? "#111827" : "#ffffff";
    }

    // Fungsi untuk memperbarui tampilan badge preview
    function updateBadge(bgColor, textColor) {
        const isHex = /^#[0-9a-f]{6}$/i.test(bgColor);
        const fg = textColor || (isHex ? readableColor(bgColor) : "#ffffff");

        if (inputWarna) {
            inputWarna.value = bgColor;
            inputWarna.style.backgroundColor = isHex ? bgColor : "";
            inputWarna.style.color = isHex ? fg : "";
            inputWarna.style.borderColor = isHex ? bgColor : "";
        }
        if (colorPicker && isHex) colorPicker.value = bgColor;

        if (badgePreview) {
            badgePreview.style.backgroundColor = bgColor;
            badgePreview.style.color = fg;
        }
    }

    // Event 3: Ubah warna dari native HTML color picker
    if (colorPicker) {
        colorPicker.addEventListener("change", (e) => {
            updateBadge(e.target.value);
        });
    }

    // Inisialisasi awal saat halaman dimuat (jika ada value lama / edit mode)
    if (inputWarna && inputWarna.value) {
        updateBadge(inputWarna.value);
    }
});
