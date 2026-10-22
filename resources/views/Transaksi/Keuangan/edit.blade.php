<x-layouts::tailadmin title="Edit Transaksi">
    <x-card-table>
        <form action="{{ route('finansial.update', $finansial->id) }}" method="POST" x-data="{
            transaksiType: '{{ $finansial->transaksi_type }}',
            showAccountTo: transaksiType === 'transfer'
        }" x-init="showAccountTo = transaksiType === 'transfer'">
            @csrf
            @method('PUT')

            {{-- Nomor Referensi --}}
            <div class="mb-4">
                <label for="reference_number" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Nomor Referensi
                </label>
                <input type="text" id="reference_number" name="reference_number"
                    value="{{ old('reference_number', $finansial->reference_number) }}"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                @error('reference_number')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Transaksi --}}
            <div class="mb-4">
                <label for="transaksi_date" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Tanggal Transaksi
                </label>
                <input type="date" id="transaksi_date" name="transaksi_date"
                    value="{{ old('transaksi_date', $finansial->transaksi_date ? \Carbon\Carbon::parse($finansial->transaksi_date)->format('Y-m-d') : '') }}"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800">
                @error('transaksi_date')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipe Transaksi --}}
            <div class="mb-4">
                <label for="transaksi_type" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Tipe Transaksi
                </label>
                <select id="transaksi_type" name="transaksi_type" x-model="transaksiType"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                    <option value="income" {{ $finansial->transaksi_type === 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ $finansial->transaksi_type === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                    <option value="transfer" {{ $finansial->transaksi_type === 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
                @error('transaksi_type')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Akun Sumber --}}
            <div class="mb-4">
                <label for="account_id" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Akun Sumber
                </label>
                <select id="account_id" name="account_id"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                    <option value="">Pilih Akun</option>
                    @foreach ($accounts as $acc)
                        <option value="{{ $acc->id }}" {{ old('account_id', $finansial->account_id) == $acc->id ? 'selected' : '' }}>
                            {{ $acc->nama }} ({{ $acc->type }}) - Saldo: {{ number_format($acc->saldo, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('account_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Akun Tujuan (hanya untuk Transfer) --}}
            <div class="mb-4" x-show="showAccountTo" x-transition>
                <label for="account_to_id" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Akun Tujuan
                </label>
                <select id="account_to_id" name="account_to_id"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800">
                    <option value="">Pilih Akun Tujuan</option>
                    @foreach ($accounts as $acc)
                        <option value="{{ $acc->id }}" {{ old('account_to_id', $finansial->account_to_id) == $acc->id ? 'selected' : '' }}>
                            {{ $acc->nama }} ({{ $acc->type }}) - Saldo: {{ number_format($acc->saldo, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('account_to_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label for="category_id" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Kategori
                </label>
                <select id="category_id" name="category_id"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $finansial->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama }} ({{ $cat->type }})
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Target Tabungan (Opsional) --}}
            <div class="mb-4">
                <label for="goal_id" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Target Tabungan (Opsional)
                </label>
                <select id="goal_id" name="goal_id"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800">
                    <option value="">Tidak ada</option>
                    @foreach ($goals as $goal)
                        <option value="{{ $goal->id }}" {{ old('goal_id', $finansial->goal_id) == $goal->id ? 'selected' : '' }}>
                            {{ $goal->nama }} - Target: {{ number_format($goal->target_amount, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('goal_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Utang/Piutang (Opsional) --}}
            <div class="mb-4">
                <label for="debt_id" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Utang/Piutang (Opsional)
                </label>
                <select id="debt_id" name="debt_id"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800">
                    <option value="">Tidak ada</option>
                    @foreach ($debts as $debt)
                        <option value="{{ $debt->id }}" {{ old('debt_id', $finansial->debt_id) == $debt->id ? 'selected' : '' }}>
                            {{ $debt->nama }} ({{ $debt->type }}) - Sisa: {{ number_format($debt->sisa_amount, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('debt_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Periode --}}
            <div class="mb-4">
                <label for="periode" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Periode
                </label>
                <select id="periode" name="periode"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                    <option value="daily" {{ $finansial->periode === 'daily' ? 'selected' : '' }}>Harian</option>
                    <option value="weekly" {{ $finansial->periode === 'weekly' ? 'selected' : '' }}>Mingguan</option>
                    <option value="monthly" {{ $finansial->periode === 'monthly' ? 'selected' : '' }}>Bulanan</option>
                    <option value="yearly" {{ $finansial->periode === 'yearly' ? 'selected' : '' }}>Tahunan</option>
                </select>
                @error('periode')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Status
                </label>
                <select id="status" name="status"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                    <option value="Pending" {{ $finansial->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Done" {{ $finansial->status === 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="Batal" {{ $finansial->status === 'Batal' ? 'selected' : '' }}>Batal</option>
                    <option value="Belum Dijalankan" {{ $finansial->status === 'Belum Dijalankan' ? 'selected' : '' }}>Belum Dijalankan</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tipe Kategori --}}
            <div class="mb-4">
                <label for="type" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Tipe Kategori
                </label>
                <select id="type" name="type"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                    <option value="income" {{ $finansial->type === 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ $finansial->type === 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Mekanisme Pembayaran --}}
            <div class="mb-4">
                <label for="mekanisme_pembayaran" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Mekanisme Pembayaran
                </label>
                <input type="text" id="mekanisme_pembayaran" name="mekanisme_pembayaran"
                    value="{{ old('mekanisme_pembayaran', $finansial->mekanisme_pembayaran) }}"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                @error('mekanisme_pembayaran')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Total Biaya --}}
            <div class="mb-4">
                <label for="total_cost" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Total Biaya
                </label>
                <input type="number" step="0.01" min="0" id="total_cost" name="total_cost"
                    value="{{ old('total_cost', $finansial->total_cost) }}"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800"
                    required>
                @error('total_cost')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Catatan --}}
            <div class="mb-4">
                <label for="catatan" class="mb-1 block text-sm font-medium text-gray-900 dark:text-white">
                    Catatan
                </label>
                <textarea id="catatan" name="catatan" rows="3"
                    class="w-full rounded-lg border border-gray-300 p-2 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-gray-600 dark:bg-gray-800">{{ old('catatan', $finansial->catatan) }}</textarea>
                @error('catatan')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                    Update
                </button>
                <a href="{{ route('finansial') }}"
                    class="rounded-lg bg-gray-500 px-4 py-2 text-sm font-medium text-white hover:bg-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </x-card-table>
</x-layouts::tailadmin>