<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\SocialNetwork\Instagram;
use Illuminate\Http\RedirectResponse;

class Logout
{
    public function process(Instagram $instagram): RedirectResponse
    {
        $instagram->logout();
        return redirect()->route('home@index');
    }
}
