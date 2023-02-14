<?php

namespace App\Http\Controllers\Api;

use App\Instagram\Controller as InstagramController;
use Illuminate\Http\JsonResponse;

class InitializeController extends InstagramController
{
    public function profile(): JsonResponse
    {
        return response()->json($this->profile);
    }
    public function url(): JsonResponse
    {
        return response()->json($this->authorizeUrl);
    }
}
