<?php

declare(strict_types=1);

namespace App\SocialNetwork;

use Illuminate\Http\Request;

class SocialNetwork
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->setRequest($request);

        if ($this->getSession() === null) {
            $this->setSession([
                'isAuthenticated' => false,
                'socialId' => null,
                'token' => null
            ]);
        }
    }

    private function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    protected function setSession(array $session): void
    {
        $this->request->session()->put('social_network', json_encode($session));
    }

    protected function getSession(): ?object
    {
        if ($this->request->session()->get('social_network')) {
            return json_decode($this->request->session()->get('social_network'));
        }

        return null;
    }

    public function logout(): void
    {
        $this->request->session()->forget('social_network');
    }
}
