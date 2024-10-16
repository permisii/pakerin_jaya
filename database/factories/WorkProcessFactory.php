<?php

namespace Database\Factories;

use App\Models\ServiceCard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkProcess>
 */
class WorkProcessFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'service_card_id' => ServiceCard::factory()->create(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
