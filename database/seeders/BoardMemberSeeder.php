<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BoardMember;

class BoardMemberSeeder extends Seeder
{
    public function run(): void
    {
        // Masukkan data Founder 1
        BoardMember::create([
            'name' => 'Nama Founder 1',
            'division' => 'Founder',
            'position' => '-',
            'is_active' => true,
            'sort_order' => 1,
            // 'photo' => 'board-members/foto-founder-1.jpg', 
        ]);

        // Masukkan data Founder 2
        BoardMember::create([
            'name' => 'Nama Founder 2',
            'division' => 'Founder',
            'position' => '-',
            'is_active' => true,
            'sort_order' => 2,
        ]);
    }
}
