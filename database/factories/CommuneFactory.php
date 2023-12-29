<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Values\StatusValue;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commune>
 */
class CommuneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_reg' => fake()->numberBetween(1, 5),
            'description' => fake()->city(),
            'status' => fake()->randomElement([StatusValue::ACTIVE->value, StatusValue::INACTIVE->value, StatusValue::REMOVED->value]),
        ];
    }
}
