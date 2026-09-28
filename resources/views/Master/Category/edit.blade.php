<x-layouts::tailadmin title="Category">
    <x-card-table>
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Edit Category</h1>
        </div>
        <form action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nama
                    Kategori</label>
                <input type="text" name="nama" id="nama"
                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900"
                    value="{{ $edit->nama }}">
            </div>
            <div class="mb-4">
                <label for="warna" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Warna</label>
                <input type="text" name="warna" id="warna"
                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900"
                    value="{{ $edit->warna }}">
            </div>
            <div class="mb-4">
                <label for="deskripsi"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-400">Deskripsi</label>
                <input type="text" name="deskripsi" id="deskripsi"
                    class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900"
                    value="{{ $edit->deskripsi }}">
            </div>
            <div class="mb-4">
                <button type="submit"
                    class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">Update</button>
            </div>
        </form>
    </x-card-table>
</x-layouts::tailadmin>
