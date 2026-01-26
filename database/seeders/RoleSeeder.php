<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Buat Role
        $roleAdmin = Role::create(['name' => 'super_admin']);
        $roleEditor = Role::create(['name' => 'editor']);

        // 3. Assign Super Admin ke User Pertama (User yang Anda buat di Tahap 4)
        $user = User::first(); // Mengambil user pertama di database
        if ($user) {
            $user->assignRole($roleAdmin);
        }
    }
}