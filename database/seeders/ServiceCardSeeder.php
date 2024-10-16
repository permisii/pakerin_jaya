<?php

namespace Database\Seeders;

use App\Models\ServiceCard;
use Illuminate\Database\Seeder;

class ServiceCardSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        ServiceCard::factory()->count(10)->create();
    }
}
