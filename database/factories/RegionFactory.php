<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Values\StatusValue;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->state(),
            'status' => fake()->randomElement([StatusValue::ACTIVE, StatusValue::INACTIVE, StatusValue::REMOVED]),
        ];
    }
}
