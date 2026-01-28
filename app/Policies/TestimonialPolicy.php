<?php

namespace App\Policies;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestimonialPolicy
{
    // Semua user login bisa melihat daftar
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Semua user login bisa melihat detail
    public function view(User $user, Testimonial $testimonial): bool
    {
        return true;
    }

    // Editor & Super Admin boleh membuat
    public function create(User $user): bool
    {
        return $user->hasRole(['super_admin', 'editor']);
    }

    // Editor & Super Admin boleh update
    public function update(User $user, Testimonial $testimonial): bool
    {
        return $user->hasRole(['super_admin', 'editor']);
    }

    // HANYA SUPER ADMIN yang boleh menghapus
    public function delete(User $user, Testimonial $testimonial): bool
    {
        return $user->hasRole('super_admin');
    }

    // HANYA SUPER ADMIN yang boleh menghapus permanen
    public function forceDelete(User $user, Testimonial $testimonial): bool
    {
        return $user->hasRole('super_admin');
    }
}