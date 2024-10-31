@php
    use Carbon\Carbon;

    $date = Carbon::parse($appointment->appointment_date);
    $formatted_date = $date->format('F j, Y');

    // Format to replace dashes with space then capitalize first letter
    $appointment_type = str_replace('-', ' ', $appointment->appointment_type);
    $appointment_type = Str::ucfirst($appointment_type);
    $payment_status = Str::ucfirst($appointment->payment_status);

    // Format to capitalize the first letter
    $appointment_status = Str::ucfirst($appointment->status);
@endphp


<x-layouts.mail>
    {{-- Props for views/components/layouts/mail.blade.php  --}}
    <x-slot:mail_subject>{{ $mail_subject }}</x-slot:mail_subject>
    <x-slot:heading>Payment Successful</x-slot:heading>

    <p>Hi {{ $user->name }} 👋🏻</p>

    <p>You payment for your appointment has been successful.</p>

    {{-- Display appointment details  --}}
    <p><b>Appointment Details:</b></p>

    <ul>
        <li>Date: <b>{{ $formatted_date }}</b></li>
        <li>Type: <b>{{ $appointment_type }}</b></li>
        <li>Status: <b>{{ $appointment_status }}</b></li>
        <li>Payment Status: <b>{{ $payment_status }}</b></li>
        <li>Description: {{ $appointment->description }}</li>
    </ul>

    <p>We look forward to seeing you and your pet soon! ☺️</p>

    <p>Best regards,</p>
    <p>The VetHub Team</p>
</x-layouts.mail>
