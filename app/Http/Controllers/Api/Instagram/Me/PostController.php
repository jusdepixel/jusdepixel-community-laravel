<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Me;

use App\Exceptions\InstagramException;
use App\Http\Resources\Instagram\Me\MePostResource;
use App\Instagram\Controller;
use Illuminate\Http\Response;

final class PostController extends Controller
{
    /**
     * @todo Cache One Post
     * @param int $id
     * @return MePostResource|Response
     */
    public function __invoke(int $id): MePostResource|Response
    {
        try {
            return self::$instagram::getPost($id);
        } catch (\Exception $e) {
            return (new InstagramException())->render($e);
        }
    }
}
