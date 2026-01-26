<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Post;
use App\Models\Partner;
use App\Models\Category;

class PageController extends Controller
{
    public function about()
    {
        // Data SEO bisa disiapkan di sini jika ingin dinamis
        return view('pages.about');
    }

    public function testimonials(Request $request)
    {
        // 1. Ambil List Kategori untuk Tombol Filter
        $categories = Testimonial::CATEGORIES;

        // 2. Ambil Kategori yang sedang dipilih user (dari URL ?category=...)
        $currentCategory = $request->query('category');

        // 3. Query Data
        $testimonials = Testimonial::query()
            ->where('is_active', true) // Hanya tampilkan yang aktif
            ->when($currentCategory, function ($query) use ($currentCategory) {
                // Jika ada filter kategori, pasang where
                return $query->where('category', $currentCategory);
            })
            ->latest() // Urutkan dari yang terbaru
            ->paginate(9); // Batasi 9 per halaman agar rapi

        return view('pages.testimonials', compact('testimonials', 'categories', 'currentCategory'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function partnership()
    {
        // 1. Ambil 3 Berita Terakhir dari Kategori 'kolaborasi'
        // Pastikan Anda sudah membuat kategori dengan slug 'kolaborasi' di CMS
        $stories = Post::whereHas('category', function ($q) {
            $q->where('slug', 'kolaborasi');
        })->latest()->take(3)->get();

        // 2. Ambil Semua Logo Mitra dari Tabel Partners
        // Urutkan berdasarkan ID atau created_at (jika belum ada sort_order)
        $partners = Partner::query()->latest()->get();

        return view('pages.partnership', compact('stories', 'partners'));
    }
}
