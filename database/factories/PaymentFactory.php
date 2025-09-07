<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Invoice};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount'              => $this->faker->randomFloat(2, 10, 1000),
            'currency'            => $this->faker->currencyCode,
            'provider'            => $this->faker->randomElement(['Stripe', 'PayPal']),
            'provider_payment_id' => 'pay_' . $this->faker->unique()->numberBetween(100000, 999999),
            'status'              => $this->faker->randomElement(['succeeded', 'failed', 'refunded']),
            'invoice_id'          => Invoice::factory(),
        ];
    }
}
