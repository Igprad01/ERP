<x-layouts::tailadmin title="Keuangan">
    <x-card-table>
        {{-- Header --}}
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Keuangan List</h1>
            <a href="{{ route('finansial.create') }}"
                class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                Tambah
            </a>
        </div>

        {{-- Filter --}}
        <div class="mb-4 flex gap-4">
            <select name="transaksi_type" wire:model.defer="transaksi_type"
                class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                onchange="this.form.submit()">
                <option value="">Semua Tipe</option>
                <option value="income" {{ request('transaksi_type') === 'income' ? 'selected' : '' }}>Pemasukan</option>
                <option value="expense" {{ request('transaksi_type') === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                <option value="transfer" {{ request('transaksi_type') === 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>

            <select name="bulan" wire:model.defer="bulan"
                class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                onchange="this.form.submit()">
                <option value="">Semua Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromDate(null, $i, 1)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- Tabel Data Keuangan --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Ref</th>
                        <th scope="col" class="px-6 py-3">Tipe</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Akun</th>
                        <th scope="col" class="px-6 py-3">Nominal</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($finansials as $item)
                        <tr>
                            <td class="px-6 py-3">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3">{{ $item->transaksi_date ? \Carbon\Carbon::parse($item->transaksi_date)->format('d M Y') : '-' }}</td>
                            <td class="px-6 py-3">{{ $item->reference_number }}</td>
                            <td class="px-6 py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $item->transaksi_type === 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : ($item->transaksi_type === 'expense' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300') }}">
                                    {{ $item->transaksi_type }}
                                </span>
                            </td>
                            <td class="px-6 py-3">{{ $item->category?->nama ?? '-' }}</td>
                            <td class="px-6 py-3">{{ $item->account?->nama ?? '-' }}</td>
                            <td class="px-6 py-3">{{ number_format($item->total_cost, 2, ',', '.') }}</td>
                            <td class="px-6 py-3">{{ $item->status }}</td>
                            <td class="px-6 py-3">
                                <a href="{{ route('finansial.edit', $item->id) }}"
                                    class="text-brand-500 hover:underline mr-2">Edit</a>

                                <form action="{{ route('finansial.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">Belum ada data transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $finansials->links() }}
        </div>
    </x-card-table>
</x-layouts::tailadmin>