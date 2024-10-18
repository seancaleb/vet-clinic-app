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
        if (env('SEEDER_TYPE') === 'demo') {
            $this->call(DemoDataSeeder::class);
        } else {
            $this->call(StarterDataSeeder::class);
        }
    }
}
