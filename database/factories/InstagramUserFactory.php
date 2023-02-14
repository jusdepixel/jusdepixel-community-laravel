<?php

namespace Database\Factories;

use App\Models\InstagramUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InstagramUser>
 */
class InstagramUserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ig_id' => fake()->numerify,
            'username' => fake()->userName,
            'media_count' => fake()->numerify,
        ];
    }
}
