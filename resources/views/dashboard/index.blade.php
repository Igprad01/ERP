<x-layouts::tailadmin title="Dashboard">
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        {{-- Ringkasan — ganti dengan data asli saat fitur menyusul --}}
        @foreach (['Total Produk', 'Stok Menipis', 'Penjualan Hari Ini', 'Transaksi Tertunda'] as $i => $label)
            <div
                class="col-span-12 rounded-2xl border border-gray-200 bg-white p-5 shadow-theme-sm sm:col-span-6 xl:col-span-3 dark:border-gray-800 dark:bg-white/[0.03]">
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $label }}</p>
                <p class="mt-2 text-2xl font-semibold text-gray-900 dark:text-white">—</p>
                <p class="mt-1 text-xs text-gray-400">Fitur menyusul</p>
            </div>
        @endforeach

        {{-- Slot konten utama — isi dengan chart/tabel modul nanti --}}
        <div
            class="col-span-12 rounded-2xl border border-dashed border-gray-300 bg-white p-10 text-center shadow-theme-sm dark:border-gray-700 dark:bg-white/[0.03]">
            <p class="text-base font-medium text-gray-800 dark:text-white">Area konten siap</p>
            <p class="mx-auto mt-1 max-w-md text-sm text-gray-500 dark:text-gray-400">
                Shell dashboard TailAdmin sudah terpasang (sidebar + header + dark mode).
                Taruh chart, tabel, atau modul ERP di file ini — <code
                    class="rounded bg-gray-100 px-1 dark:bg-white/10">resources/views/dashboard/index.blade.php</code>.
            </p>
        </div>
    </div>
</x-layouts::tailadmin>
