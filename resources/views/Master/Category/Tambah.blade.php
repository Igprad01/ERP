<x-layouts::tailadmin title="Tambah Kategori">
    <x-card>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nama" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Nama
                    Kategori</label>
                <input type="text" id="nama" name="nama" class="w-full rounded-lg border border-gray-300 p-2"
                    required>
            </div>
            <div class="mb-6">
                <label for="warna" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Warna</label>
                <input type="text" id="warna" name="warna" class="w-full rounded-lg border border-gray-300 p-2"
                    required>
            </div>
            <div class="mb-6">
                <label for="deskripsi"
                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                <input type="text" id="deskripsi" name="deskripsi"
                    class="w-full rounded-lg border border-gray-300 p-2" required>
            </div>
            <button type="submit"
                class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                Tambah
            </button>
        </form>
    </x-card>
</x-layouts::tailadmin>
