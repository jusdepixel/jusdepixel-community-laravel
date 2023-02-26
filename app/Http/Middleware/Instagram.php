<?php

namespace App\Http\Middleware;

use App\Actions\UserCreateAction;
use App\Exceptions\InstagramException;
use App\Instagram\Auth;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class Instagram
{
    public function handle($request, Closure $next): Response|JsonResponse
    {
        $auth = new Auth();

        if ($auth::getProfile()->isAuthenticated === false) {
            return (new InstagramException())->render(
                new Exception('MIDDLEWARE_INSTAGRAM', 403)
            );
        } else {
            try {
                (new UserCreateAction($auth))->setUser();
            } catch (\Exception $e) {
                return (new InstagramException())->render($e);
            }
        }

        return $next($request);
    }
}
