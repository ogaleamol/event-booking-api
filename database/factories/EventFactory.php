<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'start_time' => now()->addDays(1),
            'end_time' => now()->addDays(2),
            'country_id' => 1,
            'capacity' => $this->faker->numberBetween(10, 100),
        ];
    }
}
