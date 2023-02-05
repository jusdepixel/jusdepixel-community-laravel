<?php

declare(strict_types=1);

namespace App\Http\Interface;

interface SocialNetworkInterface
{
    public function initialize(): void;
    public function isAuthenticated(): bool;
    public function getSocialId(): ?int;
}
