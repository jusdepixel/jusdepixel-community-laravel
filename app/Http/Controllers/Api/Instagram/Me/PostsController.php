<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Me;

use App\Exceptions\InstagramException;
use App\Http\Resources\Instagram\Me\MePostCollection;
use App\Instagram\Controller;
use Illuminate\Http\Response;

final class PostsController extends Controller
{
    public function __invoke(): MePostCollection|Response
    {
        try {
            return self::$instagram::getPosts();
        } catch (\Exception $e) {
            return (new InstagramException())->render($e);
        }
    }
}
