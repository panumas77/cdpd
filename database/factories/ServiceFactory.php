<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => $this->faker->numberBetween(2,350),
            'category_id' => $this->faker->numberBetween(1,23),
            'user_id' => $this->faker->numberBetween(1,13),
            'service_number' => 'REF-'.rand(10,500),
            'service_detail' => $this->faker->paragraph,
            'service_date' => $this->faker->dateTimeBetween('-2 years','now'),
        ];
    }
}
