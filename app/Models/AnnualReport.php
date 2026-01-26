<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualReport extends Model
{
    protected $fillable = [
        'title',
        'year',
        'file_path', // Lokasi file PDF
        'cover_image', // Cover depan laporan 
    ];

    // Helper untuk mengurutkan dari tahun terbaru
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('year', 'desc');
        });
    }
}