<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramEdition extends Model
{
    protected $fillable = [
        'program_id',
        'name',
        'location',
        'year',
        'start_date',
        'end_date',
        'status',
        'registration_link',
        'testimonials',
        'description',
        'achievements',
        'gallery',
        'thumbnail',

    ];

    protected $casts = [
        'testimonials' => 'array', // Casting JSON ke Array otomatis
        'start_date' => 'date',
        'end_date' => 'date',
        'achievements' => 'array',
        'gallery' => 'array',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
