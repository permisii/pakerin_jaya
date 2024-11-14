<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Unit>
 */
class UnitFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name' => $this->faker->name,
            'unit_code' => $this->faker->unique()->word,
            'head_of_unit_id' => User::factory(),
            'updated_by' => null,
            'created_by' => null,
        ];
    }
}
