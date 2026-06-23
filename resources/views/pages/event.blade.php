@extends('layouts.home')
@section('content')
    <div class="pt-28 pb-12">
        <section class="container mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-8">

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Hero -->
                    <div class="relative aspect-video overflow-hidden rounded-3xl shadow-theme-lg">

                        @if ($event->gambar)
                            <img src="{{ Storage::url($event->gambar) }}" alt="{{ $event->nama }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy">
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
                            {{ __('messages.Informasi Event') }}
                        </h2>

                        <div class="grid gap-5">

                            <div>
                                <p class="text-sm text-gray-500">
                                    {{ __('messages.Nama Event') }}
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->nama }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    {{ __('messages.Lokasi') }}
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->lokasi }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    {{ __('messages.Tanggal & Waktu') }}
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
                                {{ __('messages.Deskripsi Event') }}
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
                            {{ __('messages.Informasi Event') }}
                        </h2>

                        <div class="space-y-3">

                            <div>
                                <p class="text-sm text-gray-500">
                                    {{ __('messages.Nama Event') }}
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->nama }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    {{ __('messages.Lokasi') }}
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->lokasi }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    {{ __('messages.Tanggal & Waktu') }}
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
                                    {{ __('messages.Kuota Tersedia') }}
                                </p>

                                <p class="font-semibold text-gray-900">
                                    {{ $event->sisa_kuota }} / {{ $event->kuota }} {{ __('messages.Peserta') }}
                                </p>
                            </div>

                        </div>

                    </div>

                    <!-- Organizer -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-theme-sm">

                        <h2 class="text-lg font-semibold text-gray-900">
                            {{ __('messages.Diselenggarakan oleh') }}
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
                                        {{ __('messages.Daftar Sekarang') }}
                                    </button>
                                </form>
                            @else
                                @if ($sudahDaftar->status === 'diterima')
                                    <a href="{{ route('mahasiswa.registrations.ticket', $sudahDaftar->id) }}"
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-brand-600 px-5 py-3 text-white font-medium hover:bg-brand-700 transition">
                                        {{ __('messages.Lihat Tiket') }}
                                    </a>
                                @elseif($sudahDaftar->status === 'ditolak')
                                    <div
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-error-600 px-5 py-3 text-white font-medium">
                                        {{ __('messages.Pendaftaran Ditolak') }}
                                    </div>
                                @else
                                    <div
                                        class="w-full inline-flex items-center justify-center rounded-xl bg-warning-600 px-5 py-3 text-white font-medium">
                                        {{ __('messages.Menunggu Persetujuan') }}
                                    </div>
                                @endif
                            @endif
                        @else
                            @if ($sudahDaftar->status === 'diterima')
                                <a href="{{ route('mahasiswa.registrations.ticket', $sudahDaftar->id) }}"
                                    class="w-full inline-flex items-center justify-center rounded-xl bg-brand-600 px-5 py-3 text-white font-medium hover:bg-brand-700 transition">
                                    {{ __('messages.Lihat Tiket') }}
                                </a>
                            @else
                                <button disabled
                                    class="w-full inline-flex items-center justify-center rounded-xl bg-gray-400 px-5 py-3 text-white font-medium cursor-not-allowed">
                                    {{ __('messages.Kuota Penuh') }}
                                </button>
                            @endif
                        @endif

                    </div>



                </aside>

            </div>
        </section>
    </div>
@endsection
