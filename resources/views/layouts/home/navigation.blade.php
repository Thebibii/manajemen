@php
    $isMahasiswa = auth()->check() && auth()->user()->isMahasiswa();
@endphp
<nav class="fixed top-0 left-0 right-0 z-50 bg-brand-700 ">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-3 items-center h-16">

            <!-- Logo -->
            <a href="{{ route('welcome') }}" class="font-outfit text-2xl font-bold tracking-tight text-white">

                EVENT<span class="text-brand-100">KAMPUS</span>

            </a>

            <!-- Navigation -->
            <div class="hidden md:flex items-center justify-center gap-8">

                <a href="{{ route('welcome') }}"
                    class=" font-outfit font-medium text-white/90 hover:text-white transition-colors duration-300">
                    {{ __('messages.Beranda') }}
                </a>

                <a href="/explore"
                    class=" font-outfit font-medium text-white/90 hover:text-white transition-colors duration-300">
                    Explore
                </a>

                {{-- <a href="/about"
                    class=" font-outfit font-medium text-white/90 hover:text-white transition-colors duration-300">
                    Tentang
                </a>

                <a href="/contact-us"
                    class=" font-outfit font-medium text-white/90 hover:text-white transition-colors duration-300">
                    Hubungi Kami
                </a> --}}

            </div>

            <!-- Right Section -->
            <div class="flex items-center justify-end gap-3">

                @guest
                    <!-- Ditampilkan HANYA jika user BELUM login -->
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-5 py-1.5 rounded-xl bg-white text-brand-600 font-semibold shadow-theme-sm hover:bg-gray-100 transition-all duration-300">
                        Masuk
                    </a>
                @endguest
                <x-header.lang-dropdown />
                @auth
                    @if ($isMahasiswa)
                        <x-header.mahasiswa-dropdown />
                    @else
                        <!-- Ditampilkan HANYA jika user SUDAH login -->
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center justify-center px-5 py-1.5 rounded-xl bg-white text-brand-600 font-semibold shadow-theme-sm hover:bg-gray-100 transition-all duration-300">
                            Dashboard
                        </a>
                    @endif
                @endauth

            </div>


        </div>
    </div>
