<x-layouts::tailadmin title="Tambah Activity">
    <x-card-table>
        <div class="mb-6 border-b border-gray-100 pb-4 dark:border-slate-800">
            <h3 class="text-base font-bold text-gray-900 dark:text-white">Detail Trip</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-slate-400">Nama Aktivitas</label>
                <div
                    class="h-[52px] flex items-center w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm font-medium text-gray-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                    {{ $trip->aktivitas ?? '-' }}
                </div>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-slate-400">Tanggal</label>
                <div
                    class="h-[52px] flex items-center w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm font-medium text-gray-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                    {{ \Carbon\Carbon::parse($trip->tanggal_mulai)->format('d M Y') }}
                    &rarr;
                    {{ \Carbon\Carbon::parse($trip->tanggal_akhir)->format('d M Y') }}
                </div>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-slate-400">Lokasi</label>
                <div
                    class="h-[52px] flex items-center w-full rounded-xl border border-gray-200 bg-gray-50 px-4 text-sm font-medium text-gray-900 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                    {{ $trip->lokasi ?? '-' }}
                </div>
            </div>
        </div>
    </x-card-table>

    <x-card-table class="mt-6">
        <div>
            <h3 class="text-base font-bold text-gray-900 dark:text-white">test</h3>
        </div>
    </x-card-table>
</x-layouts::tailadmin>
