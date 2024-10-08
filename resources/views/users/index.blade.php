@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot:header>{{ __('All Users') }}</x-slot:header>

    <section class="space-y-6">
        <div class="space-y-6">
            @if ($users->count() > 0)
                <table class="bg-white rounded-xl overflow-clip">
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
                            <td class='whitespace-nowrap text-gray-800 font-medium'>{{ $user->name }}</td>
                            <td class='whitespace-nowrap'>{{ $user->email }}</td>
                            <td class='whitespace-nowrap'>{{ ucfirst($user->role) }}</td>
                            <td class='whitespace-nowrap'>{{ $user->appointments->count() }}</td>
                            <td class='whitespace-nowrap'>{{ Carbon::parse($user->created_at)->format('Y-m-d') }}
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
                <div class='px-6 py-8 rounded-lg bg-indigo-50/50 text-center'>
                    <p>There are no active user/s listed at the moment.</p>
                </div>

            @endif
        </div>

        <div>{{ $users->onEachSide(0)->links() }}</div>
    </section>
</x-app-layout>
