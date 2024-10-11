<?php

/**
 * Routes
 *  1. /appointments                GET                 'index'
 *  2. /appointments/create         GET                 'create'
 *  3. /appointments                POST                'store'
 *  4. /appointments/{id}           GET                 'show'
 *  5. /appointments/{id}/edit      GET                 'edit'
 *  6. /appointments/{id}           PATCH               'update'
 *  7. /appointments/{id}           DELETE              'destroy
 */

beforeEach(function () {
    // Creates a simulated user and logs them in before each test case to grant access for all 'appointment' routes.
    $this->user = createUser();
    $this->actingAs($this->user);
});

$test_case_1 = 'index (GET) route returns a view';
$test_case_2 = 'create route (GET) returns a view';
$test_case_3 = 'store (POST) route creates an appointment and redirects user to index route';
$test_case_4 = 'show (GET) route returns a view with the current appointment data';
$test_case_5 = 'edit (GET) route returns a view with the current appointment data and the user that owns the appointment data';
$test_case_6 = 'update (PATCH) route updates an appointment and redirects user to the show route';
$test_case_7 = 'destroy (DELETE) route deletes an appointment and redirects user to the index route';

test($test_case_1, function () {
    $response = $this->get('/appointments');
    $response->assertOk()
        ->assertViewIs('appointments.index');
});

test($test_case_2, function () {
    $response = $this->get('/appointments/create');
    $response->assertOk()
        ->assertViewIs('appointments.create');
});

test($test_case_3, function () {

    $appointment_data = [
        'user_id' => $this->user->id,
        'pet_name' => fake()->name(),
        'description' => fake()->sentence(36),
        'appointment_date' => fake()->date(),
        'appointment_type' => fake()->randomElement(['vaccination', 'surgery', 'check-up']),
        'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
    ];

    $response = $this->post('/appointments', $appointment_data);
    $response->assertRedirect('/appointments');
});

test($test_case_4, function () {
    $appointment = createAppointment($this->user->id);

    $response = $this->get("/appointments/{$appointment->id}");
    $response->assertOk()
        ->assertViewIs("appointments.show")
        ->assertViewHas('appointment', function ($appointment) {
            return $appointment->user_id === $this->user->id;
        });
});

test($test_case_5, function () {
    $appointment = createAppointment($this->user->id);

    $response = $this->get("/appointments/{$appointment->id}/edit");
    $response->assertOk()
        ->assertViewIs("appointments.edit")
        ->assertViewHas('appointment', function ($appointment) {
            return $appointment->user_id === $this->user->id;
        })
        ->assertViewHas('user', function ($user) {
            return $user->id === $this->user->id;
        });
});

test($test_case_6, function () {
    $appointment = createAppointment($this->user->id);

    $updated_appointment_data = [
        'pet_name' => fake()->name(),
        'description' => fake()->sentence(36),
        'appointment_date' => fake()->date(),
        'appointment_type' => fake()->randomElement(['vaccination', 'surgery', 'check-up']),
        'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
    ];

    $response = $this->patch("/appointments/{$appointment->id}", $updated_appointment_data);
    $response->assertRedirect("/appointments/{$appointment->id}");

    $this->assertDatabaseHas('appointments', [
        'pet_name' => $updated_appointment_data['pet_name'],
        'description' => $updated_appointment_data['description'],
        'appointment_date' => $updated_appointment_data['appointment_date'],
        'appointment_type' => $updated_appointment_data['appointment_type'],
        'status' => $updated_appointment_data['status'],

    ]);
});

test($test_case_7, function () {
    $appointment = createAppointment($this->user->id);

    $response = $this->delete("/appointments/{$appointment->id}");
    $response->assertRedirect('/appointments')
        ->assertStatus(302);

    $this->assertDatabaseMissing('appointments', [
        'id' => $appointment->id,
    ]);
});
