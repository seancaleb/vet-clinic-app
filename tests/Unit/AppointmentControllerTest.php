<?php

use App\Models\Appointment;

beforeEach(function () {
    // Creates both a simulated user and admin then logs them in before each test case to grant access for all logic of 'appointment' routes.
    $this->user = createUser();
    $this->admin = createUser('admin');
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
        'appointment_date' => fake()->date(),
        'appointment_type' => 'check-up',
        'status' => 'pending',
    ];

    $response = $this->post('/appointments', $appointment_data);

    $this->assertDatabaseHas('appointments', $appointment_data);

    $last_appointment = Appointment::latest()->first();
    $this->assertEquals($appointment_data['pet_name'], $last_appointment->pet_name);
    $this->assertEquals($appointment_data['description'], $last_appointment->description);
});

/**
 * TODO: Implement the test cases for the following:
 *  1. edit method
 *  2. update method
 *  3. destroy method
 */
