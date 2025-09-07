<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'      => $this->faker->unique()->slug(2),
            'title'     => ['en' => $this->faker->words(3, true)],
            'price'     => $this->faker->randomFloat(2, 10, 500),
            'currency'  => 'USD',
            'bid_limit' => $this->faker->numberBetween(10, 500),
            'features'  => ['feature1' => true, 'feature2' => false],
            'active'    => $this->faker->boolean(90),
        ];
    }
}
