<?php

namespace Database\Seeders;

use App\Models\WorkInstruction;
use Illuminate\Database\Seeder;

class WorkInstructionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        WorkInstruction::factory()->count(30)->create();
    }
}
