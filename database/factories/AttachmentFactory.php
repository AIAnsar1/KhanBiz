<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_type' => $this->faker->randomElement(['tender','bid','company','message']),
            'owner_id'   => $this->faker->randomNumber(),
            'disk'       => 's3',
            'path'       => $this->faker->filePath(),
            'mime'       => $this->faker->mimeType(),
            'size'       => $this->faker->numberBetween(1000, 5000000),
        ];
    }
}
