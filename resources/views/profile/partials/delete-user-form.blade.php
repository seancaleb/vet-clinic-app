<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-800">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-ui.primary-button class="bg-red-700 hover:bg-red-800 focus:ring-red-300" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Delete Account') }}
    </x-ui.primary-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-800">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-ui.input-label for="password" :value="__('Password')" class="sr-only" />
                <x-ui.input-text id="password" name="password" type="password" placeholder="Password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />

            </div>

            <div class="mt-6 flex justify-end">
                <x-ui.alternative-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-ui.alternative-button>

                <x-ui.primary-button class="bg-red-700 hover:bg-red-800 focus:ring-red-300 ms-3">
                    {{ __('Delete Account') }}
                </x-ui.primary-button>
            </div>
        </form>
    </x-modal>
</section>
