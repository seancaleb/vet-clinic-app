<x-app-layout>
    <x-slot:header>{{ __('Profile') }}</x-slot:header>

    <div class="max-w-4xl mx-auto py-6 sm:py-0 sm:px-6 space-y-6">
        <div class="px-6 py-8 sm:p-8 bg-white sm:shadow sm:rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="px-6 py-8 sm:p-8 bg-white sm:shadow sm:rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="px-6 py-8 sm:p-8 bg-white sm:shadow sm:rounded-xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