</nav>
<div class="fixed bottom-4 left-4 right-4 z-50 md:hidden">

    <div class="flex items-center justify-between rounded-full bg-brand-600 p-2 shadow-theme-xl">

        <!-- Home -->
        @if (request()->routeIs('welcome'))
            <!-- Tampilan saat HOME AKTIF -->
            <a href="{{ route('welcome') }}"
                class="flex items-center gap-2 rounded-full bg-white px-5 py-3 shadow-theme-sm transition-all duration-300">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-5 w-5 fill-brand-600">
                    <path
                        d="M12.708 3.08a3 3 0 0 0-1.416 0c-.531.13-1 .449-1.535.812L4.756 7.28c-.427.288-.802.542-1.084.888a3 3 0 0 0-.545 1.028C3 9.623 3 10.076 3 10.59v6.248c0 .527 0 .982.03 1.356.033.396.104.789.297 1.167a3 3 0 0 0 1.311 1.311c.378.193.772.265 1.167.297.374.03.83.03 1.356.03h1.553c.71 0 1.286-.575 1.286-1.285V17a2 2 0 0 1 4 0v2.715c0 .71.576 1.285 1.286 1.285h1.553c.527 0 .981 0 1.356-.03.395-.032.788-.104 1.167-.297a3 3 0 0 0 1.31-1.31c.194-.38.265-.772.297-1.168.031-.374.03-.829.03-1.356L21 10.59c0-.515.001-.968-.128-1.395a3 3 0 0 0-.544-1.028c-.282-.346-.657-.6-1.084-.888l-5.001-3.388c-.534-.363-1.004-.682-1.535-.811" />
                </svg>
                <span class="text-theme-sm font-semibold text-brand-600">{{ __('messages.Beranda') }}</span>
            </a>
        @else
            <!-- Tampilan saat HOME TIDAK AKTIF -->
            <a href="{{ route('welcome') }}"
                class="flex h-12 w-12 items-center justify-center rounded-full transition-all duration-300 hover:bg-brand-700">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-6 w-6 fill-brand-100">
                    <path
                        d="M12.708 3.08a3 3 0 0 0-1.416 0c-.531.13-1 .449-1.535.812L4.756 7.28c-.427.288-.802.542-1.084.888a3 3 0 0 0-.545 1.028C3 9.623 3 10.076 3 10.59v6.248c0 .527 0 .982.03 1.356.033.396.104.789.297 1.167a3 3 0 0 0 1.311 1.311c.378.193.772.265 1.167.297.374.03.83.03 1.356.03h1.553c.71 0 1.286-.575 1.286-1.285V17a2 2 0 0 1 4 0v2.715c0 .71.576 1.285 1.286 1.285h1.553c.527 0 .981 0 1.356-.03.395-.032.788-.104 1.167-.297a3 3 0 0 0 1.31-1.31c.194-.38.265-.772.297-1.168.031-.374.03-.829.03-1.356L21 10.59c0-.515.001-.968-.128-1.395a3 3 0 0 0-.544-1.028c-.282-.346-.657-.6-1.084-.888l-5.001-3.388c-.534-.363-1.004-.682-1.535-.811" />
                </svg>
            </a>
        @endif

        <!-- Jelajah (Active Sekarang) -->
        @if (request()->routeIs('explore'))
            <!-- Tampilan saat explore AKTIF -->
            <a href="{{ route('explore') }}"
                class="flex items-center gap-2 rounded-full bg-white px-5 py-3 shadow-theme-sm transition-all duration-300">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-5 w-5 fill-brand-600">
                    <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2"></path>
                    <path fill-rule="evenodd"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10m-6.623-3.985-5.299 1.339a1 1 0 0 0-.724.725l-1.339 5.298a.5.5 0 0 0 .607.608l5.3-1.339a1 1 0 0 0 .724-.725l1.339-5.299a.5.5 0 0 0-.607-.607"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="text-theme-sm font-semibold text-brand-600">Explore</span>
            </a>
        @else
            <!-- Tampilan saat explore TIDAK AKTIF -->
            <a href="{{ route('explore') }}"
                class="flex h-12 w-12 items-center justify-center rounded-full transition-all duration-300 hover:bg-brand-700">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-6 w-6 fill-brand-100">
                    <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2"></path>
                    <path fill-rule="evenodd"
                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10m-6.623-3.985-5.299 1.339a1 1 0 0 0-.724.725l-1.339 5.298a.5.5 0 0 0 .607.608l5.3-1.339a1 1 0 0 0 .724-.725l1.339-5.299a.5.5 0 0 0-.607-.607"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @endif

        <!-- Ticket -->
        @if (request()->routeIs('mahasiswa.events'))
            <!-- Tampilan saat mahasiswa.events AKTIF -->
            <a href="{{ route('mahasiswa.events') }}"
                class="flex items-center gap-2 rounded-full bg-white px-5 py-3 shadow-theme-sm transition-all duration-300">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-5 w-5 fill-brand-600">
                    <path fill-rule="evenodd"
                        d="M20.874 14.611c.504.572 1.126 1.453 1.126 2.535A2.854 2.854 0 0 1 19.146 20H4.854A2.854 2.854 0 0 1 2 17.146c0-1.082.623-1.963 1.126-2.535C3.52 14.165 4 13.357 4 12s-.481-2.165-.874-2.611C2.623 8.817 2 7.936 2 6.854A2.854 2.854 0 0 1 4.854 4h14.292A2.854 2.854 0 0 1 22 6.854c0 1.082-.622 1.963-1.126 2.535C20.48 9.835 20 10.643 20 12s.481 2.165.874 2.611m-6.167-5.318a1 1 0 0 0-1.414 0l-4 4a1 1 0 1 0 1.414 1.414l4-4a1 1 0 0 0 0-1.414"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="text-theme-sm font-semibold text-brand-600">Events</span>
            </a>
        @else
            <!-- Tampilan saat mahasiswa.events TIDAK AKTIF -->
            <a href="{{ route('mahasiswa.events') }}"
                class="flex h-12 w-12 items-center justify-center rounded-full transition-all duration-300 hover:bg-brand-700">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-6 w-6 fill-brand-100">
                    <path fill-rule="evenodd"
                        d="M20.874 14.611c.504.572 1.126 1.453 1.126 2.535A2.854 2.854 0 0 1 19.146 20H4.854A2.854 2.854 0 0 1 2 17.146c0-1.082.623-1.963 1.126-2.535C3.52 14.165 4 13.357 4 12s-.481-2.165-.874-2.611C2.623 8.817 2 7.936 2 6.854A2.854 2.854 0 0 1 4.854 4h14.292A2.854 2.854 0 0 1 22 6.854c0 1.082-.622 1.963-1.126 2.535C20.48 9.835 20 10.643 20 12s.481 2.165.874 2.611m-6.167-5.318a1 1 0 0 0-1.414 0l-4 4a1 1 0 1 0 1.414 1.414l4-4a1 1 0 0 0 0-1.414"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @endif
        @if (request()->routeIs('mahasiswa.profile'))
            <a href="{{ route('mahasiswa.profile') }}"
                class="flex items-center gap-2 rounded-full bg-white px-5 py-3 shadow-theme-sm transition-all duration-300">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-5 w-5 fill-brand-600">
                    <path
                        d="M9 14a5 5 0 0 0-5 5 3 3 0 0 0 3 3h10a3 3 0 0 0 3-3 5 5 0 0 0-5-5zM12 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10" />
                </svg>
                <span class="text-theme-sm font-semibold text-brand-600">Profile</span>
            </a>
        @else
            <a href="{{ route('mahasiswa.profile') }}"
                class="flex h-12 w-12 items-center justify-center rounded-full transition-all duration-300 hover:bg-brand-700">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-6 w-6 fill-brand-100">
                    <path
                        d="M9 14a5 5 0 0 0-5 5 3 3 0 0 0 3 3h10a3 3 0 0 0 3-3 5 5 0 0 0-5-5zM12 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10" />
                </svg>
            </a>
        @endif
        <!-- Profile -->
        {{-- @if (request()->routeIs('profile'))
            <!-- Tampilan saat PROFILE AKTIF -->
            <a href="{{ route('profile') }}"
                class="flex items-center gap-2 rounded-full bg-white px-5 py-3 shadow-theme-sm transition-all duration-300">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-5 w-5 fill-brand-600">
                    <path
                        d="M9 14a5 5 0 0 0-5 5 3 3 0 0 0 3 3h10a3 3 0 0 0 3-3 5 5 0 0 0-5-5zM12 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10" />
                </svg>
                <span class="text-theme-sm font-semibold text-brand-600">Profil</span>
            </a>
        @else
            <!-- Tampilan saat PROFILE TIDAK AKTIF -->
            <a href="{{ route('profile') }}"
                class="flex h-12 w-12 items-center justify-center rounded-full transition-all duration-300 hover:bg-brand-700">
                <svg xmlns="http://w3.org" viewBox="0 0 24 24" class="h-6 w-6 fill-brand-100">
                    <path
                        d="M9 14a5 5 0 0 0-5 5 3 3 0 0 0 3 3h10a3 3 0 0 0 3-3 5 5 0 0 0-5-5zM12 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10" />
                </svg>
            </a>
        @endif --}}

    </div>

</div>
