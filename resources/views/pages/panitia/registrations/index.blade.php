@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="{{ __('messages.Konfirmasi Peserta') }}" />

    <x-common.component-card title="{{ __('messages.Daftar Peserta') }}"
        headerClass="flex flex-col w-full sm:flex-row sm:items-center sm:justify-between gap-y-4"
        desc="{{ __('messages.tp3') }}">

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
                    <p class="text-xs text-green-700">{{ __('messages.Diterima') }}</p>
                    <p class="font-semibold text-green-800">{{ $stats['diterima'] }}</p>
                </div>

                <div class="rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-center">
                    <p class="text-xs text-red-700">{{ __('messages.Ditolak') }}</p>
                    <p class="font-semibold text-red-800">{{ $stats['ditolak'] }}</p>
                </div>
            </div>
        </x-slot:action>

        <div class="rounded-2xl border border-gray-200 bg-white pt-4">

            <!-- Filter -->
            <div class="mb-4 flex flex-col gap-3 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ __('messages.Daftar Event') }}</h3>
                </div>
                <form method="GET" action="{{ route('panitia.registrations.index') }}"
                    class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    <div class="relative w-full sm:w-fit">
                        <button type="submit" class="absolute -translate-y-1/2 left-4 top-1/2">
                            <svg class="fill-gray-500" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z"
                                    fill="" />
                            </svg>
                        </button>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="{{ __('messages.Cari peserta') }}"
                            class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-[42px] pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 xl:w-[300px]" />
                    </div>

                    <div x-data="{
                        selectedEvent: '{{ request('event_id', '') }}',
                        get isOptionSelected() { return this.selectedEvent !== ''; }
                    }" class="w-full sm:w-fit">
                        <div class="relative z-20 bg-transparent">
                            <select x-model="selectedEvent" name="event_id" @change="$el.form.submit()"
                                class="w-full sm:w-fit shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-[42px] appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-10 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden"
                                :class="isOptionSelected ? 'text-gray-800' : 'text-gray-400'">

                                <option value="" class="text-gray-400">
                                    {{ __('messages.Semua Event') }}
                                </option>

                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}" class="text-gray-700">
                                        {{ $event->nama }}
                                    </option>
                                @endforeach
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

                    <div x-data="{
                        selectedStatus: '{{ request('status', '') }}',
                        get isOptionSelected() { return this.selectedStatus !== ''; }
                    }" class="w-full sm:w-fit">
                        <div class="relative z-20 bg-transparent">
                            <select x-model="selectedStatus" name="status" @change="$el.form.submit()"
                                class="w-full sm:w-fit shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-[42px] w-fit appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-10 text-sm placeholder:text-gray-400 focus:ring-3 focus:outline-hidden"
                                :class="isOptionSelected ? 'text-gray-800' : 'text-gray-400'">

                                <option value="" class="text-gray-400">
                                    {{ __('messages.Semua Status') }}
                                </option>

                                <option value="pending" class="text-gray-700">
                                    {{ __('messages.Pending') }}
                                </option>

                                <option value="diterima" class="text-gray-700">
                                    {{ __('messages.Diterima') }}
                                </option>

                                <option value="ditolak" class="text-gray-700">
                                    {{ __('messages.Ditolak') }}
                                </option>
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
            </div>

            <!-- Table -->
            <div class="overflow-hidden">
                <div class="max-w-full overflow-x-auto px-5">

                    <table class="min-w-full">
                        <thead>
                            <tr class="border-y border-gray-200">
                                <th class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500">
                                    {{ __('messages.Peserta') }}
                                </th>

                                <th class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500">
                                    Event
                                </th>

                                <th class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500">
                                    {{ __('messages.Tanggal Daftar') }}
                                </th>

                                <th class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500">
                                    Status
                                </th>

                                <th class="px-4 py-3 text-center text-theme-sm font-normal text-gray-500">
                                    {{ __('messages.Aksi') }}
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
                                                    {{ __('messages.Terima') }}
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
                                                    {{ __('messages.Tolak') }}
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
                    {{ __('messages.Konfirmasi Status') }}
                </h4>

                <p class="mb-6 text-sm text-gray-500">
                    {{ __('messages.Yakin ingin mengubah status') }}
                    <span class="font-medium text-gray-700" x-text="nama"></span>
                    {{ __('messages.menjadi') }}
                    <span class="font-semibold" x-text="status"></span>?
                </p>

                <div class="flex justify-center gap-3">

                    <button @click="open = false" type="button"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700">
                        {{ __('messages.Batal') }}
                    </button>

                    <form :action="`/panitia/registrations/${registrationId}/status`" method="POST">

                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="status" :value="status">

                        <button type="submit"
                            class="rounded-lg bg-blue-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-600">
                            {{ __('messages.Simpan') }}
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </x-ui.modal>
@endsection
