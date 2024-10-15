<?php

/**
 * Routes
 *  1. /users                       GET                 'index'
 *  2. /users/{id}                  GET                 'show'
 *  3. /users/{id}/edit             GET                 'edit'
 *  4. /users/{id}                  PATCH               'update'
 */

beforeEach(function () {
    // Creates a simulated user and logs them in before each test case to grant access for all 'appointment' routes.
    $this->user = createUser('admin');
    $this->actingAs($this->user);
});

test('index (GET) route returns users view', function () {
    $response = $this->get('/users');
    $response->assertOk()
        ->assertViewIs('users.index');
});

test('show (GET) route returns a view with the current user data', function () {
    $user = createUser();

    $response = $this->get("/users/{$user->id}");
    $response->assertOk()
        ->assertViewIs("users.show")
        ->assertViewHas('user', function ($user_data) use ($user) {
            return $user_data->id === $user->id;
        });
});

test('edit (GET) route returns a view with the current user data', function () {
    $user = createUser();

    $response = $this->get("/users/{$user->id}/edit");
    $response->assertOk()
        ->assertViewIs("users.edit")
        ->assertViewHas('user', function ($user_data) use ($user) {
            return $user_data->id === $user->id;
        });
});

test('update (PATCH) route updates a user and redirects back to the show route', function () {
    $user = createUser();

    $updated_user_data = [
        'name' => fake()->name(),
        'email' => $user->email,
        'role' => $user->role
    ];

    $response = $this->patch("/users/{$user->id}", $updated_user_data);
    $response->assertRedirect("/users/{$user->id}")
        ->assertStatus(302);
});
