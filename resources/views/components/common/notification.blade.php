<div x-show="$store.notification.show" x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed top-4 right-6 z-99999 w-full max-w-xs sm:max-w-sm rounded-xl border border-gray-200 border-l-4 bg-white p-4 shadow-theme-md"
    :class="{
        'border-l-success-500': $store.notification.type === 'success',
        'border-l-blue-light-500': $store.notification.type === 'info',
        'border-l-warning-500': $store.notification.type === 'warning',
        'border-l-error-500': $store.notification.type === 'error',
    }"
    role="status" aria-live="polite">

    <div class="flex items-start gap-2">

        {{-- Icon --}}
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg"
            :class="{
                'bg-success-50': $store.notification.type === 'success',
                'bg-blue-light-50': $store.notification.type === 'info',
                'bg-warning-50': $store.notification.type === 'warning',
                'bg-error-50': $store.notification.type === 'error',
            }">

            {{-- Success --}}
            <template x-if="$store.notification.type === 'success'">
                <svg class="h-5 w-5 text-success-600" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </template>

            {{-- Info --}}
            <template x-if="$store.notification.type === 'info'">
                <svg class="h-5 w-5 text-blue-light-600" viewBox="0 0 24 24" fill="none">
                    <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />

                    <path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />

                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
                </svg>
            </template>

            {{-- Warning --}}
            <template x-if="$store.notification.type === 'warning'">
                <svg class="h-5 w-5 text-warning-600" viewBox="0 0 24 24" fill="none">
                    <path d="M10.29 3.86L1.82 18a1 1 0 0 0 .85 1.5h18.66a1 1 0 0 0 .85-1.5L13.71 3.86a1 1 0 0 0-1.72 0z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />

                    <path d="M12 9v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />

                    <path d="M12 17h.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </template>

            {{-- Error --}}
            <template x-if="$store.notification.type === 'error'">
                <svg class="h-5 w-5 text-error-600" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />

                    <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </template>

        </div>

        {{-- Content --}}
        <div class="min-w-0 flex-1">

            <p class="text-sm font-semibold text-gray-800"
                :class="{
                    'text-success-700': $store.notification.type === 'success',
                    'text-blue-light-700': $store.notification.type === 'info',
                    'text-warning-700': $store.notification.type === 'warning',
                    'text-error-700': $store.notification.type === 'error',
                }">

                <span x-show="$store.notification.type === 'success'">{{ __('messages.Berhasil') }}</span>
                <span x-show="$store.notification.type === 'info'">{{ __('messages.Informasi') }}</span>
                <span x-show="$store.notification.type === 'warning'">{{ __('messages.Perhatian') }}</span>
                <span x-show="$store.notification.type === 'error'">{{ __('messages.Terjadi Kesalahan') }}</span>

                {{-- <span x-show="$store.notification.type === 'success'">Berhasil</span>
                <span x-show="$store.notification.type === 'info'">Informasi</span>
                <span x-show="$store.notification.type === 'warning'">Perhatian</span>
                <span x-show="$store.notification.type === 'error'">Terjadi Kesalahan</span> --}}

            </p>

            <p class="text-sm text-gray-600 break-words" x-text="$store.notification.message">
            </p>

        </div>

        {{-- Close --}}
        <button @click="$store.notification.close()" type="button"
            class="shrink-0 rounded-lg p-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-600"
            aria-label="Tutup notifikasi">

            <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z" />
            </svg>

        </button>

    </div>

</div>

{{-- Flash Session Laravel --}}
@php
    $flashMap = [
        'success' => session('success'),
        'error' => session('error'),
        'warning' => session('warning'),
        'info' => session('info'),
    ];

    $flashType = collect($flashMap)->filter()->keys()->first();
    $flashMessage = $flashType ? $flashMap[$flashType] : null;
@endphp

@if ($flashMessage)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Alpine.store('notification').fire(
                '{{ $flashType }}',
                @js($flashMessage)
            );
        });
    </script>
@endif
