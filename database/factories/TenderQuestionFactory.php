<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\{Tenders, Companies};


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TenderQuestion>
 */
class TenderQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question'          => $this->faker->sentence(),
            'answer'            => $this->faker->optional()->sentence(),
            'answered_at'       => now(),
            'tender_id'         => Tenders::factory(),
            'author_company_id' => Companies::factory(),
        ];
    }
}
