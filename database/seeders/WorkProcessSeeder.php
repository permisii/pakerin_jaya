<?php

namespace Database\Seeders;

use App\Models\WorkProcess;
use Illuminate\Database\Seeder;

class WorkProcessSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        WorkProcess::factory()->count(10)->create();
    }
}
