@extends('layouts.home')
@section('content')
    <section class="min-h-[90vh] pt-16 relative overflow-hidden">
        <div class="container mx-auto px-6 py-12 md:py-20">
            <div class="grid md:grid-cols-2 gap-12 lg:gap-20 items-center">

                <!-- Content -->
                <div class="space-y-8">
                    <div>
                        <h1 class="font-outfit text-title-md  sm:text-title-lg lg:text-title-xl font-bold text-gray-900">
                            Temukan dan Kelola
                            <span class="block text-brand-600">
                                Kegiatan Kampus dengan Mudah
                            </span>
                        </h1>

                        <p class="mt-6 max-w-xl text-gray-500 text-sm sm:text-base ">
                            Event Kampus adalah platform yang memudahkan mahasiswa, organisasi, dan pihak kampus dalam
                            menemukan, mengelola, serta mengikuti berbagai kegiatan. Mulai dari seminar, workshop, lomba,
                            pelatihan, hingga acara organisasi, semua dapat diakses dalam satu sistem yang terintegrasi.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">

                        <a href="{{ route('explore') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm sm:text-base sm:px-6 sm:py-3 rounded-xl bg-brand-600 text-white shadow-theme-md hover:bg-brand-700 transition-all duration-300">

                            Lihat Event

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>

                            </svg>

                        </a>

                    </div>

                </div>

                <!-- Featured Event Card -->
                <div class="relative">

                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-6 shadow-theme-lg hover:shadow-theme-xl transition-all duration-300">

                        <div class="relative mb-5">

                            <div class="aspect-video overflow-hidden rounded-xl bg-gray-100">

                                <img src="https://picsum.photos/seed/1-festival-alternative/1600/900"
                                    alt="NOISE FESTIVAL 2024"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">

                            </div>

                            <span
                                class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full bg-success-50 text-success-700 text-theme-xs font-medium border border-success-100">
                                Coming Soon
                            </span>

                        </div>

                        <div>

                            <span
                                class="inline-flex px-3 py-1 rounded-full bg-brand-50 text-brand-700 text-theme-xs font-medium mb-4">
                                Alternative
                            </span>

                            <h2 class="text-2xl font-semibold text-gray-900 mb-2">
                                NOISE FESTIVAL 2024
                            </h2>

                            <p class="text-gray-500 mb-6">
                                Deskripsi
                            </p>

                            <div class="flex items-center justify-between border-t border-gray-200 pt-5">

                                <div>
                                    <p class="text-theme-xs text-gray-400 uppercase tracking-wide">
                                        Tanggal
                                    </p>

                                    <p class="font-semibold text-gray-800 mt-1">
                                        15 Maret 2024
                                    </p>
                                </div>

                                <a href="/event/1"
                                    class="inline-flex items-center px-5 py-2.5 rounded-lg bg-brand-50 text-brand-600 hover:bg-brand-100 transition-all duration-300 font-medium">

                                    Beli Tiket

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <section id="events" class="py-20 border-t border-gray-200">
        <div class="container mx-auto px-6">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">

                <div>
                    <h2 class="font-outfit text-title-sm font-bold text-gray-900">
                        Event Terdekat
                    </h2>

                    <p class="mt-2 text-gray-500 max-w-2xl ">
                        Temukan konser, festival, dan pertunjukan musik terbaik yang akan
                        berlangsung dalam waktu dekat.
                    </p>
                </div>

                <a href="{{ route('explore') }}"
                    class="inline-flex items-center gap-2 text-brand-600 font-medium hover:text-brand-700 transition">
                    Lihat Semua

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>

                    </svg>
                </a>

            </div>

            <!-- Events Slider -->
            {{-- <div class="overflow-hidden"> --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 overflow-x-auto pb-4">

                @forelse ($events as $event)
                    <!-- Card -->
                    <div class="basis-full md:basis-1/2 lg:basis-1/3 xl:basis-1/4 shrink-0">

                        <a href="{{ route('events.show', $event) }}" class="group block h-full">

                            <div
                                class="h-full bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-theme-sm hover:shadow-theme-lg transition-all duration-300">

                                <!-- Thumbnail -->
                                <div class="relative aspect-video overflow-hidden">

                                    <img src="https://picsum.photos/seed/{{ $event->id }}-event/1600/900"
                                        alt="{{ $event->nama }}"
                                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                                    @if ($event->sisa_kuota <= 0)
                                        <span
                                            class="absolute top-3 right-3 bg-gray-900/80 text-white text-xs font-medium px-2.5 py-1 rounded-full">
                                            Kuota Penuh
                                        </span>
                                    @elseif ($event->sisa_kuota <= 5)
                                        <span
                                            class="absolute top-3 right-3 bg-red-500/90 text-white text-xs font-medium px-2.5 py-1 rounded-full">
                                            Sisa {{ $event->sisa_kuota }} slot
                                        </span>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-5">

                                    <!-- Title -->
                                    <h3
                                        class="font-semibold text-lg text-gray-900 mb-1 line-clamp-2 group-hover:text-brand-600 transition-colors">

                                        {{ $event->nama }}

                                    </h3>

                                    <!-- Deskripsi -->
                                    <p class="text-sm text-gray-500 mb-3 truncate">
                                        {{ $event->deskripsi }}
                                    </p>

                                    <!-- Event Info -->
                                    <div class="space-y-3 mb-3">

                                        <div class="flex items-center gap-2 text-sm text-gray-600">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                                            </svg>

                                            <span>{{ $event->tanggal->translatedFormat('d M Y • H:i') }}</span>

                                        </div>

                                        <div class="flex items-center gap-2 text-sm text-gray-600">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />

                                            </svg>

                                            <span class="truncate">
                                                {{ $event->lokasi }}
                                            </span>

                                        </div>

                                        <div class="flex items-center gap-2 text-sm text-gray-600">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4" />

                                            </svg>

                                            <span>
                                                {{ $event->sisa_kuota }} / {{ $event->kuota }} slot tersisa
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>
                    <!-- End Card -->
                @empty
                    <div class="w-full text-center py-10 text-gray-500">
                        Belum ada event yang tersedia saat ini.
                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            {{-- @if ($events->hasPages())
                @php
                    $current = $events->currentPage();
                    $last = $events->lastPage();
                    $pages = [];
                    for ($i = 1; $i <= $last; $i++) {
                        if ($i === 1 || $i === $last || ($i >= $current - 1 && $i <= $current + 1)) {
                            $pages[] = $i;
                        } elseif (end($pages) !== '...') {
                            $pages[] = '...';
                        }
                    }
                @endphp
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        @if ($events->onFirstPage())
                            <span
                                class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-3 text-theme-sm font-medium text-gray-400 opacity-50 cursor-not-allowed sm:px-3.5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2.58301 9.99868C2.58272 10.1909 2.65588 10.3833 2.80249 10.53L7.79915 15.5301C8.09194 15.8231 8.56682 15.8233 8.85981 15.5305C9.15281 15.2377 9.15297 14.7629 8.86018 14.4699L5.14009 10.7472L16.6675 10.7472C17.0817 10.7472 17.4175 10.4114 17.4175 9.99715C17.4175 9.58294 17.0817 9.24715 16.6675 9.24715L5.14554 9.24715L8.86017 5.53016C9.15297 5.23717 9.15282 4.7623 8.85983 4.4695C8.56684 4.1767 8.09197 4.17685 7.79917 4.46984L2.84167 9.43049C2.68321 9.568 2.58301 9.77087 2.58301 9.99715C2.58301 9.99766 2.58301 9.99817 2.58301 9.99868Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="hidden sm:inline">Previous</span>
                            </span>
                        @else
                            <a href="{{ $events->previousPageUrl() }}"
                                class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-3 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 sm:px-3.5">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2.58301 9.99868C2.58272 10.1909 2.65588 10.3833 2.80249 10.53L7.79915 15.5301C8.09194 15.8231 8.56682 15.8233 8.85981 15.5305C9.15281 15.2377 9.15297 14.7629 8.86018 14.4699L5.14009 10.7472L16.6675 10.7472C17.0817 10.7472 17.4175 10.4114 17.4175 9.99715C17.4175 9.58294 17.0817 9.24715 16.6675 9.24715L5.14554 9.24715L8.86017 5.53016C9.15297 5.23717 9.15282 4.7623 8.85983 4.4695C8.56684 4.1767 8.09197 4.17685 7.79917 4.46984L2.84167 9.43049C2.68321 9.568 2.58301 9.77087 2.58301 9.99715C2.58301 9.99766 2.58301 9.99817 2.58301 9.99868Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="hidden sm:inline">Previous</span>
                            </a>
                        @endif

                        <span class="block text-sm font-medium text-gray-700 sm:hidden">
                            Page {{ $current }} of {{ $last }}
                        </span>

                        <ul class="hidden items-center gap-0.5 sm:flex">
                            @foreach ($pages as $page)
                                <li>
                                    @if ($page === '...')
                                        <span class="flex h-10 w-10 items-center justify-center text-gray-500">...</span>
                                    @else
                                        <a href="{{ $events->url($page) }}"
                                            class="flex h-10 w-10 items-center justify-center rounded-lg text-theme-sm font-medium {{ $current === $page ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500/[0.08] hover:text-blue-500' }}">
                                            {{ $page }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        @if ($events->hasMorePages())
                            <a href="{{ $events->nextPageUrl() }}"
                                class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-3 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 sm:px-3.5">
                                <span class="hidden sm:inline">Next</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17.4175 9.9986C17.4178 10.1909 17.3446 10.3832 17.198 10.53L12.2013 15.5301C11.9085 15.8231 11.4337 15.8233 11.1407 15.5305C10.8477 15.2377 10.8475 14.7629 11.1403 14.4699L14.8604 10.7472L3.33301 10.7472C2.91879 10.7472 2.58301 10.4114 2.58301 9.99715C2.58301 9.58294 2.91879 9.24715 3.33301 9.24715L14.8549 9.24715L11.1403 5.53016C10.8475 5.23717 10.8477 4.7623 11.1407 4.4695C11.4336 4.1767 11.9085 4.17685 12.2013 4.46984L17.1588 9.43049C17.3173 9.568 17.4175 9.77087 17.4175 9.99715C17.4175 9.99763 17.4175 9.99812 17.4175 9.9986Z"
                                        fill="currentColor" />
                                </svg>
                            </a>
                        @else
                            <span
                                class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-3 text-theme-sm font-medium text-gray-400 opacity-50 cursor-not-allowed sm:px-3.5">
                                <span class="hidden sm:inline">Next</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17.4175 9.9986C17.4178 10.1909 17.3446 10.3832 17.198 10.53L12.2013 15.5301C11.9085 15.8231 11.4337 15.8233 11.1407 15.5305C10.8477 15.2377 10.8475 14.7629 11.1403 14.4699L14.8604 10.7472L3.33301 10.7472C2.91879 10.7472 2.58301 10.4114 2.58301 9.99715C2.58301 9.58294 2.91879 9.24715 3.33301 9.24715L14.8549 9.24715L11.1403 5.53016C10.8475 5.23717 10.8477 4.7623 11.1407 4.4695C11.4336 4.1767 11.9085 4.17685 12.2013 4.46984L17.1588 9.43049C17.3173 9.568 17.4175 9.77087 17.4175 9.99715C17.4175 9.99763 17.4175 9.99812 17.4175 9.9986Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            @endif --}}
            {{-- </div> --}}

        </div>
    </section>
@endsection
