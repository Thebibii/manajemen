@extends('layouts.mahasiswa')
@section('content')
    <div class="col-span-12 lg:col-span-9">

        <x-common.component-card title="{{ __('messages.Event Saya') }}"
            headerClass="flex flex-col w-full sm:flex-row sm:items-center sm:justify-between gap-y-4"
            desc="{{ __('messages.desc my event') }}">

            <x-slot:action>
                <form method="GET" action="{{ route('mahasiswa.events') }}" class="w-full sm:fit">
                    <div x-data="{
                        selectedStatus: '{{ request('status', '') }}',
                        get isOptionSelected() { return this.selectedStatus !== ''; }
                    }" class="w-full sm:w-fit">
                        <div class="relative z-20 bg-transparent">
                            <select x-model="selectedStatus" name="status" @change="$el.form.submit()"
                                class="w-full sm:w-[180px] shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-[42px] appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-10 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden"
                                :class="isOptionSelected ? 'text-gray-800' : 'text-gray-400'">

                                <option value="" class="text-gray-400">{{ __('messages.Semua Status') }}</option>
                                <option value="pending" class="text-gray-700">{{ __('messages.Pending') }}</option>
                                <option value="diterima" class="text-gray-700">{{ __('messages.Diterima') }}</option>
                                <option value="ditolak" class="text-gray-700">{{ __('messages.Ditolak') }}</option>
                            </select>

                            <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </form>
            </x-slot:action>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($eventSaya as $event)
                    <div class="group block h-full">

                        <div
                            class="h-full bg-white rounded-2xl overflow-hidden shadow-theme-sm hover:shadow-theme-lg transition-all duration-300">

                            <!-- Thumbnail -->
                            <div class="relative aspect-video overflow-hidden bg-gray-100">

                                {{-- <img src="https://picsum.photos/seed/{{ $event->id }}-event/1600/900"
                                    alt="{{ $event->nama }}"
                                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"> --}}

                                @if ($event->gambar)
                                    <img src="{{ Storage::url($event->gambar) }}" alt="{{ $event->nama }}"
                                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <div class="text-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
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
                                <span class="absolute top-3 right-3">
                                    <x-ui.badge
                                        color="{{ $event->pivot->status === 'diterima' ? 'success' : ($event->pivot->status === 'ditolak' ? 'error' : 'warning') }}"
                                        size="sm">
                                        {{ ucfirst($event->pivot->status) }}
                                    </x-ui.badge>

                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <!-- Title -->
                                <h3
                                    class="font-semibold text-lg text-gray-900 mb-2 truncate group-hover:text-brand-600 transition-colors">

                                    {{ $event->nama }}

                                </h3>

                                <!-- Event Info -->
                                <div class="space-y-3 mb-2">

                                    <!-- Ditambahkan min-w-0 agar truncate flex berfungsi -->
                                    <div class="flex items-center gap-2 text-sm text-gray-600 min-w-0">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-500 shrink-0"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                                        </svg>

                                        <span
                                            class="truncate">{{ $event->tanggal->translatedFormat('l, d F Y • H:i') }}</span>

                                    </div>

                                    <!-- Ditambahkan min-w-0 agar truncate flex berfungsi -->
                                    <div class="flex items-center gap-2 text-sm text-gray-600 min-w-0">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-500 shrink-0"
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

                                </div>

                            </div>

                            <!-- Bagian Tombol Berdasarkan Status -->
                            @if ($event->pivot->status === 'diterima')
                                <a href="{{ route('mahasiswa.registrations.ticket', $event->pivot->id) }}"
                                    class="block w-full text-center bg-brand-600 text-white font-medium py-3 rounded-b-2xl hover:bg-brand-700 transition-colors">
                                    {{ __('messages.Lihat Tiket') }}
                                </a>
                            @elseif ($event->pivot->status === 'ditolak')
                                <div
                                    class="block w-full text-center bg-error-600 text-white font-medium py-3 rounded-b-2xl border-t ">
                                    {{ __('messages.Pendaftaran Ditolak') }}
                                </div>
                            @else
                                <div
                                    class="block w-full text-center bg-warning-600 text-white font-medium py-3 rounded-b-2xl border-t ">
                                    {{ __('messages.Menunggu Persetujuan') }}
                                </div>
                            @endif

                        </div>

                    </div>
                @empty
                    <div class="w-full py-2 text-gray-500">
                        {{ __('messages.Belum ada event yang tersedia saat ini.') }}
                    </div>
                @endforelse

            </div>
        </x-common.component-card>
    </div>
@endsection
