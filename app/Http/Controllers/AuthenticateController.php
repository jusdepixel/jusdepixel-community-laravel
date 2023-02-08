<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Instagram\Controller as InstagramController;
use Illuminate\Http\RedirectResponse;

class AuthenticateController extends InstagramController
{
    public function process(): RedirectResponse
    {
        $authentication = $this->instagram->authenticate($this->request->get('code'));

        if ($authentication === 400) {
            $this->instagram->logout();
            return redirect()
                ->route('home@process')
                ->with('message', 'Impossible de récupérer un token depuis Instagram, veuillez nous contacter.')
                ->with('alert-class', 'alert-error');
        }

        return redirect()->route('me@process');
    }
}
