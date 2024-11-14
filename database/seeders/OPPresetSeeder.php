<?php

namespace Database\Seeders;

use App\Models\OPPreset;
use Illuminate\Database\Seeder;

class OPPresetSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        OPPreset::factory()->count(10)->create();
    }
}
