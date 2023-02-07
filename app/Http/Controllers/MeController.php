<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Instagram\Controller as ControllerAlias;
use Illuminate\View\View;

class MeController extends ControllerAlias
{
    public function process(): View
    {
        return view('me', [
            'authorizeUrl' => $this->authorizeUrl,
            'profile' => $this->profile,
            'posts' => $this->instagram->getPosts()
        ]);
    }
}
