<?php

namespace Database\Seeders;

use App\Models\Instagram\InstagramPost;
use App\Models\Instagram\InstagramUser;
use Illuminate\Database\Seeder;

class InstagramSeeder extends Seeder
{
    public function run(): void
    {
        InstagramPost::factory()->create();
        InstagramUser::factory()->create();
    }
}
