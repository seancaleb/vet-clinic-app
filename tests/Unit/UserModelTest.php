<?php

beforeEach(function () {
    // Creates both a simulated user and admin then logs them in before each test case to grant access for all logic of 'appointment' routes.
    $this->user = createUser();
    $this->admin = createUser(true);
});

test('a user can have many appointments', function () {
    $appointment = createAppointment($this->user->id);
    $appointment_2 = createAppointment($this->user->id);

    expect($appointment->user->id)->toEqual($this->user->id);
    expect($appointment_2->user->id)->toEqual($this->user->id);
});
