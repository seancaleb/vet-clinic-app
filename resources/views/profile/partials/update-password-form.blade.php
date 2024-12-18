<section>
    <header>
        <h2 class="text-lg font-medium text-gray-800">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-ui.input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-ui.input-text id="update_password_current_password" name="current_password" type="password"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

        </div>

        <div>
            <x-ui.input-label for="update_password_password" :value="__('New Password')" />
            <x-ui.input-text id="update_password_password" name="password" type="password"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-ui.input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-ui.input-text id="update_password_password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-ui.primary-button
                class="flex items-center gap-2 w-full justify-center sm:w-fit">{{ __('Save') }}</x-ui.primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
