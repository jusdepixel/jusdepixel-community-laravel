<?php

declare(strict_types=1);

namespace App\Http\Interface;

interface SocialNetworkInterface
{
    public function getName(): string;
    public function getUsername(): string;
}
