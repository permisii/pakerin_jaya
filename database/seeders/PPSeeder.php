<?php

namespace Database\Seeders;

use App\Models\PP;
use Illuminate\Database\Seeder;

class PPSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        PP::factory()->count(20)->create();
    }
}
