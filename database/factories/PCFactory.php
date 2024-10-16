<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PC>
 */
class PCFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
            'date_of_initial_use' => $this->faker->date(),
            'index' => $this->faker->word,
            'section' => $this->faker->word,
            'monitor' => $this->faker->word,
            'vga' => $this->faker->word,
            'processor' => $this->faker->word,
            'ram' => $this->faker->word,
            'hdd' => $this->faker->word,
            'keyboard' => $this->faker->word,
            'mouse' => $this->faker->word,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
