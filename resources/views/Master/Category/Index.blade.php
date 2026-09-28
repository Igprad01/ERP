<x-layouts::tailadmin title="Category">
    <x-card-table>
        {{-- Header --}}
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Category List</h1>
            <a href="{{ route('category.create') }}"
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
                        <th scope="col" class="px-6 py-3">warna</th>
                        <th scope="col" class="px-6 py-3">Deskripsi</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($viewkategori as $item)
                        <tr>
                            <td class="px-6 py-3">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3">{{ $item->nama }}</td>
                            <td class="px-6 py-3">{{ $item->warna }}</td>
                            <td class="px-6 py-3">{{ $item->deskripsi }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('category.edit', $item->id) }}">Edit</a>

                                <form action="{{ route('category.destroy', $item->id) }}" method="POST" @csrf
                                    @method('DELETE') <button type="submit" class="cursor-pointer">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card-table>
</x-layouts::tailadmin>
