<?php

namespace App\Http\Controllers;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends InstagramController
{
    public function process(): RedirectResponse|View
    {
        return view('home', [
            'authorizeUrl' => $this->authorizeUrl,
            'profile' => $this->profile,
            'posts' => InstagramPost::where('ig_id', 1)
                ->orderBy('created_at DESC')
                ->take(10)
                ->get()
        ]);
    }
}
