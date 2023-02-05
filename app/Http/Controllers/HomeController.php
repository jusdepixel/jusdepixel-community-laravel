<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'posts' => DB::table('social_network_posts')
                ->orderBy('created_at DESC')
                ->take(10)
                ->get()
        ]);
    }
}
