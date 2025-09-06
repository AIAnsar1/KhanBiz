<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{User, Companies};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'thread_type'    => $this->faker->randomElement(['tender','bid','direct']),
            'thread_id'      => $this->faker->randomNumber(),
            'body'           => $this->faker->paragraph(),
            'from_company_id'=> Companies::factory(),
            'from_user_id'   => User::factory(),
        ];
    }
}
