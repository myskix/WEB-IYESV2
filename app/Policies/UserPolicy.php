<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    // 1. View Any (Siapa yang boleh lihat menu User?)
    public function viewAny(User $user): bool
    {
        // Hanya Super Admin yang boleh masuk menu Manajemen User
        return $user->hasRole('super_admin');
    }

    // 2. Delete (Siapa yang boleh menghapus?)
    public function delete(User $user, User $model): bool
    {
        // Aturan A: Editor DILARANG KERAS menghapus user
        if ($user->hasRole('editor')) {
            return false;
        }

        // Aturan B: Super Admin tidak boleh menghapus dirinya sendiri (Bunuh diri akun)
        if ($user->id === $model->id) {
            return false;
        }

        // Aturan C: Super Admin boleh menghapus user lain
        return $user->hasRole('super_admin');
    }

    // Izinkan method lain (Update/View) untuk Super Admin
    public function view(User $user, User $model): bool
    {
        return $user->hasRole('super_admin');
    }
    public function create(User $user): bool
    {
        return $user->hasRole('super_admin');
    }
    public function update(User $user, User $model): bool
    {
        return $user->hasRole('super_admin');
    }
}
