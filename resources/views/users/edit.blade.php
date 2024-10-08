<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <section class='section max-w-xl mx-auto'>
        <div class='grid gap-1'>
            <div class='text-gray-900 text-lg font-medium'>Edit User</div>
            <p class='text-sm text-gray-500'>Lorem ipsum dolor sit amet consectetur harum
                sequi aliquid officiis.</p>
        </div>


        <form method="POST" action="{{ route('users.update', ['user' => $user]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required
                    value="{{ $user->name }}" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required
                    value="{{ $user->email }}" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="role" class="block mb-2 text-sm font-medium">Role</x-input-label>
                <select id="role" name="role" required value=""
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option disabled>Select role</option>
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                    <option value="patient" @selected($user->role === 'patient')>Patient</option>
                </select>
            </div>

            <div class="flex items-center gap-4 justify-between">
                <x-link href="{{ route('users.show', ['user' => $user]) }}">{{ __('Back') }}</x-link>
                <x-primary-button>{{ __('Update User') }}</x-primary-button>
            </div>
        </form>
    </section>
</x-app-layout>
