<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Companies, Category, Locations};


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenders>
 */
class TendersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Companies::factory(),
            'category_id' => Category::factory(),
            'location_id' => Locations::factory(),
            'status' => $this->faker->randomElement(['draft','pending','published','closed','cancelled']),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(4),
            'budget_amount' => $this->faker->randomFloat(2, 1000, 100000),
            'currency' => $this->faker->randomElement(['USD','UZS','KZT','KGS','TJS','TMT']),
            'bids_deadline' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'published_at' => now(),
            'closed_at' => null,
            'visibility' => $this->faker->randomElement(['public','invited']),
        ];
    }
}
