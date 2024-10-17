@php
    $role_options = ['admin', 'patient'];
@endphp

<x-app-layout>
    <x-slot:header>
        Manage user
    </x-slot:header>


    <section class='section mx-auto max-w-xl'>
        <header>
            <h2 class="text-lg font-medium text-gray-800">
                Manage user #{{ $user->id }}
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Modify user details.
            </p>
        </header>

        <form method="POST" action="{{ route('users.update', ['user' => $user]) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-ui.input-text id="name" name="name" type="text" value="{{ $user->name }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-ui.input-text id="email" name="email" type="email" value="{{ $user->email }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="role" class="block mb-2 text-sm font-medium">Role</x-input-label>
                <x-ui.input-select :id="'role'" :name="'role'" :defaultSelectedTitle="'Select role'" :options="$role_options"
                    :selected="$user->role" />
                <x-input-error class="mt-2" :messages="$errors->get('role')" />
            </div>


            <x-ui.primary-button class="flex items-center gap-2 w-full justify-center sm:w-fit"><svg
                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h11.175q.4 0 .763.15t.637.425l2.85 2.85q.275.275.425.638t.15.762V19q0 .825-.587 1.413T19 21zM19 7.85L16.15 5H5v14h14zM12 18q1.25 0 2.125-.875T15 15t-.875-2.125T12 12t-2.125.875T9 15t.875 2.125T12 18m-5-8h7q.425 0 .713-.288T15 9V7q0-.425-.288-.712T14 6H7q-.425 0-.712.288T6 7v2q0 .425.288.713T7 10M5 7.85V19V5z" />
                </svg>Update User</x-ui.primary-button>
        </form>
    </section>
</x-app-layout>
