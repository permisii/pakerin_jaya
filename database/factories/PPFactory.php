<?php

namespace Database\Factories;

use App\Models\User;
use App\Support\Enums\PPStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PP>
 */
class PPFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'item_name' => $this->faker->word,
            //            'remaining' => $this->faker->randomNumber(2),
            //            'need' => $this->faker->randomNumber(2),
            //            'buy' => $this->faker->randomNumber(2),
            'unit' => $this->faker->word,
            'need_date' => $this->faker->date(),
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(PPStatusEnum::toArray()),
            'created_by' => User::inRandomOrder()->first()->id,
            'updated_by' => User::inRandomOrder()->first()->id,
        ];
    }
}
