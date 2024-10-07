<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::factory()->create([
            'name' => 'Sean Caleb Ubias',
            'email' => 'scmubias@gmail.com',
            'password' => bcrypt('immortalsean'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Larrie Boy Montojo',
            'email' => 'anyma.seancaleb@gmail.com',
            'password' => bcrypt('immortalsean'),
            'role' => 'patient',
        ]);

        User::factory()->create([
            'name' => 'Alexander John Magtulis',
            'email' => 'xanderjohn@gmail.com',
            'password' => bcrypt('immortalsean'),
            'role' => 'patient',
        ]);

        User::factory()->create([
            'name' => 'Justin Edralin',
            'email' => 'justinedralin@gmail.com',
            'password' => bcrypt('immortalsean'),
            'role' => 'patient',
        ]);

        User::factory()->create([
            'name' => 'Ashley Magracia',
            'email' => 'ashleymagracia@gmail.com',
            'password' => bcrypt('immortalsean'),
            'role' => 'patient',
        ]);

        Appointment::factory()->create([
            'pet_name' => 'Ash',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate, in soluta ut tenetur, reprehenderit labore incidunt, ipsam repellat placeat iure numquam. Totam ex odit facere vero molestiae, laborum animi omnis veniam sapiente repellat qui eum? Doloremque.',
            'appointment_date' => now(),
            'appointment_type' => 'check-up',
            'status' => 'pending'
        ]);
    }
}
