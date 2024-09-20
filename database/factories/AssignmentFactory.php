<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\WorkInstruction;
use App\Support\Enums\AssignmentStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Assignment>
 */
class AssignmentFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'work_instruction_id' => WorkInstruction::inRandomOrder()->first()->id,
            'assignment_number' => $this->faker->word,
            'problem' => $this->faker->text,
            'resolution' => $this->faker->text,
            'material' => $this->faker->text,
            'description' => $this->faker->text,
            'status' => AssignmentStatusEnum::randomValue(),
            'percentage' => $this->faker->numberBetween(0, 100),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
