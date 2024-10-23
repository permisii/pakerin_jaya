<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Printer>
 */
class PrinterFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
//            'user_id' => 1,
            'user_name' => $this->faker->name,
            'brand' => $this->faker->word,
            'date_of_initial_use' => $this->faker->date(),
            'index' => $this->faker->word,
            'type' => $this->faker->word,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
