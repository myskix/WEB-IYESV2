<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        // Data SEO bisa disiapkan di sini jika ingin dinamis
        return view('about.about');
    }
}
