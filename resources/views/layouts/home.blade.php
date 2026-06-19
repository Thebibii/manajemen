<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Dashboard' }} | TailAdmin - Laravel Tailwind CSS Admin Dashboard Template</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>

    {{-- preloader --}}
    {{-- <x-common.preloader /> --}}
    {{-- preloader end --}}

    {{-- <div class="min-h-screen xl:flex"> --}}
    @include('layouts.home.navigation')
    {{-- @include('layouts.sidebar') --}}

    @yield('content')

    <footer class="bg-brand-700 text-white py-12">
        <div class="container mx-auto px-6">

            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">

                <!-- Brand -->
                <div class="lg:col-span-2">

                    <a href="/" class="inline-block font-outfit text-3xl font-bold tracking-tight mb-4">

                        EVENT<span class="text-brand-100">KAMPUS</span>

                    </a>

                    <p class="max-w-md text-brand-100 leading-6 sm:leading-7">
                        Platform tiket konser untuk anak seni, komunitas kreatif,
                        dan pecinta musik live di Indonesia. Temukan event terbaik,
                        beli tiket dengan mudah, dan nikmati pengalaman konser tanpa ribet.
                    </p>

                </div>

                <!-- Navigation -->
                <div>

                    <h4 class="text-sm font-semibold uppercase tracking-wider text-brand-100 mb-5">
                        Navigasi
                    </h4>

                    <ul class="space-y-3">

                        <li>
                            <a href="/" class="text-brand-100 hover:text-white transition-colors duration-300">
                                Beranda
                            </a>
                        </li>

                        <li>
                            <a href="/explore" class="text-brand-100 hover:text-white transition-colors duration-300">
                                Explore
                            </a>
                        </li>

                        <li>
                            <a href="/about" class="text-brand-100 hover:text-white transition-colors duration-300">
                                Tentang
                            </a>
                        </li>

                        <li>
                            <a href="/contact-us"
                                class="text-brand-100 hover:text-white transition-colors duration-300">
                                Hubungi Kami
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- Contact -->
                <div>

                    <h4 class="text-sm font-semibold uppercase tracking-wider text-brand-100 mb-5">
                        Kontak
                    </h4>

                    <ul class="space-y-3">

                        <li>
                            <a href="mailto:halo@eventkampus.id"
                                class="text-brand-100 hover:text-white transition-colors duration-300">
                                halo@eventkampus.id
                            </a>
                        </li>

                        <li>
                            <a href="tel:+6281234567890"
                                class="text-brand-100 hover:text-white transition-colors duration-300">
                                +62 812 3456 7890
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

            <!-- Bottom -->
            <div class="mt-12 pt-8 border-t border-white/10">

                <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                    <p class="text-sm text-brand-100">
                        © 2026 EVENTKAMPUS. Semua hak dilindungi.
                    </p>

                    <div class="flex items-center gap-6">

                        <a href="/privacy-policy" class="text-sm text-brand-100 hover:text-white transition-colors">
                            Kebijakan Privasi
                        </a>

                        <a href="/terms" class="text-sm text-brand-100 hover:text-white transition-colors">
                            Syarat & Ketentuan
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </footer>

    {{-- <div class="flex-1 transition-all duration-300 ease-in-out"
            :class="{
                'xl:ml-[290px]': $store.sidebar.isExpanded || $store.sidebar.isHovered,
                'xl:ml-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
                'ml-0': $store.sidebar.isMobileOpen
            }">
            <!-- app header start -->
            @include('layouts.app-header')
            <!-- app header end -->
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                @yield('content')
            </div>
        </div> --}}

    {{-- </div> --}}

</body>

@stack('scripts')

</html>
