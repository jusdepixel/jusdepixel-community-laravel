<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Instagram\Controller as InstagramController;
use Illuminate\Http\RedirectResponse;

class AuthenticateController extends InstagramController
{
    public function process(): RedirectResponse
    {
        $code = $this->request->get('code');

        if ($code === null) {
            return redirect()
                ->route('home@process')
                ->with('message', 'Le code n\'a pas été fourni par instagram, ou est déjà utilisé, veuillez nous contacter.')
                ->with('alert-class', 'alert-danger')
                ->setStatusCode(422);
        }

        $authentication = $this->instagram->authenticate($code);

        if ($authentication === 400) {
            $this->instagram->logout();
            return redirect()
                ->route('home@process')
                ->with('message', 'Impossible de récupérer un token depuis Instagram, veuillez nous contacter.')
                ->with('alert-class', 'alert-error')
                ->setStatusCode(400);
        }

        return redirect()->route('me@process');
    }
}
