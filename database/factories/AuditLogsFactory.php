<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{User, Companies};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuditLogs>
 */
class AuditLogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'action'           => $this->faker->randomElement(['create','update','delete','login']),
            'subject_type'     => $this->faker->randomElement(['tender','bid','company','message']),
            'subject_id'       => $this->faker->randomNumber(),
            'meta'             => ['ip' => $this->faker->ipv4()],
            'actor_user_id'    => User::factory(),
            'actor_company_id' => Companies::factory(),
        ];
    }
}
