@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="From Elements" />
    <x-common.component-card title="Buat Event Baru">
        <form action="{{ route('panitia.events.store') }}" method="POST" class="space-y-5" enctype="multipart/form-data">
            @csrf

            <!-- Nama Event -->
            <div>
                <label for="nama" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Nama Event
                </label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
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
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal dan Waktu Event -->
            <div>
                <label for="tanggal" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Tanggal & Waktu Pelaksanaan
                </label>
                <input type="datetime-local" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"
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
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
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
                <input type="number" id="kuota" name="kuota" value="{{ old('kuota') }}" min="1"
                    placeholder="0"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden @error('kuota') border-red-500 @enderror" />
                @error('kuota')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div x-data="{ preview: null }">
                <label for="gambar" class="mb-1.5 block text-sm font-medium text-gray-700">
                    Upload Gambar Event
                </label>

                <input type="file" name="gambar" id="gambar" accept="image/*"
                    @change="preview = URL.createObjectURL($event.target.files[0])"
                    class="focus:border-ring-brand-300 shadow-theme-xs h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-gray-200 file:bg-gray-50 file:px-3.5 file:py-3 file:text-sm file:text-gray-700">

                <div class="mt-3 w-full md:w-1/2">
                    <div class="aspect-video overflow-hidden rounded-lg border border-gray-200">
                        <template x-if="preview">
                            <img :src="preview" alt="Preview" class="h-full w-full object-cover">
                        </template>

                        <template x-if="!preview">
                            <div class="flex h-full items-center justify-center bg-gray-50 text-sm text-gray-500">
                                Belum ada gambar dipilih
                            </div>
                        </template>
                    </div>
                </div>
            </div>


            <!-- Tombol Submit -->
            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-lg shadow-xs focus:ring-4 focus:ring-brand-500/20 transition-all cursor-pointer">
                    Simpan Event
                </button>
            </div>
        </form>
    </x-common.component-card>
@endsection
