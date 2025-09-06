<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Companies, Tenders};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rating'          => $this->faker->numberBetween(1, 5),
            'comment'         => $this->faker->optional()->sentence(),
            'from_company_id' => Companies::factory(),
            'to_company_id'   => Companies::factory(),
            'tender_id'       => $this->faker->optional()->randomElement([Tenders::factory()]),
        ];
    }
}
