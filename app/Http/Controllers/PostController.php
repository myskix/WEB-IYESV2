<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Query Dasar (Hanya yang Published & Eager Loading)
        $query = Post::with(['category', 'author', 'tags'])
            ->where('status', 'published') // Pastikan ada kolom status di DB
            ->latest('published_at');

        // 1. Filter Pencarian (Judul)
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 2. Filter Kategori
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 3. Filter Tag (Bisa Single atau Multi via array)
        if ($request->has('tag')) {
            $tags = (array) $request->tag; // Pastikan jadi array
            $query->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('slug', $tags);
            });
        }


        $posts = $query->paginate(9)->appends(request()->query());


        // Data untuk Sidebar Filter
        $categories = Category::withCount('posts')->get(); // Menghitung jumlah post per kategori
        $tags = Tag::all();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'author', 'tags'])
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        // Artikel Terkait (Berdasarkan Kategori yang sama, kecuali artikel ini)
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        if ($post->external_link) {
            return redirect()->away($post->external_link);
        }

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}