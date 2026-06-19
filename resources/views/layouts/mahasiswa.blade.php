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
    <div class="flex-1 pt-24 pb-28 md:pb-16 font-outfit">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-12 gap-4">
                @include('layouts.mahasiswa.sidebar')
                @yield('content')
            </div>
        </div>
    </div>



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
