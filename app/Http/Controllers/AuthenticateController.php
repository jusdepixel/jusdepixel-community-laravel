<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Instagram\Controller as InstagramController;
use Illuminate\Http\RedirectResponse;

class AuthenticateController extends InstagramController
{
    public function process($code): RedirectResponse
    {
        $this->instagram->authenticate($code);

        return redirect()->route('me@process');
    }
}
