<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Init;

use App\Instagram\Controller;

final class AuthorizeUrlController extends Controller
{
    public function __invoke(): array
    {
        return [
            'authorizeUrl' => self::$instagram::authorizeUrl()
        ];
    }
}
