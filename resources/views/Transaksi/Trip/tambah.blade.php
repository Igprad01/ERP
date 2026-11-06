<x-layouts::tailadmin title="Tambah Trip">
    <x-card-table>
        <div class="mb-6 border-b border-gray-100 pb-4 dark:border-slate-800">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Tambah Trip</h3>
        </div>

        <form action="" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="trip" class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Nama
                    Trip</label>
                <input type="text" name="trip" id="trip"
                    class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white">
            </div>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                <div>
                    <label for="trip2" class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Tanggal
                        Mulai</label>
                    <input type="date" name="trip2" id="trip2"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white">
                </div>
                <div>
                    <label for="trip2" class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Tanggal
                        Akhir</label>
                    <input type="date" name="trip2" id="trip2"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white">
                </div>
                <div>
                    <label for="trip" class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Lokasi
                        Destinasi</label>
                    <input type="google-maps" name="trip" id="trip"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white">
                </div>
                <div>
                    <label for="trip2"
                        class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Estimasi Anggaran</label>
                    <input type="text" name="trip2" id="trip2"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white">
                </div>
                <div>
                    <label for="trip"
                        class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Kategori Trip</label>
                    <select name="mekanisme_pembayaran" id="mekanisme_pembayaran"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                        required>
                        <option value="">Kategori Trip</option>
                    </select>
                </div>
                <div>
                    <label for="trip" class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Status
                        Perjalanan</label>
                    <select name="mekanisme_pembayaran" id="mekanisme_pembayaran"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                        required>
                        <option value="">Kategori Trip</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="trip"
                    class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Catatan</label>
                <textarea name="#" id=""
                    class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"></textarea>
            </div>
            <div class="flex items-center justify-end gap-3 mt-8 pt-4">
                <a href="{{ route('finansial') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 cursor-pointer shadow-sm transition">
                    Simpan
                </button>
            </div>
        </form>
    </x-card-table>
</x-layouts::tailadmin>
