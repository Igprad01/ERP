<x-layouts::tailadmin title="Tambah Trip">
    <x-card-table>
        <div class="mb-6 border-b border-gray-100 pb-4 dark:border-slate-800">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white">Tambah Trip</h3>
        </div>

        <form action="{{ route('trip.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="aktivitas" class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Nama
                    Trip</label>
                <input type="text" name="aktivitas" id="aktivitas" value="{{ old('aktivitas') }}" maxlength="255"
                    placeholder="Contoh: Liburan ke Bali, Kunjungan Kerja Jogja"
                    class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                    required>
                @error('aktivitas')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-span-1 lg:col-span-3">
                <div class="flex items-center justify-between mb-2">
                    <label for="lokasi" class="block text-sm font-bold text-gray-700 dark:text-slate-200">
                        Lokasi Destinasi
                    </label>
                    <button type="button" id="btn-toggle-map"
                        class="flex items-center gap-1.5 text-xs font-semibold text-brand-500 hover:text-brand-600 dark:text-brand-400 transition cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        <span id="btn-map-label">Buka Peta</span>
                    </button>
                </div>

                <div class="relative">
                    <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 dark:text-slate-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" maxlength="255"
                        placeholder="Cari tempat atau destinasi (contoh: Monas, Kuta Bali)..."
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white pl-11 pr-28 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                        autocomplete="off">
                    <button type="button" id="btn-current-location" title="Gunakan lokasi saya saat ini"
                        class="absolute inset-y-2 right-2 flex items-center gap-1 rounded-lg bg-gray-100 dark:bg-slate-800 px-3 text-xs font-semibold text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-700 transition cursor-pointer">
                        <svg class="h-3.5 w-3.5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>GPS</span>
                    </button>
                    <div id="location-suggestions"
                        class="absolute left-0 right-0 top-full z-50 mt-1 hidden max-h-60 overflow-y-auto rounded-xl border border-gray-200 bg-white py-1 shadow-lg dark:border-slate-800 dark:bg-slate-900">
                    </div>
                </div>
                @error('lokasi')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                <div id="map-container"
                    class="mt-3 hidden overflow-hidden rounded-xl border border-gray-200 dark:border-slate-800 shadow-sm transition-all">
                    <div
                        class="flex items-center justify-between bg-gray-50 dark:bg-slate-800/80 px-4 py-2 border-b border-gray-200 dark:border-slate-800 text-xs text-gray-600 dark:text-slate-300">
                        <span class="flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                            Klik pada peta atau geser pin merah untuk menandai lokasi destinasi
                        </span>
                    </div>
                    <div id="google-map" class="h-72 w-full bg-gray-100 dark:bg-slate-950"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                <div>
                    <label for="tanggal_mulai"
                        class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Tanggal
                        Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                        value="{{ old('tanggal_mulai', date('Y-m-d')) }}"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                        required>
                    @error('tanggal_mulai')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_akhir"
                        class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Tanggal
                        Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir') }}"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                        required>
                    @error('tanggal_akhir')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="orang" class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Jumlah
                        Orang / Peserta</label>
                    <input type="text" name="orang" id="orang" value="{{ old('orang') }}"
                        placeholder="Contoh: 2 Orang, Keluarga"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white">
                    @error('orang')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_akhir"
                        class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Estimasi
                        Anggaran</label>
                    <input type="text" name="estimasi_anggaran" id="estimasi_anggaran" value=""
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                        required>
                </div>
                <div>
                    <label for="status"
                        class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Status
                        Perjalanan</label>
                    <select name="status" id="status"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                        required>
                        <option value="">Pilih Status</option>
                        @foreach ($status as $statuss)
                            <option value="{{ $statuss }}"
                                {{ old('status', 'Belum Dijalankan') == $statuss ? 'selected' : '' }}>
                                {{ $statuss }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="category_id"
                        class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Kategori Trip</label>
                    <select name="category_id" id="category_id"
                        class="h-[52px] w-full rounded-xl border border-gray-300 bg-white px-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white"
                        required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="catatan"
                    class="mb-2 block text-sm font-bold text-gray-700 dark:text-slate-200">Catatan</label>
                <textarea name="catatan" id="catatan" rows="3" placeholder="Catatan tambahan seputar trip..."
                    class="w-full rounded-xl border border-gray-300 bg-white p-4 text-sm font-medium text-gray-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 focus:outline-none dark:border-slate-800 dark:bg-slate-900 dark:text-white">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 mt-8 pt-4">
                <a href="{{ route('trip') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    Batal
                </a>
                <button type="submit"
                    class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 cursor-pointer shadow-sm transition">
                    Simpan
                </button>
            </div>
        </form>

        <script>
            window.GOOGLE_MAPS_API_KEY = "{{ config('services.google_maps.api_key') }}";
        </script>
        @vite('resources/js/trip.js')
    </x-card-table>
</x-layouts::tailadmin>
