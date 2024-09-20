<?php

namespace Database\Factories;

use App\Models\User;
use App\Support\Enums\WorkInstructionStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkInstruction>
 */
class WorkInstructionFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'work_date' => $this->faker->date(),
            'status' => WorkInstructionStatusEnum::randomValue(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
