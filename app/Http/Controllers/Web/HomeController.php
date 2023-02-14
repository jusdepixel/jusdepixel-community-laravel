<?php

namespace App\Http\Controllers\Web;

use App\Instagram\Controller as InstagramController;
use App\Models\InstagramPost;
use Illuminate\View\View;

class HomeController extends InstagramController
{
    public function process(): View
    {
        return view('pages/home', [
            'authorizeUrl' => $this->authorizeUrl,
            'profile' => $this->profile,
            'posts' => InstagramPost::orderBy('created_at DESC')
                ->take(12)
                ->get()
        ]);
    }
}
