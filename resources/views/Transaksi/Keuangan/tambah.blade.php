<x-layouts::tailadmin title="Tambah Transaksi">
    <x-card-table>
        <div class="mb-6">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">Tambah Transaksi</h1>
        </div>

        <form action="{{ route('finansial.store') }}" method="POST" x-data="{
            transaksiType: '{{ old('transaksi_type', 'income') }}'
        }">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-5">

                {{-- ===== KOLOM KIRI: Info Transaksi ===== --}}
                <div class="space-y-5">
                    <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-700 pb-2">
                        Info Transaksi
                    </h2>

                    <div>
                        <label for="reference_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nomor Referensi</label>
                        <input type="text" name="reference_number" id="reference_number"
                            value="{{ old('reference_number') }}"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                        @error('reference_number')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="transaksi_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tanggal Transaksi</label>
                        <input type="date" name="transaksi_date" id="transaksi_date"
                            value="{{ old('transaksi_date', date('Y-m-d')) }}"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition">
                        @error('transaksi_date')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="transaksi_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tipe Transaksi</label>
                        <select name="transaksi_type" id="transaksi_type" x-model="transaksiType"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                            <option value="income">Pemasukan</option>
                            <option value="expense">Pengeluaran</option>
                            <option value="transfer">Transfer</option>
                        </select>
                        @error('transaksi_type')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nama }} ({{ $cat->type }})
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Tipe Kategori</label>
                        <select name="type" id="type"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                            <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                        @error('type')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="periode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Periode</label>
                        <select name="periode" id="periode"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                            <option value="daily" {{ old('periode') === 'daily' ? 'selected' : '' }}>Harian</option>
                            <option value="weekly" {{ old('periode') === 'weekly' ? 'selected' : '' }}>Mingguan</option>
                            <option value="monthly" {{ old('periode') === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                            <option value="yearly" {{ old('periode') === 'yearly' ? 'selected' : '' }}>Tahunan</option>
                        </select>
                        @error('periode')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                            <option value="Pending" {{ old('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Done" {{ old('status') === 'Done' ? 'selected' : '' }}>Done</option>
                            <option value="Batal" {{ old('status') === 'Batal' ? 'selected' : '' }}>Batal</option>
                            <option value="Belum Dijalankan" {{ old('status') === 'Belum Dijalankan' ? 'selected' : '' }}>Belum Dijalankan</option>
                        </select>
                        @error('status')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- ===== KOLOM KANAN: Akun & Nominal ===== --}}
                <div class="space-y-5">
                    <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase border-b border-gray-200 dark:border-gray-700 pb-2">
                        Akun & Nominal
                    </h2>

                    <div>
                        <label for="account_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Akun Sumber</label>
                        <select name="account_id" id="account_id"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                            <option value="">Pilih Akun</option>
                            @foreach ($accounts as $acc)
                                <option value="{{ $acc->id }}" {{ old('account_id') == $acc->id ? 'selected' : '' }}>
                                    {{ $acc->nama }} ({{ $acc->type }}) — Rp {{ number_format($acc->saldo, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('account_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div x-show="transaksiType === 'transfer'" x-transition x-cloak>
                        <label for="account_to_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Akun Tujuan</label>
                        <select name="account_to_id" id="account_to_id"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition">
                            <option value="">Pilih Akun Tujuan</option>
                            @foreach ($accounts as $acc)
                                <option value="{{ $acc->id }}" {{ old('account_to_id') == $acc->id ? 'selected' : '' }}>
                                    {{ $acc->nama }} ({{ $acc->type }}) — Rp {{ number_format($acc->saldo, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('account_to_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="mekanisme_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Mekanisme Pembayaran</label>
                        <input type="text" name="mekanisme_pembayaran" id="mekanisme_pembayaran"
                            value="{{ old('mekanisme_pembayaran') }}"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                        @error('mekanisme_pembayaran')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="total_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Total Biaya (Rp)</label>
                        <input type="number" name="total_cost" id="total_cost" step="0.01" min="0"
                            value="{{ old('total_cost') }}"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition"
                            required>
                        @error('total_cost')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="catatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Catatan</label>
                        <textarea name="catatan" id="catatan" rows="3"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition resize-none">{{ old('catatan') }}</textarea>
                        @error('catatan')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- ===== OPSIONAL (span dua kolom) ===== --}}
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase mb-4">Opsional</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-5">
                    <div>
                        <label for="goal_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Target Tabungan</label>
                        <select name="goal_id" id="goal_id"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition">
                            <option value="">Tidak ada</option>
                            @foreach ($goals as $goal)
                                <option value="{{ $goal->id }}" {{ old('goal_id') == $goal->id ? 'selected' : '' }}>
                                    {{ $goal->nama }} — Rp {{ number_format($goal->target_amount, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('goal_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="debt_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Utang / Piutang</label>
                        <select name="debt_id" id="debt_id"
                            class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2.5 text-sm text-gray-900 dark:text-white shadow-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500 outline-none transition">
                            <option value="">Tidak ada</option>
                            @foreach ($debts as $debt)
                                <option value="{{ $debt->id }}" {{ old('debt_id') == $debt->id ? 'selected' : '' }}>
                                    {{ $debt->nama }} ({{ $debt->type }}) — Sisa Rp {{ number_format($debt->sisa_amount, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('debt_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- ===== Tombol ===== --}}
            <div class="flex items-center justify-end gap-3 mt-8 pt-4 border-t border-gray-200 dark:border-gray-800">
                <a href="{{ route('finansial') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 cursor-pointer shadow-sm transition">
                    Simpan
                </button>
            </div>
        </form>
    </x-card-table>
</x-layouts::tailadmin>