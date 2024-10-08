<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User #{{ $user->id }}
        </h2>
    </x-slot>

    <section class='section max-w-xl mx-auto'>
        <div class='grid gap-1'>
            <div class='text-gray-900 text-lg font-medium'>{{ $user->name }}</div>
            <p>{{ $user->email }}</p>
            <div class='grid gap-1'>
                <div class="flex items-center gap-1">
                    <span>Type:</span>
                    <span>{{ $user->role }}</span>
                </div>

                <div class="flex items-center gap-1">
                    <span>Date:</span>
                    <span>{{ $user->created_at }}</span>
                </div>

                <div class="flex items-center gap-1">
                    <span>Total no. of appointments:</span>
                    <span>{{ $user->appointments->count() }}</span>
                </div>
            </div>
        </div>

        <hr class='my-6'>

        <div class='flex justify-end'>
            <x-link href="{{ route('users.edit', ['user' => $user]) }}">Edit User</x-link>
        </div>


    </section>
</x-app-layout>
