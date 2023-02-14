<?php

declare(strict_types=1);

namespace App\Instagram;

class User extends Initialize
{
    public function getProfile(): object
    {
        return $this->getSession();
    }

    public function setProfile($profile): void
    {
        $session = (array) $this->getProfile();
        $profile = (array) $profile;

        $this->setSession(array_merge($session, $profile));
    }
}
