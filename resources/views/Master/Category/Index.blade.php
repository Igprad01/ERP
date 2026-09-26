<x-layouts::tailadmin title="Category">
    <x-card-table>
        {{-- Header --}}
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Category List</h1>
            <a href="#"
                class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                Tambah
            </a>
        </div>

        {{-- Tabel Data Kategori --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama Kategori</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-900">
                        <td class="px-6 py-4">1</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">Elektronik</td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a> |
                            <a href="#" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    {{-- Looping data kategori dari database nantinya taruh sini --}}
                </tbody>
            </table>
        </div>
    </x-card-table>
</x-layouts::tailadmin>
