<?php


beforeEach(function () {
    // Creates both a simulated user and admin then logs them in before each test case to grant access for all logic of 'appointment' routes.
    $this->user = createUser('admin');
    $this->actingAs($this->user);
});

test('index method will return all users', function () {
    $total_user_count = 5;

    createUsers($total_user_count);

    $response = $this->get('/users');
    $response->assertOk()
        ->assertViewIs('users.index')
        ->assertViewHas('users', function ($users_collection) use ($total_user_count) {
            // Appended $total_user_count by 1 to include the current admin logged in
            return $users_collection->count() == $total_user_count + 1;
        });
});

test('edit method will show correct input values ', function () {
    $user = createUser();

    $response = $this->get("/users/{$user->id}/edit");
    $response->assertStatus(200)
        ->assertSee("value=\"{$user->name}\"", false)
        ->assertSee("value=\"{$user->email}\"", false)
        ->assertSee("value=\"{$user->role}\"", false);
});

test('update method will trigger validation errors and redirect back to the form', function () {
    $user = createUser();

    $response = $this->patch("/users/{$user->id}", [
        'name' => '',
        'email' => '',
    ]);

    $response->assertStatus(302)
        ->assertInvalid(['name', 'email']);
});

test('update method will successfully redirect back to the user view', function () {
    $user = createUser();

    $updated_user_data = [
        'name' => fake()->name(),
        'email' => $user->email,
        'role' => $user->role
    ];

    $response = $this->patch("/users/{$user->id}", $updated_user_data);

    $response->assertRedirect("/users/{$user->id}")
        ->assertStatus(302);

    $this->assertDatabaseHas("users", $updated_user_data);
});
