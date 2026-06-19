@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Konfirmasi Peserta" />

    <x-common.component-card title="Daftar Peserta"
        headerClass="flex-col items-start w-full sm:flex-row sm:items-center sm:justify-between"
        desc="Kelola peserta yang mendaftar ke event Anda">

        <x-slot:action>
            <div class="flex items-center gap-3">
                <div class="rounded-lg border border-gray-200 px-3 py-2 text-center">
                    <p class="text-xs text-gray-500">Total</p>
                    <p class="font-semibold text-gray-800">{{ $stats['total'] }}</p>
                </div>

                <div class="rounded-lg border border-yellow-200 bg-yellow-50 px-3 py-2 text-center">
                    <p class="text-xs text-yellow-700">Pending</p>
                    <p class="font-semibold text-yellow-800">{{ $stats['pending'] }}</p>
                </div>

                <div class="rounded-lg border border-green-200 bg-green-50 px-3 py-2 text-center">
                    <p class="text-xs text-green-700">Diterima</p>
                    <p class="font-semibold text-green-800">{{ $stats['diterima'] }}</p>
                </div>

                <div class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-center">
                    <p class="text-xs text-red-700">Ditolak</p>
                    <p class="font-semibold text-red-800">{{ $stats['ditolak'] }}</p>
                </div>
            </div>
        </x-slot:action>

        @if (session('success'))
            <div class="mx-5 mt-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mx-5 mt-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="rounded-2xl border border-gray-200 bg-white pt-4">

            <!-- Filter -->
            <div class="mb-4 flex flex-col gap-3 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Event</h3>
                </div>
                <form method="GET" action="{{ route('panitia.registrations.index') }}"
                    class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    <div class="relative">
                        <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2">
                            <svg class="fill-gray-500" width="20" height="20" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381Z" />
                            </svg>
                        </button>

                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peserta..."
                            class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm xl:w-[280px]" />
                    </div>

                    <select name="event_id" onchange="this.form.submit()"
                        class="h-[42px] rounded-lg border border-gray-300 px-4 text-sm">
                        <option value="">Semua Event</option>

                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" @selected(request('event_id') == $event->id)>
                                {{ $event->nama }}
                            </option>
                        @endforeach
                    </select>

                    <select name="status" onchange="this.form.submit()"
                        class="h-[42px] rounded-lg border border-gray-300 px-4 text-sm">
                        <option value="">Semua Status</option>
                        <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                        <option value="diterima" @selected(request('status') == 'diterima')>Diterima</option>
                        <option value="ditolak" @selected(request('status') == 'ditolak')>Ditolak</option>
                    </select>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-hidden">
                <div class="max-w-full overflow-x-auto px-5">

                    <table class="min-w-full">
                        <thead>
                            <tr class="border-y border-gray-200">
                                <th class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500">
                                    Peserta
                                </th>

                                <th class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500">
                                    Event
                                </th>

                                <th class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500">
                                    Tanggal Daftar
                                </th>

                                <th class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500">
                                    Status
                                </th>

                                <th class="px-4 py-3 text-center text-theme-sm font-normal text-gray-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($registrations as $registration)
                                <tr>

                                    <td class="px-4 py-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $registration->user->name }}
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ $registration->user->email }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-700">
                                            {{ $registration->event->nama }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-500">
                                            {{ $registration->created_at->format('d M Y, H:i') }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-4">
                                        <x-ui.badge
                                            color="{{ $registration->status === 'diterima'
                                                ? 'success'
                                                : ($registration->status === 'ditolak'
                                                    ? 'error'
                                                    : 'warning') }}"
                                            size="sm">
                                            {{ ucfirst($registration->status) }}
                                        </x-ui.badge>
                                    </td>

                                    <td class="px-4 py-4">
                                        <div class="flex justify-center gap-2">

                                            @if ($registration->status !== 'diterima')
                                                <button
                                                    @click="$dispatch('open-status-modal',{
                                                        id: {{ $registration->id }},
                                                        status:'diterima',
                                                        nama:'{{ $registration->user->name }}'
                                                    })"
                                                    class="rounded-lg bg-green-500 px-3 py-2 text-xs font-medium text-white hover:bg-green-600">
                                                    Terima
                                                </button>
                                            @endif

                                            @if ($registration->status !== 'ditolak')
                                                <button
                                                    @click="$dispatch('open-status-modal',{
                                                        id: {{ $registration->id }},
                                                        status:'ditolak',
                                                        nama:'{{ $registration->user->name }}'
                                                    })"
                                                    class="rounded-lg bg-red-500 px-3 py-2 text-xs font-medium text-white hover:bg-red-600">
                                                    Tolak
                                                </button>
                                            @endif

                                            @if ($registration->status !== 'pending')
                                                <button
                                                    @click="$dispatch('open-status-modal',{
                                                        id: {{ $registration->id }},
                                                        status:'pending',
                                                        nama:'{{ $registration->user->name }}'
                                                    })"
                                                    class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50">
                                                    Pending
                                                </button>
                                            @endif

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">
                                        Belum ada peserta yang mendaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

            @if ($registrations->hasPages())
                @php
                    $current = $registrations->currentPage();
                    $last = $registrations->lastPage();
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
                        @if ($registrations->onFirstPage())
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
                            <a href="{{ $registrations->previousPageUrl() }}"
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
                                        <a href="{{ $registrations->url($page) }}"
                                            class="flex h-10 w-10 items-center justify-center rounded-lg text-theme-sm font-medium {{ $current === $page ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-500/[0.08] hover:text-blue-500' }}">
                                            {{ $page }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        @if ($registrations->hasMorePages())
                            <a href="{{ $registrations->nextPageUrl() }}"
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

    </x-common.component-card>

    <x-ui.modal class="max-w-[420px] p-6 lg:p-8">
        <div x-data="{
            registrationId: null,
            status: '',
            nama: ''
        }"
            @open-status-modal.window="
                open = true;
                registrationId = $event.detail.id;
                status = $event.detail.status;
                nama = $event.detail.nama;
            ">

            <div class="text-center">

                <h4 class="mb-2 text-lg font-semibold text-gray-800">
                    Konfirmasi Status
                </h4>

                <p class="mb-6 text-sm text-gray-500">
                    Yakin ingin mengubah status
                    <span class="font-medium text-gray-700" x-text="nama"></span>
                    menjadi
                    <span class="font-semibold" x-text="status"></span>?
                </p>

                <div class="flex justify-center gap-3">

                    <button @click="open = false" type="button"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700">
                        Batal
                    </button>

                    <form :action="`/panitia/registrations/${registrationId}/status`" method="POST">

                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="status" :value="status">

                        <button type="submit"
                            class="rounded-lg bg-blue-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-600">
                            Simpan
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </x-ui.modal>
@endsection
