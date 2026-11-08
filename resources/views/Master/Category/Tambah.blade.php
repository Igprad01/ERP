<x-layouts::tailadmin title="Tambah Kategori">
    <x-card-table>
        <div class="mb-6 border-b border-gray-100 pb-4 dark:border-slate-800">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Tambah Kategori</h3>
        </div>
        <form action="{{ route('category.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="nama"
                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-slate-300">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                    placeholder="e.g. Hiking, Kuliner, Kereta Api"
                    class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 placeholder-gray-400 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder-slate-500"
                    required>
                @error('nama')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label
                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-slate-300">
                    Pilih Warna Badge <span class="text-red-500">*</span>
                </label>
                <!-- Color Inputs -->
                <div class="flex items-center gap-3">
                    <input type="color" id="color_picker" value="{{ old('warna', '#3b82f6') }}"
                        class="h-9 w-12 cursor-pointer rounded border border-gray-300 bg-transparent p-1 dark:border-slate-700">
                    <input type="text" id="warna" name="warna" value="{{ old('warna', '#3b82f6') }}"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm text-gray-900 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                        required readonly>
                </div>
                @error('warna')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi"
                    class="mb-2 block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-slate-300">
                    Deskripsi <span class="text-xs text-gray-400 font-normal">(Opsional)</span>
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Catatan atau keterangan kategori..."
                    class="w-full rounded-lg border border-gray-300 bg-white p-3 text-sm text-gray-900 placeholder-gray-400 focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500/20 dark:border-slate-700 dark:bg-slate-900 dark:text-white dark:placeholder-slate-500">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4">
                <a href="{{ route('category') }}"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-slate-400 dark:hover:bg-slate-800 transition">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-brand-500 px-5 py-2 text-sm font-medium text-white shadow-md hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/30 transition">
                    Tambah
                </button>
            </div>
        </form>
        @vite(['resources/js/category.js', 'resources/js/alert.js'])
    </x-card-table>
</x-layouts::tailadmin>
