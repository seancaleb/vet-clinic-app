<x-guest-layout>
    <x-slot:header>Reset Password</x-slot:header>
    <x-slot:header_text>Reset and add your new password.</x-slot:header_text>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-ui.input-label for="email" :value="__('Email')" />

            <x-ui.input-text id="email" name="email" type="email" required value="{{ request()->email }}" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-ui.input-label for="password" :value="__('Password')" />
            <x-ui.input-text id="password" name="password" type="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-ui.input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-ui.input-text id="password_confirmation" name="password_confirmation" type="password" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-ui.primary-button class="w-full sm:w-fit">
                Reset Password
            </x-ui.primary-button>
        </div>
    </form>
</x-guest-layout>
