<x-guest-layout>
    <x-slot:header>Register</x-slot:header>
    <x-slot:header_text>Sign-up to create a new account.</x-slot:header_text>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-ui.input-label for="name" :value="__('Name')" />
            <x-ui.input-text id="name" name="name" type="text" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
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

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-ui.input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-ui.input-text id="password_confirmation" name="password_confirmation" type="password" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            <!-- Show Confirm Password -->
            <div class="block mt-2">
                <label for="show_confirm_password" class="inline-flex items-center">
                    <input id="show_confirm_password" type="checkbox"
                        class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring-gray-500"
                        name="show_confirm_password">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Show confirm password') }}</span>
                </label>
            </div>
        </div>

        <div class="flex flex-col gap-6 items-stretch sm:flex-row sm:gap-0 sm:items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-ui.primary-button class="sm:ms-3">
                Register
            </x-ui.primary-button>
        </div>
    </form>
</x-guest-layout>
