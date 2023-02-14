<?php

declare(strict_types=1);

namespace App\Instagram;

class User extends Authenticate
{
    public function getProfile(): object
    {
        return $this->getSession();
    }
}
