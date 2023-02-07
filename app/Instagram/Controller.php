<?php

declare(strict_types=1);

namespace App\Instagram;

class Controller
{
    protected object $profile;
    protected string $authorizeUrl;

    public function __construct(protected Instagram $instagram)
    {
        $this->instagram->initialize();
        $this->profile = $this->instagram->getProfile();
        $this->authorizeUrl = $this->instagram->getAuthorizeUrl();
    }
}
