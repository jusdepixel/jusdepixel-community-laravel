<?php

declare(strict_types=1);

namespace App\Instagram;

use App\Http\Controllers\Controller as HttpController;
use Illuminate\Http\Request;

class Controller extends HttpController
{
    protected object $profile;
    protected string $authorizeUrl;
    protected Instagram $instagram;

    public function __construct(protected Request $request)
    {
        $this->instagram = new Instagram($this->request);
        $this->instagram->initialize();
        $this->profile = $this->instagram->getProfile();
        $this->authorizeUrl = $this->instagram->getAuthorizeUrl();
    }
}
