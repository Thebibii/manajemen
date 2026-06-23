@extends('layouts.home')
@section('content')
    <div class="pt-28 pb-12">

        <div class="max-w-lg mx-auto px-4">

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-theme-lg">

                <!-- Header -->
                <div class="bg-brand-600 p-6 text-white">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-xs uppercase tracking-wider text-brand-100">
                                Event Kampus
                            </p>

                            <h1 class="mt-2 text-2xl font-bold">
                                {{ $registration->event->nama }}
                            </h1>

                        </div>

                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">

                        <span class="rounded-lg bg-white/10 px-3 py-1.5 text-sm">

                            {{ $registration->event->tanggal->translatedFormat('l, d F Y') }}

                        </span>

                        <span class="rounded-lg bg-white/10 px-3 py-1.5 text-sm">

                            {{ $registration->event->tanggal->translatedFormat('H:i') }} WIB

                        </span>

                    </div>

                </div>

                <!-- QR -->
                <div class="border-b border-dashed border-gray-200 p-8">

                    <div
                        class="mx-auto flex w-fit items-center justify-center rounded-2xl border border-gray-200 bg-gray-50 p-4">

                        {{-- <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=EVT-AI-9921"
                            class="h-56 w-56" alt="QR Ticket"> --}}
                        {!! QrCode::size(200)->generate($registration->ticket_code) !!}

                    </div>

                    <p class="mt-4 text-center text-sm text-gray-500">
                        Tunjukkan QR Code saat check-in event
                    </p>

                </div>

                <!-- Detail -->
                <div class="grid grid-cols-2 gap-6 p-6">

                    <div>
                        <p class="text-xs uppercase text-gray-500">
                            Nama Peserta
                        </p>
                        <p class="mt-1 font-semibold text-gray-900">
                            {{ $registration->user->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">
                            EMAIL
                        </p>
                        <p class="mt-1 font-semibold text-gray-900">
                            {{ $registration->user->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">
                            Lokasi
                        </p>
                        <p class="mt-1 font-semibold text-gray-900">
                            {{ $registration->event->lokasi }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-gray-500">
                            Kode Tiket
                        </p>
                        <p class="mt-1 font-semibold text-brand-600">
                            #{{ $registration->ticket_code }}
                        </p>
                    </div>

                </div>

                <!-- Footer -->
                <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">

                    <p class="text-center text-xs text-gray-500">
                        Harap membawa identitas yang valid saat registrasi.
                    </p>

                </div>

            </div>

            <!-- Actions -->

            <div class="mt-6 grid grid-cols-2 gap-3">

                <a href="{{ route('mahasiswa.ticket.download', $registration) }}"
                    @click="$store.notification.fire('success', 'Tiket sedang diunduh!')"
                    class="flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50">
                    Unduh Tiket
                </a>

                <a href="{{ route('welcome') }}"
                    class="flex items-center justify-center rounded-xl border  bg-brand-600 px-4 py-3 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-700">

                    Kembali ke Beranda

                </a>

            </div>

        </div>
    </div>
@endsection
