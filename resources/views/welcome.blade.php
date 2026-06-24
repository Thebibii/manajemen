@extends('layouts.home')
@section('content')
    <section class="min-h-[90vh] pt-16 relative overflow-hidden">
        <div class="container mx-auto px-6 py-12 md:py-20">
            <div class="grid md:grid-cols-2 gap-12 lg:gap-20 items-center">

                <!-- Content -->
                <div class="space-y-8">
                    <div>
                        <h1 class="font-outfit text-title-md  sm:text-title-lg lg:text-title-xl font-bold text-gray-900">
                            {{ __('messages.Temukan dan Kelola') }}
                            <span class="block text-brand-600">
                                {{ __('messages.Kegiatan Kampus dengan Mudah') }}
                            </span>
                        </h1>

                        <p class="mt-6 max-w-xl text-gray-500 text-sm sm:text-base ">
                            {{ __('messages.hero_description') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">

                        <a href="{{ route('explore') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm sm:text-base sm:px-6 sm:py-3 rounded-xl bg-brand-600 text-white shadow-theme-md hover:bg-brand-700 transition-all duration-300">

                            {{ __('messages.Lihat Event') }}

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>

                            </svg>

                        </a>

                    </div>

                </div>

                <!-- Right Card -->
                <div class="relative">

                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-6 shadow-theme-lg hover:shadow-theme-xl transition-all duration-300">

                        <div class="relative mb-5">

                            <div class="aspect-video overflow-hidden rounded-xl bg-gray-100">

                                <img src="{{ asset('images/hero.jpg') }}" alt="Campus Activities"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                    loading="lazy">

                            </div>



                        </div>

                        <div>

                            <h2 class="text-2xl font-semibold text-gray-900 mb-2">
                                {{ __('messages.Temukan Berbagai Kegiatan Kampus') }}
                            </h2>

                            <p class="text-gray-500 mb-6">
                                {{ __('messages.Dari seminar, workshop, kompetisi, hingga kegiatan organisasi, semuanya dapat ditemukan dan dikelola dalam satu platform.') }}
                            </p>

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
                        {{ __('messages.Event Terdekat') }}
                    </h2>

                    <p class="mt-2 text-gray-500 max-w-2xl ">
                        {{ __('messages.tp2') }}
                    </p>
                </div>

                <a href="{{ route('explore') }}"
                    class="inline-flex items-center gap-2 text-brand-600 font-medium hover:text-brand-700 transition">
                    {{ __('messages.Lihat Semua') }}

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
                                <div class="relative aspect-video overflow-hidden bg-gray-100">
                                    @if ($event->gambar)
                                        <img src="{{ Storage::url($event->gambar) }}" alt="{{ $event->nama }}"
                                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            loading="lazy">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center">
                                            <div class="text-center">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-image-off-icon lucide-image-off mx-auto h-10 w-10 text-gray-400">
                                                    <line x1="2" x2="22" y1="2" y2="22" />
                                                    <path d="M10.41 10.41a2 2 0 1 1-2.83-2.83" />
                                                    <line x1="13.5" x2="6" y1="13.5" y2="21" />
                                                    <line x1="18" x2="21" y1="12" y2="15" />
                                                    <path
                                                        d="M3.59 3.59A1.99 1.99 0 0 0 3 5v14a2 2 0 0 0 2 2h14c.55 0 1.052-.22 1.41-.59" />
                                                    <path d="M21 15V5a2 2 0 0 0-2-2H9" />
                                                </svg>

                                                <p class="mt-2 text-sm text-gray-500">
                                                    {{ __('messages.Gambar belum tersedia') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($event->sisa_kuota <= 0)
                                        <span
                                            class="absolute top-3 right-3 bg-gray-900/80 text-white text-xs font-medium px-2.5 py-1 rounded-full">
                                            {{ __('messages.Kuota Penuh') }}
                                        </span>
                                    @elseif ($event->sisa_kuota <= 5)
                                        <span
                                            class="absolute top-3 right-3 bg-red-500/90 text-white text-xs font-medium px-2.5 py-1 rounded-full">
                                            {{ __('messages.Sisa :slot slot', ['slot' => $event->sisa_kuota]) }}
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

                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                                            </svg> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-calendar-days-icon lucide-calendar-days w-4 h-4 text-brand-500">
                                                <path d="M8 2v4" />
                                                <path d="M16 2v4" />
                                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                                <path d="M3 10h18" />
                                                <path d="M8 14h.01" />
                                                <path d="M12 14h.01" />
                                                <path d="M16 14h.01" />
                                                <path d="M8 18h.01" />
                                                <path d="M12 18h.01" />
                                                <path d="M16 18h.01" />
                                            </svg>

                                            <span>{{ $event->tanggal->translatedFormat('l, d F Y • H:i') }}</span>

                                        </div>

                                        <div class="flex items-center gap-2 text-sm text-gray-600">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-map-pin-icon lucide-map-pin w-4 h-4 text-brand-500">
                                                <path
                                                    d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                                <circle cx="12" cy="10" r="3" />
                                            </svg>

                                            <span class="truncate">
                                                {{ $event->lokasi }}
                                            </span>

                                        </div>

                                        <div class="flex items-center gap-2 text-sm text-gray-600">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-users-icon lucide-users w-4 h-4 text-brand-500">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                                <circle cx="9" cy="7" r="4" />
                                            </svg>

                                            <span>
                                                {{ __('messages.:remaining / :total slot tersisa', [
                                                    'remaining' => $event->sisa_kuota,
                                                    'total' => $event->kuota,
                                                ]) }}
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
                        {{ __('messages.Belum ada event yang tersedia saat ini.') }}
                    </div>
                @endforelse

            </div>
        </div>
    </section>
@endsection
