<x-layouts::tailadmin title="Trip">
    <x-card-table>
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Trip List</h1>
            <a href="{{ route('trip.tambah') }}"
                class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                Tambah
            </a>
        </div>


        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
                        <th scope="col" class="px-6 py-3">Tanggal Berakhir</th>
                        <th scope="col" class="px-6 py-3"> Aktivitas</th>
                        <th scope="col" class="px-6 py-3">Lokasi</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($trip as $item)
                        <tr>
                            <td class="px-6 py-3">{{ $item->id }}</td>
                            <td class="px-6 py-3">{{ $item->tanggal_mulai }}</td>
                            <td class="px-6 py-3">{{ $item->tanggal_akhir }}</td>
                            <td class="px-6 py-3">{{ $item->aktivitas }}</td>
                            <td class="px-6 py-3">{{ $item->lokasi }}</td>
                            <td class="px-6 py-3">
                                <a href="#">Detail</a>
                                <a href="#">Edit</a>
                                <a href="#">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card-table>
</x-layouts::tailadmin>
