<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    private bool $isProduction = false;

    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::create([
            'nip' => '1',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $this->call([
            UnitSeeder::class,
            MenuSeeder::class,
            AccessMenuSeeder::class,
        ]);

        if ($this->isProduction) {
            return;
        }

        $this->call([
            UserSeeder::class,
            WorkInstructionSeeder::class,
            AssignmentSeeder::class,
            PCSeeder::class,
            PrinterSeeder::class,
            ServiceCardSeeder::class,
            WorkProcessSeeder::class,
        ]);
    }
}
