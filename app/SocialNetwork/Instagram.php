<?php

declare(strict_types=1);

namespace App\SocialNetwork;

use App\Http\Interface\SocialNetworkInterface;

class Instagram implements SocialNetworkInterface
{
    public function getName(): string
    {
        return "Instagram";
    }

    public function getUsername(): string
    {
        return "fakeUserName";
    }
}
