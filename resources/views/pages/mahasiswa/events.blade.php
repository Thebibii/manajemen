@extends('layouts.mahasiswa')
@section('content')
    <div class="col-span-12 lg:col-span-9">

        <x-common.component-card title="{{ __('messages.Event Saya') }}" desc="{{__('messages.desc my event')}}">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($eventSaya as $event)
                    <div class="group block h-full">

                        <div
                            class="h-full bg-white rounded-2xl overflow-hidden shadow-theme-sm hover:shadow-theme-lg transition-all duration-300">

                            <!-- Thumbnail -->
                            <div class="relative aspect-video overflow-hidden">

                                <img src="https://picsum.photos/seed/{{ $event->id }}-event/1600/900"
                                    alt="{{ $event->nama }}"
                                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

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

                                        <span class="truncate">{{ $event->tanggal->translatedFormat('d M Y • H:i') }}</span>

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
                                    Lihat Tiket
                                </a>
                            @elseif ($event->pivot->status === 'ditolak')
                                <div
                                    class="block w-full text-center bg-error-600 text-white font-medium py-3 rounded-b-2xl border-t ">
                                    Pendaftaran Ditolak
                                </div>
                            @else
                                <div
                                    class="block w-full text-center bg-warning-600 text-white font-medium py-3 rounded-b-2xl border-t ">
                                    {{__('messages.Menunggu Persetujuan')}}
                                </div>
                            @endif

                        </div>

                    </div>
                @endforeach

            </div>
        </x-common.component-card>
    </div>
@endsection
