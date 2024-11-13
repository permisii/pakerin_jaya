<?php

namespace Database\Seeders;

use App\Models\OP;
use Illuminate\Database\Seeder;

class OPSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        OP::factory()->count(5)->create();
    }
}
