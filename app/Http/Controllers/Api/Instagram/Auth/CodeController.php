<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Instagram\Auth;

use App\Instagram\Controller;

final class CodeController extends Controller
{
    public function __invoke($code): array
    {
        return [
            'code' => self::$instagram::code($code)
        ];
    }
}
