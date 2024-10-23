<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <x-slot:header>Log in</x-slot:header>
    <x-slot:header_text>Sign-in to your account.</x-slot:header_text>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-ui.input-label for="email" :value="__('Email')" />
            <x-ui.input-text id="email" name="email" type="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-ui.input-label for="password" :value="__('Password')" />
            <x-ui.input-text id="password" name="password" type="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Show Password -->
            <div class="block mt-2">
                <label for="show_password" class="inline-flex items-center">
                    <input id="show_password" type="checkbox"
                        class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring-gray-500"
                        name="show_password">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Show password') }}</span>
                </label>
            </div>
        </div>

        {{-- <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring-gray-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

        <div class="flex flex-col gap-6 items-stretch sm:flex-row sm:gap-0 sm:items-center justify-end mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-ui.primary-button class="sm:ms-3">
                Log in
            </x-ui.primary-button>
        </div>
    </form>
</x-guest-layout>
