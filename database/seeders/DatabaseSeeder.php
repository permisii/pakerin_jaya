<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            UnitSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            AccessMenuSeeder::class,
            WorkInstructionSeeder::class,
            AssignmentSeeder::class,
            PCSeeder::class,
            PrinterSeeder::class,
//            WorkProcessSeeder::class,
            ServiceCardSeeder::class,
        ]);
    }
}
