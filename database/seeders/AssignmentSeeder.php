<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Assignment::factory()->count(10)->create();
    }
}
