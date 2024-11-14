<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OPPreset>
 */
class OPPresetFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name' => $this->faker->name,
            'department' => $this->faker->name,
            'code' => $this->faker->name,
            'no' => $this->faker->name,
            'date' => $this->faker->date(),
            'first_requestor' => $this->faker->name,
            'second_requestor' => $this->faker->name,
            'approved_by' => $this->faker->name,
            'head_of_section_id' => User::inRandomOrder()->first()->id,
            'created_by' => User::inRandomOrder()->first()->id,
            'updated_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
