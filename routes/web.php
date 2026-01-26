<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BoardMemberController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AnnualReportController;

Route::get('/', WelcomeController::class)->name('home');



// Programs
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('programs.show');
Route::get('/programs/{slug}/{year}', [ProgramController::class, 'showEdition'])->name('programs.edition');

// About
Route::get('/tentang-kami/struktur', [BoardMemberController::class, 'index'])->name('board-members.index');
Route::get('/tentang-kami', [AboutController::class, 'about'])->name('about.index');

// Berita
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

// Annual Report
Route::get('/annual-report', [AnnualReportController::class, 'index'])->name('annual-report.index');
Route::get('/annual-report/download/{id}', [AnnualReportController::class, 'download'])->name('annual-report.download');