<?php

namespace Database\Factories;

use App\Models\DetailOP;
use App\Models\OP;
use App\Models\PP;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OP>
 */
class OPFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'department' => $this->faker->word,
            'code' => $this->faker->word,
            'no' => $this->faker->word,
            'date' => $this->faker->date(),
            'first_requestor' => $this->faker->name,
            'second_requestor' => $this->faker->name,
            'approved_by' => $this->faker->name,
            'head_of_section_id' => User::inRandomOrder()->first()->id,
            'created_by' => User::inRandomOrder()->first()->id,
            'updated_by' => User::inRandomOrder()->first()->id,
        ];
    }

    public function configure(): Factory|OPFactory {
        return $this->afterCreating(function (OP $op) {
            $pps = PP::inRandomOrder()->take(rand(1, 5))->get();
            foreach ($pps as $pp) {
                DetailOP::create([
                    'op_id' => $op->id,
                    'pp_id' => $pp->id,
                ]);
            }
        });
    }
}
