<div
    class="col-span-12 lg:col-span-3 h-fit lg:sticky lg:top-24 bg-white border border-gray-200 rounded-2xl shadow-theme-sm p-6">

    <!-- Profile -->
    <div>

        <div
            class="w-16 h-16 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 text-xl font-bold">

            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

        </div>

        <h2 class="mt-4 text-xl font-semibold text-gray-900 break-words">
            {{ auth()->user()->name }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 break-all">
            {{ auth()->user()->email }}
        </p>

    </div>

    <!-- Divider -->
    <div class="my-6 border-t border-gray-200"></div>

    <!-- Navigation -->
    <div class="space-y-2">

        <!-- Menu Item -->
        <!-- Route Event Saya -->
        <a href="{{ route('mahasiswa.events') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('mahasiswa.events') ? 'bg-brand-500 text-white font-medium' : 'text-gray-700 hover:bg-gray-50' }}">

            <svg xmlns="http://w3.org"
                class="w-5 h-5 {{ request()->routeIs('mahasiswa.events') ? 'text-white' : 'text-gray-500' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z" />
            </svg>

            <span>{{ __('messages.Event Saya') }}</span>

            <svg xmlns="http://w3.org"
                class="w-4 h-4 ml-auto {{ request()->routeIs('mahasiswa.events') ? 'text-white' : 'text-gray-400' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" />
            </svg>
        </a>

        <!-- Route Profil -->
        <a href="{{ route('mahasiswa.profile') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors {{ request()->routeIs('mahasiswa.profile') ? 'bg-brand-500 text-white font-medium' : 'text-gray-700 hover:bg-gray-50' }}">

            <svg xmlns="http://w3.org"
                class="w-5 h-5 {{ request()->routeIs('mahasiswa.profile') ? 'text-white' : 'text-gray-500' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                    fill="currentColor" />
            </svg>

            <span>{{ __('messages.Edit Profil') }}</span>

            <svg xmlns="http://w3.org"
                class="w-4 h-4 ml-auto {{ request()->routeIs('mahasiswa.profile') ? 'text-white' : 'text-gray-400' }}"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 18 6-6-6-6" />
            </svg>
        </a>

    </div>

    <!-- Divider -->
    <div class="my-6 border-t border-gray-200"></div>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="w-full flex items-center justify-center gap-2 rounded-xl bg-error-50 text-error-600 py-3 font-medium hover:bg-error-100 transition-colors">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 scale-x-[-1]" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16 17 5-5-5-5" />

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12H9" />

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />

            </svg>

            Keluar

        </button>
    </form>

</div>
