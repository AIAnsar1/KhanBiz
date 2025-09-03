<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Companies>
 */
class CompaniesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'legal_name'   => $this->faker->company . ' LLC',
            'brand_name'   => $this->faker->companySuffix,
            'tin'          => $this->faker->numerify('##########'), // ИНН
            'country_code' => $this->faker->randomElement(['UZ', 'KZ', 'KG', 'TJ', 'TM']),
            'city'         => $this->faker->city,
            'address'      => $this->faker->address,
            'website'      => $this->faker->url,
            'verified_at'  => $this->faker->optional()->dateTimeBetween('-1 years', 'now'),
            'about'        => [
                'ru' => $this->faker->sentence(8),
                'uz' => $this->faker->sentence(8),
                'en' => $this->faker->sentence(8),
            ],
        ];
    }
}
