<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Companies};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'target_type'        => $this->faker->randomElement(['tender','bid','company','message']),
            'target_id'          => $this->faker->randomNumber(),
            'reason'             => $this->faker->sentence(),
            'status'             => $this->faker->randomElement(['open','review','resolved','rejected']),
            'reporter_company_id'=> $this->faker->optional()->randomElement([Companies::factory()]),
        ];
    }
}
