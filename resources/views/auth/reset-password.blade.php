@extends('layouts.fullscreen-layout')

@section('content')
    <div class="relative z-1 bg-white p-6 sm:p-0">
        <div class="relative flex h-screen w-full flex-col justify-center sm:p-0 lg:flex-row">

            <!-- Content -->
            <div class="flex w-full flex-1 flex-col lg:w-1/2">
                <div class="mx-auto w-full flex justify-between items-center max-w-md pt-10">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center text-sm text-gray-500 transition-colors hover:text-gray-700">
                        <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            viewBox="0 0 20 20" fill="none">
                            <path d="M12.7083 5L7.5 10.2083L12.7083 15.4167" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        {{ __('messages.Back to Login') }}
                    </a>
                    <x-header.lang-dropdown />
                </div>

                <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
                    <div class="mb-5 sm:mb-8">
                        <h1 class="text-title-sm sm:text-title-md mb-2 font-semibold text-gray-800">
                            {{ __('messages.Reset Password') }}
                        </h1>
                    </div>

                    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email -->
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
                                {{ __('Email') }}
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                                autofocus autocomplete="username"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 @error('email') border-red-400 focus:border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('email')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
                                {{ __('messages.Password') }}
                            </label>
                            <input id="password" type="password" name="password" autocomplete="new-password"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 @error('password') border-red-400 focus:border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('password')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700">
                                {{ __('messages.Confirm Password') }}
                            </label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                autocomplete="new-password"
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 @error('password_confirmation') border-red-400 focus:border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('password_confirmation')
                                <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 flex w-full items-center justify-center rounded-lg px-4 py-3 text-sm font-medium text-white transition">
                            {{ __('messages.Reset Password') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side -->
            <div class="bg-brand-950 relative hidden h-full w-full items-center lg:grid lg:w-1/2">
                <div class="z-1 flex items-center justify-center">
                    <x-common.common-grid-shape />
                    <div class="flex max-w-xs flex-col items-center">
                        <a href="{{ route('welcome') }}" class="mb-4 block text-title-md text-white">
                            Event Kampus
                        </a>
                        <p class="text-center text-gray-400">
                            {{ __('messages.Temukan dan Kelola') }} {{ __('messages.Kegiatan Kampus dengan Mudah') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
