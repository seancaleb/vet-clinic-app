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
 *  8. /appointments/{id}/payment   GET                 'payment
 */

beforeEach(function () {
    // Creates a simulated user and logs them in before each test case to grant access for all 'appointment' routes.
    $this->user = createUser();
    $this->actingAs($this->user);
});

test('index (GET) route returns a view', function () {
    $response = $this->get('/appointments');
    $response->assertOk()
        ->assertViewIs('appointments.index');
});

test('create route (GET) returns a view', function () {
    $response = $this->get('/appointments/create');
    $response->assertOk()
        ->assertViewIs('appointments.create');
});

test('store (POST) route creates an appointment and redirects user to index route', function () {

    $appointment_data = [
        'user_id' => $this->user->id,
        'pet_name' => fake()->name(),
        'description' => fake()->sentence(36),
        'appointment_date' => fake()->dateTimeBetween('tomorrow', '+1 year')->format('Y-m-d'),
        'appointment_type' => fake()->randomElement(['vaccination', 'surgery', 'check-up']),
        'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
    ];

    $response = $this->post('/appointments', $appointment_data);
    $response->assertRedirect('/appointments')
        ->assertStatus(302);
});

test('show (GET) route returns a view with the current appointment data', function () {
    $appointment = createAppointment($this->user->id);

    $response = $this->get("/appointments/{$appointment->id}");
    $response->assertOk()
        ->assertViewIs("appointments.show")
        ->assertViewHas('appointment', function ($appointment) {
            return $appointment->user_id === $this->user->id;
        });
});

test('edit (GET) route returns a view with the current appointment data and the user that owns the appointment data', function () {
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

test('update (PATCH) route updates an appointment and redirects user to the show route', function () {
    $appointment = createAppointment($this->user->id);

    $updated_appointment_data = [
        'pet_name' => fake()->name(),
        'description' => fake()->sentence(36),
        'appointment_date' => fake()->dateTimeBetween('tomorrow', '+1 year')->format('Y-m-d'),
        'appointment_type' => fake()->randomElement(['vaccination', 'surgery', 'check-up']),
        'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
    ];

    $response = $this->patch("/appointments/{$appointment->id}", $updated_appointment_data);
    $response->assertRedirect("/appointments/{$appointment->id}")
        ->assertStatus(302);
});

test('destroy (DELETE) route deletes an appointment and redirects user to the index route', function () {
    $appointment = createAppointment($this->user->id);

    $response = $this->delete("/appointments/{$appointment->id}");
    $response->assertRedirect('/appointments')
        ->assertStatus(302);
});

test('payment (GET) route returns a view with a payment processing form', function () {
    $appointment = createAppointment($this->user->id);

    $response = $this->get("/appointments/{$appointment->id}/payment");
    $response->assertOk()
        ->assertViewIs("appointments.payment")
        ->assertViewHas('appointment', function ($appointment) {
            return $appointment->user_id === $this->user->id;
        });
});
