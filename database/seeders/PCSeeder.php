<?php

namespace Database\Seeders;

use App\Models\PC;
use Illuminate\Database\Seeder;

class PCSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        PC::factory()->count(10)->create();
    }
}
