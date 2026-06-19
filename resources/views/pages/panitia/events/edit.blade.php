@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Form Elements" />
    <x-common.component-card title="Edit Event">
        <form action="{{ route('panitia.events.update', $event->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Nama Event -->
            <div>
                <label for="nama" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Nama Event
                </label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $event->nama) }}"
                    placeholder="Masukkan nama event"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden @error('nama') border-red-500 @enderror" />
                @error('nama')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi Event -->
            <div>
                <label for="deskripsi" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Deskripsi
                </label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan detail mengenai event ini..."
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                @error('deskripsi')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal dan Waktu Event -->
            <div>
                <label for="tanggal" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Tanggal & Waktu Pelaksanaan
                </label>
                <input type="datetime-local" id="tanggal" name="tanggal"
                    value="{{ old('tanggal', is_string($event->tanggal) ? date('Y-m-d\TH:i', strtotime($event->tanggal)) : $event->tanggal?->format('Y-m-d\TH:i')) }}"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:ring-3 focus:outline-hidden @error('tanggal') border-red-500 @enderror" />
                @error('tanggal')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Lokasi -->
            <div>
                <label for="lokasi" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Lokasi
                </label>
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}"
                    placeholder="Contoh: Gedung Serbaguna / Zoom Meeting"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden @error('lokasi') border-red-500 @enderror" />
                @error('lokasi')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kuota Peserta -->
            <div>
                <label for="kuota" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Kuota Peserta
                </label>
                <input type="number" id="kuota" name="kuota" value="{{ old('kuota', $event->kuota) }}" min="1"
                    placeholder="0"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden @error('kuota') border-red-500 @enderror" />
                @error('kuota')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end pt-2 gap-3">
                <a href="{{ route('panitia.events.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 border border-gray-300 rounded-lg shadow-xs focus:ring-4 focus:ring-gray-100 transition-all cursor-pointer">
                    Batal
                </a>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-lg shadow-xs focus:ring-4 focus:ring-brand-500/20 transition-all cursor-pointer">
                    Perbarui Event
                </button>
            </div>
        </form>
    </x-common.component-card>
@endsection
