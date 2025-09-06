<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Companies, Plan};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubScription>
 */
class SubScriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', 'now');
        $end   = (clone $start)->modify('+1 month');

        return [
            'starts_at'      => $start,
            'ends_at'        => $end,
            'remaining_bids' => $this->faker->numberBetween(0, 100),
            'status'         => $this->faker->randomElement(['active','expired','cancelled']),
            'company_id'     => Companies::factory(),
            'plan_id'        => Plan::factory(),
        ];
    }
}
