<?php

use Carbon\Carbon;

test('a user can create an appointment', function () {
    $this->user = createUser();

    $this->actingAs($this->user);

    $target_appointment_date = Carbon::now()->addDay()->format('m/d/Y');

    $new_appointment = [
        'user_id' => $this->user->id,
        'pet_name' => 'Ash',
        'description' => 'This is a new appointment',
        'appointment_date' => $target_appointment_date,
        'appointment_type' => 'check-up',
    ];

    $response = $this->post('/appointments', $new_appointment);

    $response->assertRedirect('/appointments');

    $this->assertDatabaseHas('appointments', [
        'user_id' => $new_appointment['user_id'],
        'pet_name' => $new_appointment['pet_name'],
        'description' => $new_appointment['description'],
        'appointment_date' => Carbon::parse($new_appointment['appointment_date'])->format('Y-m-d'),
        'appointment_type' => $new_appointment['appointment_type'],
        'status' => 'pending',
    ]);
});

test('a user can manage a single appointment (view, edit and delete)', function () {
    $this->user = createUser();

    $this->actingAs($this->user);

    $target_appointment_date = Carbon::now()->addDay()->format('m/d/Y');

    $new_appointment = [
        'user_id' => $this->user->id,
        'pet_name' => 'Ash',
        'description' => 'This is a new appointment',
        'appointment_date' => $target_appointment_date,
        'appointment_type' => 'check-up',
        'status' => 'pending',
    ];

    $appointment = createAppointment($this->user->id, $new_appointment);

    $this->get("/appointments/{$appointment->id}")
        ->assertStatus(200)
        ->assertSee('Ash')
        ->assertSee('PENDING')
        ->assertSee('Edit Appointment');

    $this->patch("/appointments/{$appointment->id}", [
        'status' => 'cancelled'
    ]);

    $this->assertDatabaseHas('appointments', [
        'status' => 'cancelled'
    ]);

    $this->get("/appointments/{$appointment->id}")
        ->assertStatus(200)
        ->assertSee('CANCELLED')
        ->assertDontSee('PENDING')
        ->assertDontSee('Edit Appointment');

    $this->delete("/appointments/{$appointment->id}")
        ->assertRedirect('/appointments')
        ->assertStatus(302);

    $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
});
