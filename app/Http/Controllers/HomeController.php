<?php

namespace App\Http\Controllers;

use App\SocialNetwork\Instagram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController
{
    public function index(Request $request, Instagram $instagram): RedirectResponse|View
    {
        $instagram->initialize();

        if ($request->get('code')) {
            $instagram->authenticate($request->get('code'));
            return redirect()->route('home@index');
        }

        return view('home', [
            'authorizeUrl' => $instagram->getAuthorizeUrl(),
            'isAuthenticated' => $instagram->isAuthenticated(),
            'socialId' => $instagram->getSocialId(),
            'posts' => DB::table('social_network_posts')
                ->orderBy('created_at DESC')
                ->take(10)
                ->get()
        ]);
    }
}
