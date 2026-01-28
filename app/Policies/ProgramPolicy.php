<?php

namespace App\Policies;

use App\Models\Program;
use App\Models\User;

class ProgramPolicy
{
    // Semua user login bisa melihat daftar
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Semua user login bisa melihat detail
    public function view(User $user, Program $program): bool
    {
        return true;
    }

    // Editor & Super Admin boleh membuat
    public function create(User $user): bool
    {
        return $user->hasRole(['super_admin', 'editor']);
    }

    // Editor & Super Admin boleh update
    public function update(User $user, Program $program): bool
    {
        return $user->hasRole(['super_admin', 'editor']);
    }

    // HANYA SUPER ADMIN yang boleh menghapus
    public function delete(User $user, Program $program): bool
    {
        return $user->hasRole('super_admin');
    }

    // HANYA SUPER ADMIN yang boleh menghapus permanen
    public function forceDelete(User $user, Program $program): bool
    {
        return $user->hasRole('super_admin');
    }
}