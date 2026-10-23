<x-layouts::tailadmin title="Keuangan">
    <x-card-table>
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Keuangan</h1>
            <a href="{{ route('finansial.create') }}"
                class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 cursor-pointer shadow-sm transition">
                Tambah Transaksi
            </a>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('finansial') }}"
            class="mb-6 flex flex-wrap items-end gap-3">
            <div>
                <label for="transaksi_type" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe</label>
                <select name="transaksi_type" id="transaksi_type"
                    class="rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-white focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition">
                    <option value="">Semua</option>
                    <option value="income" {{ request('transaksi_type') === 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ request('transaksi_type') === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                    <option value="transfer" {{ request('transaksi_type') === 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
            </div>
            <div>
                <label for="bulan" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Bulan</label>
                <select name="bulan" id="bulan"
                    class="rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-white focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition">
                    <option value="">Semua</option>
                    @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $nama)
                        <option value="{{ $i + 1 }}" {{ request('bulan') == $i + 1 ? 'selected' : '' }}>{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tahun" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
                <select name="tahun" id="tahun"
                    class="rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm text-gray-900 dark:text-white focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition">
                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit"
                class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600 cursor-pointer shadow-sm transition">
                Filter
            </button>
            <a href="{{ route('finansial') }}"
                class="px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                Reset
            </a>
        </form>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Ref</th>
                        <th class="px-4 py-3">Tipe</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Akun</th>
                        <th class="px-4 py-3 text-right">Nominal</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($finansials as $item)
                        <tr>
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $item->transaksi_date?->format('d M Y') ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->reference_number }}</td>
                            <td class="px-4 py-3">
                                <span @class([
                                    'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium',
                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' => $item->transaksi_type === 'income',
                                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' => $item->transaksi_type === 'expense',
                                    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' => $item->transaksi_type === 'transfer',
                                ])>{{ $item->transaksi_type }}</span>
                            </td>
                            <td class="px-4 py-3">{{ $item->category?->nama ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $item->account?->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-right">Rp {{ number_format($item->total_cost, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $item->status }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('finansial.edit', $item->id) }}"
                                        class="text-brand-500 hover:underline text-sm">Edit</a>
                                    <form action="{{ route('finansial.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="cursor-pointer text-red-500 hover:underline text-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-gray-400">Belum ada data transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $finansials->links() }}
        </div>
    </x-card-table>
</x-layouts::tailadmin>