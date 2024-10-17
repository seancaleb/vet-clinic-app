@php
    use Carbon\Carbon;

    $formatted_date_created = Carbon::parse($user->created_at)->format('F d, Y');
    $formatted_date_updated = Carbon::parse($user->updated_at)->format('F d, Y');
@endphp

<x-app-layout>
    <x-slot:header>
        User #{{ $user->id }}
    </x-slot:header>

    <section class='section mx-auto max-w-2xl relative'>
        <div class='space-y-6 text-gray-800'>
            <div class="space-y-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-none tracking-[-0.015em]">
                    {{ $user->name }}
                </h2>
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12v1.45q0 1.475-1.012 2.513T18.5 17q-.875 0-1.65-.375t-1.3-1.075q-.725.725-1.638 1.088T12 17q-2.075 0-3.537-1.463T7 12t1.463-3.537T12 7t3.538 1.463T17 12v1.45q0 .65.425 1.1T18.5 15t1.075-.45t.425-1.1V12q0-3.35-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20h4q.425 0 .713.288T17 21t-.288.713T16 22zm0-7q1.25 0 2.125-.875T15 12t-.875-2.125T12 9t-2.125.875T9 12t.875 2.125T12 15" />
                    </svg>
                    <div>{{ $user->email }}</div>
                </div>
            </div>

            <div class="grid gap-4 grid-cols-2">
                <div class="col-span-1 space-y-1">
                    <div class="text-sm text-gray-500">Role</div>
                    <div>{{ ucfirst($user->role) }}</div>
                </div>

                <div class="col-span-1 space-y-1">
                    <div class="text-sm text-gray-500">Status</div>
                    @if (empty($user->email_verified_at))
                        <x-ui.badge-status :status="'not-verified'">{{ strtoupper('Not Verified') }}</x-ui.badge-status>
                    @else
                        <x-ui.badge-status :status="'verified'">{{ strtoupper('Verified') }}</x-ui.badge-status>
                    @endif
                </div>
            </div>

            <div class="grid gap-4 grid-cols-2">
                <div class="col-span-1 space-y-1">
                    <div class="text-sm text-gray-500">No. of appointments</div>
                    <div>{{ $user->appointments->count() === 0 ? 'N/A' : $user->appointments->count() }}</div>
                </div>

                <div class="col-span-1 space-y-1">
                    <div class="text-sm text-gray-500">Date created</div>
                    <div>{{ $formatted_date_created }}</div>
                </div>
            </div>
        </div>



        <div class='mt-6'>
            <x-ui.link href="{{ route('users.edit', ['user' => $user]) }}"
                class="flex items-center gap-2 w-full sm:w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M14 21v-1.65q0-.2.075-.387t.225-.338l5.225-5.2q.225-.225.5-.325t.55-.1q.3 0 .575.113t.5.337l.925.925q.2.225.313.5t.112.55t-.1.563t-.325.512l-5.2 5.2q-.15.15-.337.225T16.65 22H15q-.425 0-.712-.287T14 21m7.5-5.575l-.925-.925zm-6 5.075h.95l3.025-3.05l-.925-.925l-3.05 3.025zM6 22q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h7.175q.4 0 .763.15t.637.425l4.85 4.85q.275.275.425.638t.15.762v1.425q0 .425-.288.713T19 11.25t-.712-.288T18 10.25V9h-4q-.425 0-.712-.288T13 8V4H6v16h5q.425 0 .713.288T12 21t-.288.713T11 22zm0-2V4zm13.025-3.025l-.475-.45l.925.925z" />
                </svg>Edit User
            </x-ui.link>
        </div>


    </section>
</x-app-layout>
