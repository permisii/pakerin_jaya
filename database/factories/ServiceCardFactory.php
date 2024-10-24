<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\PC;
use App\Models\Printer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceCard>
 */
class ServiceCardFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $device = $this->faker->randomElement([PC::class, Printer::class]);
        $deviceInstance = $device::inRandomOrder()->first();

        return [
            'date' => $this->faker->date(),
            'description' => $this->faker->text,
            'device_type' => $device,
            'device_id' => $deviceInstance->id,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
