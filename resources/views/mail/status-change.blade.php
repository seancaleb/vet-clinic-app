@php
    use Carbon\Carbon;

    $date = Carbon::parse($appointment->appointment_date);
    $formatted_date = $date->format('F j, Y');

    // Format to replace dashes with space then capitalize first letter
    $appointment_type = str_replace('-', ' ', $appointment->appointment_type);
    $appointment_type = Str::ucfirst($appointment_type);

    // Format to capitalize the first letter
    $appointment_status = Str::ucfirst($appointment->status);
@endphp


<x-layouts.mail>
    {{-- Props for views/components/layouts/mail.blade.php  --}}
    <x-slot:mail_subject>{{ $mail_subject }}</x-slot:mail_subject>
    <x-slot:heading>Appointment status has been updated</x-slot:heading>

    <p>Hi {{ $user->name }} 👋🏻</p>

    @if ($appointment->status !== 'cancelled')
        {{-- This message will be sent if the appointment status is CONFIRMED or PENDING.  --}}
        <p>We would like to inform you that the status of your appointment for <b>{{ $appointment->pet_name }}</b> on
            <b>{{ $formatted_date }}</b> has
            been updated to <b>"{{ $appointment->status }}"</b>.
        </p>

        {{-- Display appointment details  --}}
        <p><b>Updated Appointment Details:</b></p>

        <ul>
            <li>Date: <b>{{ $formatted_date }}</b></li>
            <li>Type: <b>{{ $appointment_type }}</b></li>
            <li>Status: <b>{{ $appointment_status }}</b></li>
            <li>Description: {{ $appointment->description }}</li>
        </ul>

        <p>If you have any questions or require further assistance, please don't hesitate to reach us out via this
            email.
        </p>

        <p>We look forward to seeing you and your pet soon! ☺️</p>
    @else
        {{-- This message will be sent if the appointment status is CANCELLED.  --}}
        <p>We would like to inform you that your appointment for <b>{{ $appointment->pet_name }}</b> on
            <b>{{ $formatted_date }}</b>
            has been <b>"{{ $appointment->status }}"</b>.
        </p>

        <p>If you have any questions or would like to reschedule, please don't hesitate to reach us out via this
            email.
        </p>

        <p>We apologize for any inconvenience this may cause. 😔</p>
    @endif

    <p>Thank you,</p>
    <p>The VetHub Team</p>
</x-layouts.mail>
