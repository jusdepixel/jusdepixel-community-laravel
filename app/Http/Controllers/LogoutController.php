<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Instagram\Controller as InstagramController;
use Illuminate\Http\RedirectResponse;

class LogoutController extends InstagramController
{
    public function process(): RedirectResponse
    {
        $this->instagram->logout();

        return redirect()->route('home@process');
    }
}
