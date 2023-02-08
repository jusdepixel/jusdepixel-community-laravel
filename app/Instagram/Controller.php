<?php

declare(strict_types=1);

namespace App\Instagram;

use Illuminate\Http\Request;

class Controller
{
    protected object $profile;
    protected string $authorizeUrl;

    public function __construct(protected Instagram $instagram, protected Request $request)
    {
        $this->instagram->initialize();
        $this->profile = $this->instagram->getProfile();
        $this->authorizeUrl = $this->instagram->requestAuthorizeUrl();
    }
}
