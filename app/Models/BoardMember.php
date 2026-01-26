<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
        'sort_order',
        'period',    // JSON
        'division',
        'is_founder',
        'linkedin_url',
    ];

    protected $casts = [
        'period' => 'array',
        'is_founder' => 'boolean',
    ];

    public const DIVISIONS = [
        'Para Perintis IYES INDONESIA' => 'Para Perintis (Founders)',
        'Pimpinan Eksekutif' => 'Pimpinan Eksekutif',
        'MEL' => 'MEL',
        'Sekretariat' => 'Sekretariat',
        'Media & Communication' => 'Media & Communication',
        'Program Development' => 'Program Development',
        'Partnership & Grants' => 'Partnership & Grants',
    ];

    public static function getAvailablePeriods(): array
    {
        $years = [];
        $currentYear = date('Y');

        for ($i = $currentYear - 1; $i <= $currentYear + 4; $i++) {
            // Format disesuaikan dengan request Anda: "2025/2026" (pakai garis miring)
            $val = $i . '/' . ($i + 1);
            $years[$val] = $val;
        }

        return $years;
    }
}