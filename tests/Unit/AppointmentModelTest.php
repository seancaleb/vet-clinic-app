<?php

test('an appointment belongs to a user', function () {
    $user = createUser();
    $appointment = createAppointment($user->id);

    expect($appointment->user->id)->toEqual($user->id);
});
