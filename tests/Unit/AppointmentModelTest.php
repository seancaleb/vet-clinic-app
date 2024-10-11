<?php

$test_case_1 = 'an appointment belongs to a user';

test($test_case_1, function () {
    $user = createUser();
    $appointment = createAppointment($user->id);

    expect($appointment->user->id)->toEqual($user->id);
});
