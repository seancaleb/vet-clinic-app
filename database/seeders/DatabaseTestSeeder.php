<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseTestSeeder extends Seeder {
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
    }
}
