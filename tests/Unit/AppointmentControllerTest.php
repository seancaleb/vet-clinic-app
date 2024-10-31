<?php

use App\Models\Appointment;
use Carbon\Carbon;

beforeEach(function () {
    // Creates both a simulated user and admin then logs them in before each test case to grant access for all logic of 'appointment' routes.
    $this->user = createUser();
    $this->admin = createUser(true);
});

test('index method will return all appointments of users for admin roles', function () {
    $this->actingAs($this->admin);

    $total_appointment_count = 5;

    createAppointments($total_appointment_count);

    $response = $this->get('/appointments');
    $response->assertOk()
        ->assertViewIs('appointments.index')
        ->assertViewHas('appointments', function ($collection) use ($total_appointment_count) {
            return $collection->count() == $total_appointment_count;
        });
});

test('index method will return appointments of a logged-in user only for patient roles', function () {
    $this->actingAs($this->user);

    $total_appointment_count = 5;

    createAppointments($total_appointment_count, ['user_id' => $this->user->id]);

    $response = $this->get('/appointments');
    $response->assertOk()
        ->assertViewIs('appointments.index')
        ->assertViewHas('appointments', function ($collection) {
            return $collection->contains(function ($item) {
                return $item->user_id == $this->user->id;
            });
        });
});

test('store method will create a new appointment', function () {
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
});

test('edit method will show correct input values for users', function () {
    $this->actingAs($this->user);

    $appointment = createAppointment($this->user->id);

    $formatted_date = Carbon::parse($appointment->appointment_date)->format('m/d/Y');

    $response = $this->get("/appointments/{$appointment->id}/edit");
    $response->assertStatus(200)
        ->assertSee("value=\"{$appointment->description}\"", false)
        ->assertSee("value=\"{$appointment->pet_name}\"", false)
        ->assertSee("value=\"{$appointment->appointment_type}\"", false)
        ->assertDontSee("value=\"{$appointment->status}\"", false)
        ->assertSee("value=\"{$formatted_date}\"", false);
});

test('edit method will show correct input values for admin', function () {
    $this->actingAs($this->admin);

    $appointment = createAppointment($this->user->id);

    $formatted_date = Carbon::parse($appointment->appointment_date)->format('m/d/Y');

    $response = $this->get("/appointments/{$appointment->id}/edit");
    $response->assertStatus(200)
        ->assertSee("value=\"{$appointment->description}\"", false)
        ->assertSee("value=\"{$appointment->pet_name}\"", false)
        ->assertSee("value=\"{$appointment->appointment_type}\"", false)
        ->assertSee("value=\"{$appointment->status}\"", false)
        ->assertSee("value=\"{$formatted_date}\"", false);
});

test('update method will trigger validation errors and redirect back to the form', function () {
    $this->actingAs($this->user);

    $appointment = createAppointment($this->user->id);

    $response = $this->patch("/appointments/{$appointment->id}", [
        'description' => '',
        'pet_name' => '',
    ]);

    $response->assertStatus(302)
        ->assertInvalid(['description', 'pet_name']);
});

test('update method will successfully redirect back to the appointment view', function () {
    $this->actingAs($this->user);

    $appointment = createAppointment($this->user->id);
    $updated_appointment = [
        'description' => 'Lorem ipsum dolor sit amet consectetur.',
        'pet_name' => 'King',
        'appointment_type' => 'check-up',
        'appointment_date' => '11/11/2024'
    ];

    $formatted_date = Carbon::parse($updated_appointment['appointment_date'])->format('Y-m-d');

    $response = $this->patch("/appointments/{$appointment->id}", $updated_appointment);

    $response->assertRedirect("/appointments/{$appointment->id}")
        ->assertStatus(302);

    $this->assertDatabaseHas("appointments", [
        ...$updated_appointment,
        'appointment_date' => $formatted_date
    ]);
});

test('delete method will delete an appointment and successfully redirects back to the appointments view', function () {
    $this->actingAs($this->user);

    $appointment = createAppointment($this->user->id);

    $response = $this->delete("/appointments/{$appointment->id}");
    $response->assertRedirect('/appointments')
        ->assertStatus(302);

    $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
});

test('processPayment method will process the payment for an appointment', function () {
    $this->actingAs($this->user);

    $appointment = createAppointment($this->user->id);

    $payment_detail_values = [
        'user_id' => $this->user->id,
        'appointment_id' => $appointment->id,
        'amount' => 500,
        'phone_number' => '09695699966'
    ];

    $response = $this->post("/appointments/{$appointment->id}/processPayment", $payment_detail_values);
    $response->assertRedirect("/appointments/{$appointment->id}/payment-success")
        ->assertStatus(302);

    $response = $this->get("/appointments/{$appointment->id}/payment-success");

    $response->assertViewIs("appointments.payment-success")
        ->assertViewHas('appointment', function ($viewAppointment) use ($appointment) {
            return $viewAppointment->id === $appointment->id && $viewAppointment->payment_status === 'paid';
        });

    $this->assertDatabaseHas("appointments", [
        'id' => $appointment->id,
        'payment_status' => 'paid'
    ]);
});
