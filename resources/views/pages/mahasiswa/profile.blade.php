@extends('layouts.mahasiswa')

@section('content')
    <div class="col-span-12 lg:col-span-9 space-y-6">

        {{-- ===================== --}}
        {{-- 1. INFORMASI PROFIL  --}}
        {{-- ===================== --}}
        <x-common.component-card title="{{__('messages.Informasi Profil')}}" desc="{{__('messages.Perbarui nama dan alamat email akun Anda.')}}">

            <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('patch')

                {{-- Nama --}}
                <div>
                    <x-input-label for="name" :value="__('messages.Nama Lengkap')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                        required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('messages.Alamat Email')" />
                    <x-text-input id="email" name="email" disabled="true" type="email" class="mt-1 block w-full"
                        :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />


                </div>



                {{-- Submit --}}
                <div class="flex items-center gap-4 pt-1">
                    <x-ui.button type="submit">{{ __('messages.Simpan Perubahan') }}</x-ui.button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                            class="text-sm text-green-600">
                            {{ __('Profil berhasil diperbarui.') }}
                        </p>
                    @endif
                </div>
            </form>

            {{-- Form kirim ulang verifikasi (tersembunyi, dipanggil via button di atas) --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
                    @csrf
                </form>
            @endif

        </x-common.component-card>

        {{-- ================== --}}
        {{-- 2. UBAH PASSWORD   --}}
        {{-- ================== --}}
        <x-common.component-card title="{{__('messages.Ubah Password')}}"
            desc="{{__('messages.Desc Password')}}">

            <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                @method('put')

                {{-- Password Saat Ini --}}
                <div>
                    <x-input-label for="current_password" :value="__('messages.Password Saat Ini')" />
                    <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                {{-- Password Baru --}}
                <div>
                    <x-input-label for="password" :value="__('messages.Password Baru')" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <x-input-label for="password_confirmation" :value="__('messages.Konfirmasi Password Baru')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                        class="mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- Submit --}}
                <div class="flex items-center gap-4 pt-1">
                    <x-ui.button>{{ __('messages.Perbarui Password') }}</x-ui.button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                            class="text-sm text-green-600">
                            {{ __('Password berhasil diperbarui.') }}
                        </p>
                    @endif
                </div>
            </form>

        </x-common.component-card>
    </div>
@endsection
