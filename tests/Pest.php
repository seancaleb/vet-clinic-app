<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use App\Models\Appointment;
use App\Models\User;

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createUser($is_admin = false) {
    return User::factory()->create([
        'role' => $is_admin ? 'admin' : 'patient'
    ]);
}

function createAppointment($user_id, $appointment_create_params = []) {
    if (!$appointment_create_params) {
        return Appointment::factory()->create([
            'user_id' => $user_id
        ]);
    }

    return Appointment::factory()->create([
        ...$appointment_create_params,
        'user_id' => $user_id
    ]);
}

function createAppointments($count, $appointment_create_params = []) {
    if (!$appointment_create_params) {
        return Appointment::factory($count)->create();
    }

    return Appointment::factory($count)->create($appointment_create_params);
}

function createUsers($count) {
    return User::factory($count)->create();
}
