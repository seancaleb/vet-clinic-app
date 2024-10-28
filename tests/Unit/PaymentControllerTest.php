<?php

use App\Models\Appointment;
use Carbon\Carbon;

beforeEach(function () {
    // Creates both a simulated user and admin then logs them in before each test case to grant access for all logic of 'appointment' routes.
    $this->user = createUser();
    $this->admin = createUser(true);
});

test('process payment method will update the payment status of an appointment', function () {
    $this->actingAs($this->user);

    $appointment_data = [
        'user_id' => $this->user->id,
        'pet_name' => fake()->name(),
        'description' => fake()->sentence(36),
        'appointment_date' => fake()->dateTimeBetween('tomorrow', '+1 year')->format('Y-m-d'),
        'appointment_type' => 'check-up',
        'status' => 'pending',
        'payment_status' => 'unpaid'
    ];

    $this->post('/appointments', $appointment_data);

    $this->assertDatabaseHas('appointments', $appointment_data);

    $latestAppointmentId = Appointment::latest()->first()->id;

    $response = $this->json('POST', '/api/payment', [
        'amount' => 50,
        'appointmentId' => $latestAppointmentId
    ]);

    $this->assertDatabaseHas('appointments', [...$appointment_data, 'payment_status' => 'paid']);

    $response->assertStatus(200);
});

test('process payment method will trigger validation error if appointment id is not found in the database', function () {
    $this->actingAs($this->user);

    $appointment_data = [
        'user_id' => $this->user->id,
        'pet_name' => fake()->name(),
        'description' => fake()->sentence(36),
        'appointment_date' => fake()->dateTimeBetween('tomorrow', '+1 year')->format('Y-m-d'),
        'appointment_type' => 'check-up',
        'status' => 'pending',
        'payment_status' => 'unpaid'
    ];

    $this->post('/appointments', $appointment_data);

    $this->assertDatabaseHas('appointments', $appointment_data);

    $latestAppointmentId = Appointment::latest()->first()->id;

    $response = $this->json('POST', '/api/payment', [
        'amount' => 50,
        'appointmentId' => $latestAppointmentId + 1
    ]);

    $response->assertStatus(422);
});

test('process payment method will trigger error and return a status code of 400 if either appointmentId or amount is not present in the JSON body', function () {
    $this->actingAs($this->user);

    $appointment_data = [
        'user_id' => $this->user->id,
        'pet_name' => fake()->name(),
        'description' => fake()->sentence(36),
        'appointment_date' => fake()->dateTimeBetween('tomorrow', '+1 year')->format('Y-m-d'),
        'appointment_type' => 'check-up',
        'status' => 'pending',
        'payment_status' => 'unpaid'
    ];

    $this->post('/appointments', $appointment_data);

    $this->assertDatabaseHas('appointments', $appointment_data);

    $response = $this->json('POST', '/api/payment', [
        'amount' => 50,
    ]);

    $response->assertStatus(400);
});
