<?php

namespace Database\Factories;

use App\Models\InstagramPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InstagramPost>
 */
class InstagramPostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ig_id' => fake()->numerify,
            'media_id' => fake()->uuid,
            'media_type' => "IMAGE",
            'media_url' => fake()->url,
            'username' => fake()->userName,
            'timestamp' => fake()->dateTime,
        ];
    }
}
