<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        // Ambil program yang aktif saja
        $programs = Program::where('is_active', true)
            ->latest()
            ->get();

        return view('programs.index', compact('programs'));
    }

    public function show($slug)
    {
        $program = Program::with([
            'editions' => function ($query) {
                $query->orderBy('year', 'desc');
            }
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('programs.show', compact('program'));
    }

    // Method Baru: Menampilkan Edisi Spesifik
    public function showEdition($slug, $year)
    {
        // 1. Ambil Program Utamanya dulu (untuk Header & Sidebar)
        $program = Program::with([
            'editions' => function ($query) {
                $query->orderBy('year', 'desc');
            }
        ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // 2. Cari Edisi spesifik berdasarkan Tahun
        // Karena relasinya HasMany, kita cari di collection editions milik program ini
        $edition = $program->editions->where('year', $year)->first();

        // Jika tahun tidak ditemukan, 404
        if (!$edition) {
            abort(404, 'Edisi tahun ' . $year . ' tidak ditemukan untuk program ini.');
        }

        return view('programs.edition', compact('program', 'edition'));
    }
}