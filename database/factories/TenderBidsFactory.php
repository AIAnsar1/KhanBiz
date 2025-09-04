<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Tenders, Companies};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TenderBids>
 */
class TenderBidsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tender_id' => Tenders::factory(),
            'supplier_company_id' => Companies::factory(),
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'currency' => $this->faker->randomElement(['USD', 'EUR', 'UZS']),
            'message' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['submitted', 'shortlisted', 'rejected', 'winner', 'withdrawn']),
        ];
    }
}
