<x-guest-layout>
    <x-slot:header>Confirm Password</x-slot:header>
    <x-slot:header_text>This is a secure area of the application. Please confirm your password before
        continuing.</x-slot:header_text>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-ui.input-label for="password" :value="__('Password')" />
            <x-ui.input-text id="password" name="password" type="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <x-ui.primary-button class="w-full sm:w-fit">
                Confirm
            </x-ui.primary-button>
        </div>
    </form>
</x-guest-layout>
