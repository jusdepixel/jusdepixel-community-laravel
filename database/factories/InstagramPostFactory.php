<?php

namespace Database\Factories;

use App\Models\InstagramPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InstagramPost>
 */
class InstagramPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'social_network' => fake()->company,
            'social_id' => fake()->uuid,
            'media_id' => fake()->uuid,
            'type' => "IMAGE",
            'url' => fake()->url,
            'username' => fake()->userName,
            'timestamp' => fake()->dateTime,
        ];
    }
}
