<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = ['name', 'slug', 'brief_description', 'description', 'thumbnail', 'icon', 'is_active', 'sort_order', 'focus_areas'];

    protected $casts = [
        'is_active' => 'boolean',
        'focus_areas' => 'array',
    ];

    public function editions(): HasMany
    {
        return $this->hasMany(ProgramEdition::class)->orderBy('year', 'desc');
    }
}
