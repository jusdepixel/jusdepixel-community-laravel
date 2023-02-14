<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use Illuminate\View\View;

class ReactController
{
    public function process(): View
    {
        return view('react/index');
    }
}
