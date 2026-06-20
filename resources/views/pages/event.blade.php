@extends('layouts.home')
@section('content')
    <div class="pt-28 pb-12">
        <section class="container mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-8">

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Hero -->
                    <div class="relative aspect-video overflow-hidden rounded-3xl shadow-theme-lg">

                        <img src="https://picsum.photos/seed/1-festival-alternative/1600/900" alt="NOISE FESTIVAL 2024"
                            class="absolute inset-0 w-full h-full object-cover hover:scale-105 transition-transform duration-500">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 right-0 p-8 hidden md:block">

                            <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight">
                                {{ $event->nama }}
                            </h1>
                        </div>

                    </div>

                    <!-- Mobile Event Info -->
                    <div class="lg:hidden bg-white border border-gray-200 rounded-2xl p-6 shadow-theme-sm">

                        <h2 class="text-lg font-semibold text-gray-900 mb-6">
                            Informasi Event
                        </h2>

                        <div class="grid gap-5">

                            <div>
                                <p class="text-sm text-gray-500">
                                    Nama Event
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->nama }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Lokasi
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->lokasi }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Tanggal & Waktu
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->tanggal->translatedFormat('l, d F Y') }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $event->tanggal->translatedFormat('H:i') }} WIB
                                </p>
                            </div>

                        </div>

                    </div>

                    <!-- Description -->
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-theme-sm">

                        <div class="px-6 py-5 border-b border-gray-200">

                            <h2 class="text-lg font-semibold text-gray-900">
                                Deskripsi Event
                            </h2>

                        </div>

                        <div class="p-6">

                            <p class="leading-7 text-gray-600">
                                {!! nl2br(e($event->deskripsi)) !!}
                            </p>

                        </div>

                    </div>

                </div>

                <!-- Sidebar -->
                <aside class="space-y-6 lg:sticky lg:top-24 h-fit">



                    <!-- Event Information -->
                    <div class="hidden lg:block bg-white border border-gray-200 rounded-2xl p-6 shadow-theme-sm">

                        <h2 class="text-lg font-semibold text-gray-900 mb-6">
                            Informasi Event
                        </h2>

                        <div class="space-y-3">

                            <div>
                                <p class="text-sm text-gray-500">
                                    Nama Event
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->nama }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Lokasi
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->lokasi }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Tanggal & Waktu
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->tanggal->translatedFormat('l, d F Y') }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $event->tanggal->translatedFormat('H:i') }} WIB
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Kuota Tersedia
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->sisa_kuota }} / {{ $event->kuota }} Peserta
                                </p>
                            </div>

                        </div>

                    </div>

                    <!-- Organizer -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-theme-sm">

                        <h2 class="text-lg font-semibold text-gray-900">
                            Diselenggarakan oleh
                        </h2>

                        <div>

                            <p class="font-semibold text-2xl text-gray-900 group-hover:text-brand-600 transition">
                                {{ $event->panitia->name ?? 'Anonim' }}
                            </p>

                        </div>


                    </div>

                    <!-- Ticket Card -->
                    <div
                        class="fixed bottom-0 backdrop-blur-lg left-0 right-0 z-50 bg-white/80 rounded border-t border-gray-200 p-4 shadow-lg md:relative md:bottom-auto md:left-auto md:right-auto md:z-auto md:border md:rounded-2xl md:p-6 md:shadow-theme-lg">

                        <!-- Cek apakah kuota masih ada -->
                        @if ($event->sisa_kuota > 0)
                            {{-- <a href="{{ route('events.register', $event) }}" --}}
                            @if (!$sudahDaftar)
                                <form action="{{ route('mahasiswa.registrations.store', $event->id) }}" method="POST"
                                    class="w-full">
                                    @csrf
                                    <!-- Tombol Submit -->
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-brand-600 px-5 py-3 text-white font-medium hover:bg-brand-700 transition">
                                        Daftar Sekarang
                                    </button>
                                </form>
                            @else
                                @if ($sudahDaftar->status === 'diterima')
                                    <a href="{{ route('mahasiswa.registrations.ticket', $sudahDaftar->id) }}"
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-brand-600 px-5 py-3 text-white font-medium hover:bg-brand-700 transition">
                                        Lihat Tiket
                                    </a>
                                @elseif($sudahDaftar->status === 'ditolak')
                                    <div
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-error-600 px-5 py-3 text-white font-medium">
                                        Pendaftaran Ditolak
                                    </div>
                                @else
                                    <div
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-warning-600 px-5 py-3 text-white font-medium">
                                        Menunggu Persetujuan
                                    </div>
                                @endif
                            @endif
                        @else
                            <button disabled
                                class="w-full inline-flex items-center justify-center rounded-xl bg-gray-400 px-5 py-3 text-white font-medium cursor-not-allowed">
                                Kuota Penuh
                            </button>
                        @endif

                    </div>



                </aside>

            </div>
        </section>
    </div>
@endsection
