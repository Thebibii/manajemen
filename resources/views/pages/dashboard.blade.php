@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 md:gap-6">

                {{-- Total Events --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.25 5.5C3.25 4.25736 4.25736 3.25 5.5 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V18.5C20.75 19.7426 19.7426 20.75 18.5 20.75H5.5C4.25736 20.75 3.25 19.7426 3.25 18.5V5.5ZM5.5 4.75C5.08579 4.75 4.75 5.08579 4.75 5.5V8.58325L19.25 8.58325V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H5.5ZM19.25 10.0833H15.416V13.9165H19.25V10.0833ZM13.916 10.0833L10.083 10.0833V13.9165L13.916 13.9165V10.0833ZM8.58301 10.0833H4.75V13.9165H8.58301V10.0833ZM4.75 18.5V15.4165H8.58301V19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5ZM10.083 19.25V15.4165L13.916 15.4165V19.25H10.083ZM15.416 19.25V15.4165H19.25V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15.416Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <div class="flex items-end justify-between mt-5">
                        <div>
                            <span class="text-sm text-gray-500">{{ __('messages.Total Event') }}</span>
                            <h4 class="mt-2 font-bold text-gray-800 text-title-sm">{{ $totalEvents }}</h4>
                        </div>
                    </div>
                </div>

                {{-- Total Pendaftar --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                    <div class="flex items-end justify-between mt-5">
                        <div>
                            <span class="text-sm text-gray-500">{{ __('messages.Total Pendaftar') }}</span>
                            <h4 class="mt-2 font-bold text-gray-800 text-title-sm">{{ $totalPendaftar }}</h4>
                        </div>
                    </div>
                </div>

                {{-- Menunggu Approval --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-warning-50 rounded-xl">
                        <svg class="fill-warning-500" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2Zm0 5a1 1 0 0 1 1 1v4a1 1 0 1 1-2 0V8a1 1 0 0 1 1-1Zm0 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z"
                                fill="" />
                        </svg>
                    </div>
                    <div class="flex items-end justify-between mt-5">
                        <div>
                            <span class="text-sm text-gray-500">{{ __('messages.Menunggu Approval') }}</span>
                            <h4 class="mt-2 font-bold text-gray-800 text-title-sm">{{ $totalPending }}</h4>
                        </div>
                        @if ($totalPendaftar > 0)
                            <span
                                class="flex items-center gap-1 rounded-full bg-warning-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-warning-600">
                                {{ round(($totalPending / $totalPendaftar) * 100, 1) }}%
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Pendaftar Diterima --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-success-50 rounded-xl">
                        <svg class="fill-success-500" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2Zm4.707 7.293a1 1 0 0 0-1.414 0L10 14.586l-2.293-2.293a1 1 0 0 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l6-6a1 1 0 0 0 0-1.414Z"
                                fill="" />
                        </svg>
                    </div>
                    <div class="flex items-end justify-between mt-5">
                        <div>
                            <span class="text-sm text-gray-500">{{ __('messages.Pendaftar Diterima') }}</span>
                            <h4 class="mt-2 font-bold text-gray-800 text-title-sm">{{ $totalDiterima }}</h4>
                        </div>
                        @if ($totalPendaftar > 0)
                            <span
                                class="flex items-center gap-1 rounded-full bg-success-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-success-600">
                                {{ round(($totalDiterima / $totalPendaftar) * 100, 1) }}%
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <div class="col-span-12 space-y-6 xl:col-span-7 ">
            <div class="rounded-2xl border border-gray-200 bg-white px-5 pt-5 sm:px-6 sm:pt-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ __('messages.Pendaftar per Event') }}
                    </h3>
                </div>

                <div class="w-full">
                    <div id="chartOne" class="w-full"></div>
                </div>
            </div>

            <script>
                window.__chartOneLabels = @json($eventLabels);
                window.__chartOneData = @json($eventData);

                window.translations = {
                    pendaftar: @json(__('messages.pendaftar')),
                    Pendaftar: @json(__('messages.Pendaftar')),
                };
            </script>

        </div>
        <div class="col-span-12 xl:col-span-5">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ __('messages.Status Registrasi') }}
                    </h3>
                    <p class="mt-1 text-theme-sm text-gray-500">
                        {{ __('messages.Distribusi status pendaftar seluruh event') }}
                    </p>
                </div>

                <div
                    class="border-gray-200 my-6  rounded-2xl border bg-gray-50 px-4 py-6 sm:px-6 flex items-center justify-center">
                    <div id="chartSeven" class="h-[212px] w-full"></div>
                </div>

                {{-- @php
                    $total = $totalPendaftar > 0 ? $totalPendaftar : 1;
                    $statuses = [
                        [
                            'label' => 'Diterima',
                            'count' => $totalDiterima,
                            'percentage' => round(($totalDiterima / $total) * 100),
                            'color' => 'bg-success-500',
                        ],
                        [
                            'label' => 'Pending',
                            'count' => $totalPending,
                            'percentage' => round(($totalPending / $total) * 100),
                            'color' => 'bg-warning-500',
                        ],
                        [
                            'label' => 'Ditolak',
                            'count' => $totalDitolak,
                            'percentage' => round(($totalDitolak / $total) * 100),
                            'color' => 'bg-error-500',
                        ],
                    ];
                @endphp

                <div class="space-y-5">
                    @foreach ($statuses as $status)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full {{ $status['color'] }}"></div>
                                <div>
                                    <p class="text-theme-sm font-semibold text-gray-800">
                                        {{ $status['label'] }}
                                    </p>
                                    <span class="block text-theme-xs text-gray-500">
                                        {{ $status['count'] }} Pendaftar
                                    </span>
                                </div>
                            </div>

                            <div class="flex w-full max-w-[140px] items-center gap-3">
                                <div class="relative block h-2 w-full max-w-[100px] rounded-sm bg-gray-200">
                                    <div class="absolute left-0 top-0 flex h-full items-center justify-center rounded-sm {{ $status['color'] }}"
                                        style="width: {{ $status['percentage'] }}%"></div>
                                </div>
                                <p class="text-theme-sm font-medium text-gray-800">
                                    {{ $status['percentage'] }}%
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
            </div>

            <script>
                window.__chartSevenData = {
                    labels: ['Diterima', 'Pending', 'Ditolak'],
                    series: [{{ $totalDiterima }}, {{ $totalPending }}, {{ $totalDitolak }}],
                };
            </script>
        </div>
    </div>
@endsection
