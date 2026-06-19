{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}
@extends('layouts.fullscreen-layout')

@section('content')
    <div class="relative z-1 bg-white p-6 sm:p-0">
        <div class="relative flex h-screen w-full flex-col justify-center sm:p-0 lg:flex-row">

            <!-- Content -->
            <div class="flex w-full flex-1 flex-col lg:w-1/2">
                <div class="mx-auto w-full max-w-md pt-10">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center text-sm text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 20 20" fill="none">
                            <path d="M12.7083 5L7.5 10.2083L12.7083 15.4167" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>

                <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
                    <div class="mb-5 sm:mb-8">
                        <h1 class="text-title-sm sm:text-title-md mb-2 font-semibold text-gray-800 dark:text-white/90">
                            Verifikasi Email Anda
                        </h1>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Kami telah mengirimkan tautan verifikasi ke alamat email Anda.
                            Silakan buka email tersebut dan klik tombol verifikasi untuk
                            mengaktifkan akun Anda.
                        </p>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div
                            class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-800 dark:bg-green-900/20 dark:text-green-400">
                            Tautan verifikasi baru telah berhasil dikirim ke alamat email Anda.
                        </div>
                    @endif

                    <div class="space-y-5">

                        <!-- Email Information -->
                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Email verifikasi dikirim ke:
                            </p>

                            <p class="mt-1 font-medium text-gray-800 dark:text-white">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <!-- Resend Verification Email -->
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <button type="submit"
                                class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 flex w-full items-center justify-center rounded-lg px-4 py-3 text-sm font-medium text-white transition">
                                Kirim Ulang Email Verifikasi
                            </button>
                        </form>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="dark:bg-dark-900 shadow-theme-xs hover:bg-gray-100 dark:hover:bg-dark-800 flex w-full items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 transition dark:border-gray-700 dark:text-gray-300">
                                Keluar dari Akun
                            </button>
                        </form>

                    </div>

                    <div class="mt-5">
                        <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                            Tidak menemukan email?
                            Periksa folder <span class="font-medium">Spam</span> atau
                            <span class="font-medium">Promosi</span>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="bg-brand-950 relative hidden h-full w-full items-center lg:grid lg:w-1/2">
                <div class="z-1 flex items-center justify-center">

                    <x-common.common-grid-shape />

                    <div class="flex max-w-xs flex-col items-center">
                        <a href="{{ url('/') }}" class="mb-4 block">
                            <img src="./images/logo/auth-logo.svg" alt="Logo" />
                        </a>

                        <p class="text-center text-gray-400">
                            Verifikasi email diperlukan untuk memastikan keamanan akun
                            dan mengaktifkan seluruh fitur sistem.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
