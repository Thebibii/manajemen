@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 md:gap-6">

                {{-- Total Events --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl">
                        <svg class="fill-gray-800" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8 2a1 1 0 0 1 1 1v1h6V3a1 1 0 1 1 2 0v1h1a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1V3a1 1 0 0 1 1-1Zm-2 6a1 1 0 0 0 0 2h12a1 1 0 1 0 0-2H6Z"
                                fill="" />
                        </svg>
                    </div>
                    <div class="flex items-end justify-between mt-5">
                        <div>
                            <span class="text-sm text-gray-500">Total Event</span>
                            <h4 class="mt-2 font-bold text-gray-800 text-title-sm">{{ $totalEvents }}</h4>
                        </div>
                    </div>
                </div>

                {{-- Total Pendaftar --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-xl">
                        <svg class="fill-gray-800" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.80443 5.60156C7.59109 5.60156 6.60749 6.58517 6.60749 7.79851C6.60749 9.01185 7.59109 9.99545 8.80443 9.99545C10.0178 9.99545 11.0014 9.01185 11.0014 7.79851C11.0014 6.58517 10.0178 5.60156 8.80443 5.60156ZM5.10749 7.79851C5.10749 5.75674 6.76267 4.10156 8.80443 4.10156C10.8462 4.10156 12.5014 5.75674 12.5014 7.79851C12.5014 9.84027 10.8462 11.4955 8.80443 11.4955C6.76267 11.4955 5.10749 9.84027 5.10749 7.79851ZM4.86252 15.3208C4.08769 16.0881 3.70377 17.0608 3.51705 17.8611C3.48384 18.0034 3.5211 18.1175 3.60712 18.2112C3.70161 18.3141 3.86659 18.3987 4.07591 18.3987H13.4249C13.6343 18.3987 13.7992 18.3141 13.8937 18.2112C13.9797 18.1175 14.017 18.0034 13.9838 17.8611C13.7971 17.0608 13.4132 16.0881 12.6383 15.3208C11.8821 14.572 10.6899 13.955 8.75042 13.955C6.81096 13.955 5.61877 14.572 4.86252 15.3208ZM3.8071 14.2549C4.87163 13.2009 6.45602 12.455 8.75042 12.455C11.0448 12.455 12.6292 13.2009 13.6937 14.2549C14.7397 15.2906 15.2207 16.5607 15.4446 17.5202C15.7658 18.8971 14.6071 19.8987 13.4249 19.8987H4.07591C2.89369 19.8987 1.73504 18.8971 2.05628 17.5202C2.28015 16.5607 2.76117 15.2906 3.8071 14.2549Z"
                                fill="" />
                        </svg>
                    </div>
                    <div class="flex items-end justify-between mt-5">
                        <div>
                            <span class="text-sm text-gray-500">Total Pendaftar</span>
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
                            <span class="text-sm text-gray-500">Menunggu Approval</span>
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
                            <span class="text-sm text-gray-500">Pendaftar Diterima</span>
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
                        Pendaftar per Event
                    </h3>
                </div>

                <div class="w-full">
                    <div id="chartOne" class="w-full"></div>
                </div>
            </div>

            <script>
                window.__chartOneLabels = @json($eventLabels);
                window.__chartOneData = @json($eventData);
            </script>

        </div>
        <div class="col-span-12 xl:col-span-5">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 sm:p-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Status Registrasi
                    </h3>
                    <p class="mt-1 text-theme-sm text-gray-500">
                        Distribusi status pendaftar seluruh event
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
