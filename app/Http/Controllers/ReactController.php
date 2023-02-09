<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Instagram\Controller as InstagramController;
use Illuminate\View\View;

class ReactController extends InstagramController
{
    public function process(): View
    {
        return view('react/index', [
            'authorizeUrl' => $this->authorizeUrl,
            'profile' => $this->profile
        ]);
    }
}
