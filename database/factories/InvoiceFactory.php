<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Companies, Plan};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount'              => $this->faker->randomFloat(2, 10, 500),
            'currency'            => 'USD',
            'status'              => $this->faker->randomElement(['pending','paid','failed','cancelled']),
            'provider'            => $this->faker->optional()->company(),
            'provider_invoice_id' => $this->faker->optional()->uuid(),
            'paid_at'             => $this->faker->optional()->dateTime(),
            'company_id'          => Companies::factory(),
            'plan_id'             => Plan::factory(),
        ];
    }
}
