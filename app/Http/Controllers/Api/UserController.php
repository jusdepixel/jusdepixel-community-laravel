<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramUser;
use Illuminate\Database\Eloquent\Collection;

class UserController extends InstagramController
{
    public function create(): void
    {
        if(! $this->iExist()) {
            InstagramUser::factory()->create([
                'ig_id' => $this->profile->igId,
                'timestamp' => $this->profile->timestamp,
                'username' => $this->profile->username,
                'media_count' => $this->profile->media_count,
                'token' => $this->profile->accessToken,
            ]);
        }
    }

    public function delete(): array
    {
        InstagramUser::query()->where('ig_id', $this->profile->igId)->delete();

        return ['message' => 'Votre compte a bien été supprimé.'];
    }

    public function getMe(): array|Collection
    {
        return InstagramUser::query()->where('ig_id', $this->profile->igId)->get();
    }

    private function iExist(): int
    {
        return InstagramUser::query()->where('ig_id', $this->profile->igId)->count();
    }
}
