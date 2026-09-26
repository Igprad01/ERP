<header x-data="{ menuToggle: false }"
    class="sticky top-0 z-999 flex w-full border-gray-200 bg-white xl:border-b dark:border-gray-800 dark:bg-gray-900">
    <div class="flex grow flex-col items-center justify-between xl:flex-row xl:px-6">
        <div
            class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:py-4 xl:justify-normal xl:border-b-0 xl:px-0 dark:border-gray-800">
            <button
                :class="sidebarToggle ? 'bg-gray-100 xl:bg-transparent dark:bg-gray-800 dark:xl:bg-transparent' : ''"
                class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 xl:h-11 xl:w-11 xl:border dark:border-gray-800 dark:text-gray-400"
                @click.stop="sidebarToggle = !sidebarToggle" aria-label="Toggle sidebar">
                <svg class="hidden fill-current xl:block" width="16" height="12" viewBox="0 0 16 12" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z"
                        fill="" />
                </svg>
                <svg :class="sidebarToggle ? 'hidden' : 'block xl:hidden'" class="fill-current xl:hidden" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.25 6C3.25 5.58579 3.58579 5.25 4 5.25L20 5.25C20.4142 5.25 20.75 5.58579 20.75 6C20.75 6.41421 20.4142 6.75 20 6.75L4 6.75C3.58579 6.75 3.25 6.41422 3.25 6ZM3.25 18C3.25 17.5858 3.58579 17.25 4 17.25L20 17.25C20.4142 17.25 20.75 17.5858 20.75 18C20.75 18.4142 20.4142 18.75 20 18.75L4 18.75C3.58579 18.75 3.25 18.4142 3.25 18ZM4 11.25C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75L12 12.75C12.4142 12.75 12.75 12.4142 12.75 12C12.75 11.5858 12.4142 11.25 12 11.25L4 11.25Z"
                        fill="" />
                </svg>
                <svg :class="sidebarToggle ? 'block xl:hidden' : 'hidden'" class="fill-current" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z"
                        fill="" />
                </svg>
            </button>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 xl:hidden">
                <span
                    class="flex size-8 items-center justify-center rounded-lg bg-brand-500 text-base font-bold text-white">P</span>
                <span class="text-lg font-semibold text-gray-900 dark:text-white">PERP</span>
            </a>

            <button
                class="hidden h-11 w-11 items-center justify-center rounded-lg border border-gray-200 text-gray-500 xl:hidden dark:border-gray-800 dark:text-gray-400"
                @click="menuToggle = !menuToggle" aria-label="Toggle menu">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 5h15M2.5 10h15M2.5 15h15" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" />
                </svg>
            </button>

            <div class="hidden xl:block">
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $title ?? 'Dashboard' }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Selamat datang kembali,
                    {{ auth()->user()->name ?? 'Admin' }}</p>
            </div>

            <div :class="menuToggle ? 'flex' : 'hidden'"
                class="w-full flex-col items-center gap-4 xl:ml-auto xl:w-auto xl:flex xl:flex-row xl:justify-end">
                <button @click="darkMode = !darkMode" aria-label="Toggle dark mode"
                    class="flex size-10 items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/5">
                    <svg x-show="!darkMode" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 3v1m0 16v1m8.5-8.5h-1M4.5 12h-1m15.1 5.1-.7-.7M5.6 5.6l-.7-.7m12.5 0-.7.7M5.6 18.4l-.7.7M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <svg x-show="darkMode" x-cloak width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 13.5A8 8 0 0 1 10.5 4 8 8 0 1 0 20 13.5Z" stroke="currentColor" stroke-width="1.5"
                            stroke-linejoin="round" />
                    </svg>
                </button>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" aria-label="Notifikasi"
                        class="relative flex size-10 items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:bg-gray-100 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/5">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9.5a6 6 0 0 1 12 0c0 4 1.5 5.5 1.5 5.5h-15S6 13.5 6 9.5ZM10 19a2 2 0 0 0 4 0"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="absolute top-2 right-2.5 size-2 rounded-full bg-error-500"></span>
                    </button>
                    <div x-show="open" x-cloak @click.outside="open = false"
                        class="absolute right-0 z-50 mt-2 w-72 rounded-xl border border-gray-200 bg-white p-4 shadow-theme-md dark:border-gray-800 dark:bg-gray-900">
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Notifikasi</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada notifikasi. Modul notifikasi
                            menyusul.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2.5">
                        <span
                            class="flex size-10 items-center justify-center rounded-full bg-brand-50 text-sm font-semibold text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </span>
                        <span class="hidden text-left leading-tight lg:block">
                            <span
                                class="block text-sm font-medium text-gray-800 dark:text-white">{{ auth()->user()->name ?? 'Pengguna' }}</span>
                            <span
                                class="block max-w-40 truncate text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email ?? '' }}</span>
                        </span>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak @click.outside="open = false"
                        class="absolute right-0 z-50 mt-2 w-56 rounded-xl border border-gray-200 bg-white p-2 shadow-theme-md dark:border-gray-800 dark:bg-gray-900">
                        <div class="border-b border-gray-100 px-3 py-2.5 dark:border-gray-800">
                            <p class="truncate text-sm font-medium text-gray-800 dark:text-white">
                                {{ auth()->user()->name ?? 'Pengguna' }}</p>
                            <p class="truncate text-xs text-gray-500 dark:text-gray-400">
                                {{ auth()->user()->email ?? '' }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                            class="menu-dropdown-item menu-dropdown-item-inactive">Pengaturan akun</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="menu-dropdown-item menu-dropdown-item-inactive w-full text-left">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
