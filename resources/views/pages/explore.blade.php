@extends('layouts.home')
@section('content')
    <div class="pt-28 pb-12">
        <div class="container mx-auto px-6 space-y-6">
            <form method="GET" action="{{ route('explore') }}" class="flex flex-col sm:flex-row gap-3">

                {{-- Search + Tombol --}}
                <div class="flex gap-2 flex-1">
                    <x-text-input id="search" name="search" type="text" class="w-full"
                        placeholder="{{ __('messages.Cari event atau lokasi...') }}" value="{{ request('search') }}" />
                    <button type="submit"
                        class="px-5 py-2.5 bg-brand-700 hover:bg-brand-800 text-white text-sm font-medium rounded-lg transition-colors whitespace-nowrap h-11">
                        {{ __('messages.Cari') }}
                    </button>
                </div>

                {{-- Filter Periode --}}
                <div x-data="{ isOptionSelected: {{ request('periode') ? 'true' : 'false' }} }" class="relative z-20 bg-transparent min-w-48">
                    <select name="periode"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden"
                        :class="isOptionSelected ? 'text-gray-800' : 'text-gray-400'"
                        @change="isOptionSelected = true; $el.closest('form').submit()">
                        <option value="" class="text-gray-400">{{ __('messages.Semua Periode') }}</option>
                        <option value="minggu_ini" {{ request('periode') == 'minggu_ini' ? 'selected' : '' }}
                            class="text-gray-700">{{ __('messages.Minggu Ini') }}</option>
                        <option value="minggu_depan" {{ request('periode') == 'minggu_depan' ? 'selected' : '' }}
                            class="text-gray-700">{{ __('messages.Minggu Depan') }}</option>
                        <option value="bulan_ini" {{ request('periode') == 'bulan_ini' ? 'selected' : '' }}
                            class="text-gray-700">{{ __('messages.Bulan Ini') }}</option>
                        <option value="bulan_depan" {{ request('periode') == 'bulan_depan' ? 'selected' : '' }}
                            class="text-gray-700">{{ __('messages.Bulan Depan') }}</option>
                    </select>
                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700">
                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>

                {{-- Urutkan --}}
                <div x-data="{ isOptionSelected: {{ request('urutan') ? 'true' : 'false' }} }" class="relative z-20 bg-transparent min-w-56">
                    <select name="urutan"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden"
                        :class="isOptionSelected ? 'text-gray-800' : 'text-gray-400'"
                        @change="isOptionSelected = true;$el.closest('form').submit()">
                        <option value="" class="text-gray-400">{{ __('messages.Urutkan Event') }}</option>
                        <option value="waktu_terdekat" {{ request('urutan') == 'waktu_terdekat' ? 'selected' : '' }}
                            class="text-gray-700">{{ __('messages.Waktu Mulai (Terdekat)') }}</option>
                        <option value="waktu_terjauh" {{ request('urutan') == 'waktu_terjauh' ? 'selected' : '' }}
                            class="text-gray-700">{{ __('messages.Waktu Mulai (Terjauh)') }}</option>
                        <option value="nama_az" {{ request('urutan') == 'nama_az' ? 'selected' : '' }}
                            class="text-gray-700">{{ __('messages.Nama Event (A-Z)') }}</option>
                        <option value="nama_za" {{ request('urutan') == 'nama_za' ? 'selected' : '' }}
                            class="text-gray-700">{{ __('messages.Nama Event (Z-A)') }}</option>
                    </select>
                    <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700">
                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>

            </form>
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

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
            @if ($events->hasPages())
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
                                            class="flex h-10 w-10 items-center justify-center rounded-lg text-theme-sm font-medium {{ $current === $page ? 'bg-brand-700 text-white' : 'text-gray-700 hover:bg-brand-700/[0.08] hover:text-blue-500' }}">
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
            @endif
        </div>

    </div>
@endsection
