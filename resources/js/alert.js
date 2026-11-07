const ICONS = {
    success: [
        "text-emerald-500",
        "M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z",
    ],
    error: [
        "text-rose-500",
        "m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z",
    ],
    warning: [
        "text-amber-500",
        "M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z",
    ],
    info: [
        "text-blue-500",
        "m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z",
    ],
};
ICONS.danger = ICONS.error;
const icon = (type) => {
    const [color, d] = ICONS[type] ?? ICONS.info;
    return `<svg class="w-5 h-5 ${color} shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="${d}"/></svg>`;
};
const box = (id, className) => {
    let el = document.getElementById(id);
    if (el) return el;
    el = document.createElement("div");
    Object.assign(el, { id, className });
    return document.body.appendChild(el);
};
const reveal = (el, hidden, visible) =>
    requestAnimationFrame(() => {
        el.classList.remove(...hidden);
        el.classList.add(...visible);
    });
class AlertMaster {
    toast(message, type = "success", duration = 4000) {
        const item = document.createElement("div");
        item.className =
            "pointer-events-auto flex items-start gap-3 w-full p-4 rounded-xl shadow-xl border border-gray-200 dark:border-slate-800 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md transform transition-all duration-300 translate-y-[-10px] opacity-0 text-sm font-medium text-gray-800 dark:text-gray-100";
        item.innerHTML = `${icon(type)}<div class="flex-1 text-sm leading-relaxed">${message}</div><button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition cursor-pointer"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg></button>`;
        box(
            "global-toast-container",
            "fixed top-5 right-5 z-[99999] flex flex-col gap-3 pointer-events-none max-w-sm w-full px-4",
        ).appendChild(item);
        reveal(
            item,
            ["translate-y-[-10px]", "opacity-0"],
            ["translate-y-0", "opacity-100"],
        );

        const dismiss = () => {
            item.classList.add("opacity-0", "translate-x-full");
            setTimeout(() => item.remove(), 250);
        };
        item.querySelector("button").onclick = dismiss;
        if (duration > 0) setTimeout(dismiss, duration);
    }

    success(message, duration = 4000) {
        this.toast(message, "success", duration);
    }
    error(message, duration = 4000) {
        this.toast(message, "error", duration);
    }
    warning(message, duration = 4000) {
        this.toast(message, "warning", duration);
    }
    info(message, duration = 4000) {
        this.toast(message, "info", duration);
    }

    confirm({
        title = "Apakah Anda yakin?",
        text = "Tindakan ini tidak dapat dibatalkan.",
        confirmText = "Konfirmasi",
        cancelText = "Batal",
        type = "danger",
    } = {}) {
        const backdrop = document.createElement("div");
        backdrop.className =
            "fixed inset-0 bg-gray-900/60 backdrop-blur-xs transition-opacity duration-200 opacity-0 flex items-center justify-center p-4";
        backdrop.innerHTML = `<div class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white dark:bg-slate-900 p-6 text-left shadow-2xl transition-all duration-200 scale-95 opacity-0 border border-gray-100 dark:border-slate-800">
            <div class="flex items-center gap-3"><div class="p-2.5 rounded-xl ${type === "danger" ? "bg-rose-50 dark:bg-rose-950/50" : "bg-blue-50 dark:bg-blue-950/50"}">${icon(type)}</div><h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">${title}</h3></div>
            <div class="mt-3 text-sm text-gray-600 dark:text-slate-300 leading-relaxed">${text}</div>
            <div class="mt-6 flex justify-end gap-3"><button type="button" id="alert-cancel-btn" class="rounded-xl px-4 py-2 text-sm font-medium text-gray-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-800 transition cursor-pointer">${cancelText}</button><button type="button" id="alert-confirm-btn" class="rounded-xl px-4 py-2 text-sm font-medium shadow-md transition cursor-pointer ${type === "danger" ? "bg-rose-600 hover:bg-rose-700 text-white shadow-rose-500/20" : "bg-brand-500 hover:bg-brand-600 text-white shadow-brand-500/20"}">${confirmText}</button></div>
        </div>`;
        box("global-modal-container", "relative z-[99999]").appendChild(
            backdrop,
        );

        const dialog = backdrop.firstElementChild;
        reveal(backdrop, ["opacity-0"], ["opacity-100"]);
        reveal(dialog, ["scale-95", "opacity-0"], ["scale-100", "opacity-100"]);
        return new Promise((resolve) => {
            const close = (result) => {
                backdrop.classList.add("opacity-0");
                dialog.classList.add("scale-95", "opacity-0");
                setTimeout(() => {
                    backdrop.remove();
                    resolve(result);
                }, 150);
            };
            backdrop.querySelector("#alert-cancel-btn").onclick = () =>
                close(false);
            backdrop.querySelector("#alert-confirm-btn").onclick = () =>
                close(true);
        });
    }
}

const Alert = new AlertMaster();
window.Alert = Alert;

const settings = (el, fallback) => ({
    title: el.getAttribute('data-confirm-title') || fallback.title,
    text: el.getAttribute('data-confirm')?.trim() || fallback.text,
    confirmText: el.getAttribute('data-confirm-btn') || fallback.confirmText,
    type: el.getAttribute('data-confirm-type') || fallback.type,
});

const CONFIRM = {
    delete: { title: 'Konfirmasi Hapus Data', text: 'Data yang dihapus tidak dapat dipulihkan kembali. Anda yakin?', confirmText: 'Ya, Hapus', type: 'danger' },
    logout: { title: 'Konfirmasi Logout', text: 'Apakah Anda ingin keluar dari aplikasi?', confirmText: 'Ya, Keluar', type: 'danger' },
    save: { title: 'Konfirmasi Simpan Data', text: 'Apakah data yang diisi sudah benar dan ingin disimpan?', confirmText: 'Simpan', type: 'info' },
};

const actionType = (form) => {
    const action = (form.getAttribute('action') ?? '').toLowerCase();
    if (form.querySelector('input[name="_method"][value="DELETE"]') || /delete|destroy/.test(action)) return 'delete';
    return /logout|sign-?out/.test(action) ? 'logout' : 'save';
};

document.addEventListener("DOMContentLoaded", () => {
    document.addEventListener("submit", async (e) => {
        const form = e.target;
        if (
            form?.tagName !== "FORM" ||
            form.dataset.confirmed === "true" ||
            form.hasAttribute("data-no-confirm")
        )
            return;
        e.preventDefault();
        const opts = settings(form, CONFIRM[actionType(form)]);
        if (!(await Alert.confirm(opts))) return Alert.info("Aksi dibatalkan.");
        form.dataset.confirmed = "true";
        form.submit();
    });

    document.addEventListener("click", async (e) => {
        const trigger = e.target.closest("[data-confirm]");
        if (
            !trigger ||
            trigger.tagName === "FORM" ||
            (trigger.type === "submit" && trigger.form) ||
            trigger.dataset.confirmed === "true"
        )
            return;
        e.preventDefault();
        const opts = settings(trigger, {
            title: "Konfirmasi Tindakan",
            text: "Apakah Anda yakin ingin melanjutkan tindakan ini?",
            confirmText: "Lanjutkan",
            type: "info",
        });
        if (!(await Alert.confirm(opts))) return;
        trigger.dataset.confirmed = "true";
        if (trigger.tagName === "A" && trigger.href)
            window.location.href = trigger.href;
        else trigger.click();
    });
});

export default Alert;
