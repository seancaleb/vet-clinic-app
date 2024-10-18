<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => bcrypt('pass123.'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@test.com',
            'password' => bcrypt('pass123.'),
            'role' => 'patient',
        ]);

        Appointment::factory(50)->create();
    }
}
