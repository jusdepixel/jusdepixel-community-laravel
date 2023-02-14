<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class UserController extends InstagramController
{
    public function create(): bool|ModelNotFoundException
    {
        if(! $this->iExist()) {
            try {
                InstagramUser::factory()->create([
                    'ig_id' => $this->profile->igId,
                    'username' => $this->profile->username,
                    'media_count' => $this->profile->media_count,
                ]);

            } catch (ModelNotFoundException $e) {
                return $e;
            }
        }

        return true;
    }

    public function delete(): JsonResponse
    {
        try {
            InstagramUser::where('ig_id', $this->profile->igId)->delete();

            return response()->json([
                'message' => 'Votre compte a bien été supprimé.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function getMe(): JsonResponse
    {
        try {
            $me = InstagramUser::where('ig_id', $this->profile->igId)->get();
            return response()->json($me, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    private function iExist()
    {
        return InstagramUser::where('ig_id', $this->profile->igId)->count();
    }
}
