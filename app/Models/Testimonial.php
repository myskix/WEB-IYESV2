<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'category',
        'role_or_company',
        'content',
        'photo',
        'is_active',
    ];

    public const CATEGORIES = [
        'Alumni IYES' => 'Alumni IYES',
        'Volunteer' => 'Volunteer',
        'Pengurus' => 'Pengurus / Board',
        'Masyarakat' => 'Masyarakat Umum',
    ];
}
