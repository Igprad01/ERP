<x-layouts::tailadmin title="Category">
    <x-card-table>
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Category</h1>
        </div>

        <form action="{{ route('category.update', $edit->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Nama Kategori -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Nama Kategori
                </label>
                <input type="text" name="nama" id="nama"
                    class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                    value="{{ old('nama', $edit->nama) }}" required>
            </div>

            <!-- Warna -->
            <div>
                <label for="warna" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Warna
                </label>
                <input type="text" name="warna" id="warna"
                    class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                    value="{{ old('warna', $edit->warna) }}">
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Deskripsi
                </label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition resize-none">{{ old('deskripsi', $edit->deskripsi) }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-800">
                <a href="{{ route('category') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 cursor-pointer shadow-sm transition">
                    Update
                </button>
            </div>
        </form>
    </x-card-table>
</x-layouts::tailadmin>
