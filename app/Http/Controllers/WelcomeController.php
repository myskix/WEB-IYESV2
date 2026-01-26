<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Program;
use App\Models\Partner;
use App\Models\Testimonial;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function __invoke(): View
    {
        // 1. Ambil 5 Program Utama (Urutkan sesuai sort_order)
        $programs = Program::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->take(5)
            ->get();

        // 2. Ambil 3 Berita Terbaru (Eager load kategori & user agar query ringan)
        $latestPosts = Post::with(['category', 'author'])
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        // 3. Ambil Mitra (Bonus: untuk ditampilkan di footer/section khusus)
        $partners = Partner::where('is_visible', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        // 4. Ambil Testimoni (Acak/Random 3 biji agar fresh)
        $testimonials = Testimonial::where('is_active', true)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('welcome', compact('programs', 'latestPosts', 'partners', 'testimonials'));
    }
}