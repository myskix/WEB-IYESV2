<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'url',
        'type',
        'is_visible',
        'sort_order', // Wajib ada di fillable
    ];

    // Opsi Tipe Mitra
    public const TYPES = [
        'sponsor' => 'Sponsor',
        'media_partner' => 'Media Partner',
        'university' => 'Universitas / Sekolah',
        'government' => 'Pemerintah / Dinas',
        'community' => 'Komunitas',
    ];
}