@php
    use Carbon\Carbon;

    // Need to check if exists to avoid error in testing
    if (!function_exists('format_date')) {
        function format_date($date)
        {
            return Carbon::parse($date)->format('m/d/Y');
        }
    }

    if (!function_exists('get_total_appointments')) {
        function get_total_appointments($count)
        {
            if ($count === 0) {
                return 'N/A';
            } elseif ($count === 1) {
                return "{$count} appointment";
            } else {
                return "{$count} appointments";
            }
        }
    }

@endphp

<x-app-layout>
    <x-slot:header>{{ __('All Users') }}</x-slot:header>

    <section class="space-y-6">
        <div class="space-y-6">
            @if ($users->count() > 1)
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>No. of appointments</th>
                        <th>Created at</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($users as $user)
                        @if ($user->id === Auth::user()->id)
                            @continue;
                        @endif

                        <tr onclick="window.location='{{ route('users.show', ['user' => $user]) }}'">
                            <td class='text-gray-800 font-medium'>{{ $user->name }}</td>
                            <td class='whitespace-nowrap'>{{ $user->email }}</td>
                            <td class='whitespace-nowrap'>{{ ucfirst($user->role) }}</td>
                            <td class='whitespace-nowrap'>{{ get_total_appointments($user->appointments->count()) }}</td>
                            <td class='whitespace-nowrap'>{{ format_date($user->created_at) }}
                            </td>
                            <td>
                                @if (empty($user->email_verified_at))
                                    <x-ui.badge-status
                                        :status="'not-verified'">{{ strtoupper('Not Verified') }}</x-ui.badge-status>
                                @else
                                    <x-ui.badge-status
                                        :status="'verified'">{{ strtoupper('Verified') }}</x-ui.badge-status>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <section class="py-32 w-full text-gray-500">
                    <div class="grid gap-2 text-center w-full justify-items-center">
                        <h2 class="font-semibold text-xl text-gray-800 leading-none tracking-[-0.015em]">
                            No active users at the moment.
                        </h2>
                        <p class="max-w-[50ch]">There are currently no active patients yet.</p>
                    </div>
                </section>

            @endif
        </div>

        <div>{{ $users->onEachSide(0)->links() }}</div>
    </section>
</x-app-layout>
