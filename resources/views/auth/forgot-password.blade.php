{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layouts.fullscreen-layout')

@section('content')
    <div class="relative z-1 bg-white p-6 sm:p-0">
        <div class="relative flex h-screen w-full flex-col justify-center sm:p-0 lg:flex-row">

            <div class="flex w-full flex-1 flex-col lg:w-1/2">
                <div class="mx-auto w-full max-w-md pt-10">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center text-sm text-gray-500 transition-colors hover:text-gray-700  ">
                        <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 20 20" fill="none">
                            <path d="M12.7083 5L7.5 10.2083L12.7083 15.4167" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Back to Login
                    </a>
                </div>

                <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
                    <div class="mb-5 sm:mb-8">
                        <h1 class="text-title-sm sm:text-title-md mb-2 font-semibold text-gray-800">
                            Forgot Your Password?
                        </h1>
                        <p class="text-sm text-gray-500 ">
                            Enter the email address linked to your account, and we'll send
                            you a link to reset your password.
                        </p>
                    </div>

                    {{-- Success Message --}}
                    @if (session('status'))
                        <div class="mb-4 rounded-lg border border-success-200 bg-success-50 p-4 text-sm text-success-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="space-y-5">
                                {{-- Email --}}
                                <div>
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 ">
                                        Email <span class="text-error-500">*</span>
                                    </label>

                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Enter your email" required autofocus
                                        class=" font-normal shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden">

                                    @error('email')
                                        <p class="mt-2 text-sm text-error-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Submit Button --}}
                                <div>
                                    <button type="submit"
                                        class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 flex w-full items-center justify-center rounded-lg px-4 py-3 text-sm font-medium text-white transition">
                                        Send Reset Link
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="mt-5">
                            <p class="text-center text-sm font-normal text-gray-700 sm:text-start ">
                                Wait, I remember my password...
                                <a href="{{ route('login') }}" class="text-brand-500 hover:text-brand-600">
                                    Login
                                </a>
                            </p>
                        </div>
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
