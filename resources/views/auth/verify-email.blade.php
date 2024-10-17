<x-guest-layout>
    <x-slot:header>Verify Email</x-slot:header>
    <x-slot:header_text>Thanks for signing up! Before getting started, could you verify your email address by clicking
        on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</x-slot:header_text>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-6 sm:flex-row sm:items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-ui.primary-button class="w-full sm:w-fit">
                    Resend Verification Email
                </x-ui.primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-500 hover:text-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                {{ __('Log out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
