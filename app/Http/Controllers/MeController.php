<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Instagram\Controller as InstagramController;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MeController extends InstagramController
{
    public function process(): RedirectResponse|View
    {
        $posts =  $this->instagram->getPosts();

        if ($posts === 400) {
            $this->instagram->logout();
            return redirect()
                ->route('home@process')
                ->with('message', 'Votre session Instagram a expiré, veuillez vous reconnecter.')
                ->with('alert-class', 'alert-info')
                ->setStatusCode(403);
        }

        return view('pages/me', [
            'authorizeUrl' => $this->authorizeUrl,
            'profile' => $this->profile,
            'posts' => $posts
        ]);
    }
}
