<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $pet_names = ['Bella', 'Charlie', 'Max', 'Luna', 'Oliver', 'Lucy', 'Cooper', 'Daisy', 'Rocky', 'Molly'];

        return [
            // 'user_id' => 2,
            'user_id' => User::factory(),
            'pet_name' => fake()->randomElement($pet_names),
            'description' => fake()->sentence(36),
            'appointment_date' => fake()->dateTimeBetween('today', '+3 months'),
            'appointment_type' => fake()->randomElement(['vaccination', 'surgery', 'check-up']),
            'status' => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            'payment_status' => 'unpaid',
        ];
    }
}
