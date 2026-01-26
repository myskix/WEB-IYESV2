<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    // Siapa yang bisa melihat list? (Semua user yang punya akses panel)
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Siapa yang bisa membuat?
    public function create(User $user): bool
    {
        return $user->hasRole(['super_admin', 'editor']);
    }

    // Siapa yang bisa update?
    public function update(User $user, Post $post): bool
    {
        // Editor hanya bisa update, tapi idealnya hanya post miliknya sendiri
        // Untuk case ini kita bebaskan editor edit semua post dulu
        return $user->hasRole(['super_admin', 'editor']);
    }

    // Siapa yang bisa hapus? HANYA SUPER ADMIN
    public function delete(User $user, Post $post): bool
    {
        return $user->hasRole('super_admin');
    }

    // Hapus Bulk (Banyak sekaligus)
    public function deleteAny(User $user): bool
    {
        return $user->hasRole('super_admin');
    }
}
