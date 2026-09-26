<aside :class="sidebarToggle ? 'translate-x-0 xl:w-22.5' : '-translate-x-full rtl:translate-x-full'"
    class="fixed top-0 left-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-auto border-r border-gray-200 bg-white px-5 transition-all duration-300 xl:static xl:translate-x-0 dark:border-gray-800 dark:bg-black"
    @click.outside="if (window.innerWidth < 1280) sidebarToggle = false">
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'" class="flex items-center gap-2 pt-8 pb-7">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5" :class="sidebarToggle ? 'hidden' : ''">
            <span
                class="flex size-9 items-center justify-center rounded-lg bg-brand-500 text-lg font-bold text-white">P</span>
            <span class="text-xl font-semibold text-gray-900 dark:text-white">{{ config('app.name') }}</span>
        </a>
        <span :class="sidebarToggle ? 'lg:block' : 'hidden'"
            class="hidden size-9 items-center justify-center rounded-lg bg-brand-500 text-lg font-bold text-white">P</span>
    </div>

    <div class="no-scrollbar flex flex-1 flex-col overflow-y-auto duration-300 ease-linear">
        <nav x-data="{ selected: 'Dashboard' }">
            <div>
                <ul class="mb-6 flex flex-col gap-1">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="menu-item group {{ request()->routeIs('dashboard') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <svg class="{{ request()->routeIs('dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM15 3.25C13.7574 3.25 12.75 4.25736 12.75 5.5V8.99998C12.75 10.2426 13.7574 11.25 15 11.25H18.5C19.7426 11.25 20.75 10.2426 20.75 8.99998V5.5C20.75 4.25736 19.7426 3.25 18.5 3.25H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15Z"
                                    fill="currentColor" />
                            </svg>
                            <span :class="sidebarToggle ? 'xl:hidden' : ''">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Menu Dropdown Groups --}}
            @php
                $menuGroups = [
                    'Master' => [
                        'icon' => 'M4 4h7v7H4V4zm11 0h5v5h-5V4zm-4 9H4v7h7v-7zm4 4h5v3h-5v-3z',
                        'items' => [
                            [
                                'title' => 'Kategori',
                                'route' => 'category',
                            ],
                            'Produk',
                            'Supplier',
                        ],
                    ],
                    'Transaksi' => [
                        'icon' => 'M7 4v16m0 0l-4-4m4 4l4-4m6 4V4m0 0l4 4m-4-4l-4 4',
                        'items' => ['Penjualan', 'Pembelian'],
                    ],
                    'Laporan' => [
                        'icon' => '<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"/>',
                        'items' => ['Laporan Stok', 'Laporan Keuangan'],
                    ],
                ];
            @endphp

            @foreach ($menuGroups as $group => $data)
                <div x-data="{ open: false }" class="mb-1">

                    {{-- Menu Group --}}
                    <button type="button" @click="open = !open"
                        class="menu-item group menu-item-inactive flex w-full items-center justify-between text-left">
                        {{-- Icon + Label --}}
                        <div class="flex min-w-0 items-center gap-3">
                            <svg class="menu-item-icon-inactive shrink-0" width="22" height="22"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                {!! $data['icon'] !!}
                            </svg>

                            <span :class="sidebarToggle ? 'xl:hidden' : ''" class="flex-1 truncate">
                                {{ $group }}
                            </span>
                        </div>

                        {{-- Dropdown Arrow --}}
                        <svg :class="[
                            open ? 'rotate-180 text-brand-500' : 'text-gray-400',
                            sidebarToggle ? 'xl:hidden' : ''
                        ]"
                            class="h-5 w-5 shrink-0 transition-transform duration-200" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 9.5L12 14.5L17 9.5" stroke="currentColor" stroke-width="2.2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    {{-- Dropdown Items --}}
                    <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-1" class="mt-1 flex flex-col gap-1 pl-[34px]"
                        :class="sidebarToggle ? 'xl:hidden' : ''" style="display: none;">
                        @foreach ($data['items'] as $item)
                            <li>
                                @if (is_array($item))
                                    <a href="{{ route($item['route']) }}"
                                        class="menu-item group menu-item-inactive flex items-center py-2 text-sm">
                                        <span class="flex-1">
                                            {{ $item['title'] }}
                                        </span>
                                    </a>
                                @else
                                    <span
                                        class="menu-item group menu-item-inactive flex cursor-not-allowed items-center py-2 text-sm opacity-60"
                                        title="Fitur menyusul">
                                        <span class="flex-1">
                                            {{ $item }}
                                        </span>

                                        <span
                                            class="rounded-full bg-gray-100 px-2 py-0.5 text-[11px] font-medium text-gray-500 dark:bg-white/10 dark:text-gray-400">
                                            Segera
                                        </span>
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                </div>
            @endforeach
            <div>
                <h3 class="mb-4 text-xs leading-5 text-gray-400 uppercase">
                    <span :class="sidebarToggle ? 'xl:hidden' : ''">Akun</span>
                </h3>
                <ul class="mb-6 flex flex-col gap-1" :class="sidebarToggle ? 'xl:hidden' : ''">
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="menu-item group {{ request()->routeIs('profile.*') ? 'menu-item-active' : 'menu-item-inactive' }}">
                            <svg class="{{ request()->routeIs('profile.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}"
                                width="22" height="22" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="8" r="3.5" stroke="currentColor"
                                    stroke-width="1.5" />
                                <path d="M5 20c1.2-3.2 3.8-5 7-5s5.8 1.8 7 5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" />
                            </svg>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="border-t border-gray-200 py-4 dark:border-gray-800" :class="sidebarToggle ? 'xl:hidden' : ''">
        <div class="flex items-center gap-3">
            <span
                class="flex size-9 shrink-0 items-center justify-center rounded-full bg-brand-50 text-sm font-semibold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </span>
            <div class="min-w-0 flex-1 leading-tight">
                <p class="truncate text-sm font-medium text-gray-800 dark:text-white">
                    {{ auth()->user()->name ?? 'Pengguna' }}</p>
                <p class="truncate text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email ?? '' }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" title="Keluar">
                @csrf
                <button type="submit"
                    class="flex size-9 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 12H4m0 0 3.5-3.5M4 12l3.5 3.5M10 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h4"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14 5.5 19.5 12 14 18.5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
