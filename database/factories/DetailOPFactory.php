<?php

namespace Database\Factories;

use App\Models\OP;
use App\Models\PP;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailOP>
 */
class DetailOPFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'op_id' => OP::inRandomOrder()->first()->id,
            'pp_id' => PP::inRandomOrder()->first()->id,
        ];
    }
}
