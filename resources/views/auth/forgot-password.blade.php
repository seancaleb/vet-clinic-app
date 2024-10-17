<x-guest-layout>
    <x-slot:header>Forgot Password</x-slot:header>
    <x-slot:header_text>Forgot your password? No problem. Just let us know your email address and we will email you a
        password reset link that will allow you to choose a new one.</x-slot:header_text>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-ui.input-label for="email" :value="__('Email')" />
            <x-ui.input-text id="email" name="email" type="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-start mt-6">
            <x-ui.primary-button class="w-full sm:w-fit">
                Email Password Reset Link
            </x-ui.primary-button>
        </div>
    </form>
</x-guest-layout>
