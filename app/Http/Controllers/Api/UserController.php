<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramUser;
use Illuminate\Http\JsonResponse;

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

    public function delete(): JsonResponse
    {
        InstagramUser::query()->where('ig_id', $this->profile->igId)->delete();

        return response()->json([
            'message' => 'Votre compte a bien été supprimé.'
        ], 200);
    }

    public function getMe(): JsonResponse
    {
        $me = InstagramUser::query()->where('ig_id', $this->profile->igId)->get();
        return response()->json($me, 200);
    }

    private function iExist(): int
    {
        return InstagramUser::query()->where('ig_id', $this->profile->igId)->count();
    }
}
