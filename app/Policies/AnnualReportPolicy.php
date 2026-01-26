<?php

namespace App\Policies;

use App\Models\AnnualReport;
use App\Models\User;

class AnnualReportPolicy
{
    // Semua user login (Admin & Editor) boleh melihat list
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Admin & Editor boleh upload laporan
    public function create(User $user): bool
    {
        return $user->hasRole(['super_admin', 'editor']);
    }

    // Admin & Editor boleh edit (misal: ganti judul/revisi file)
    public function update(User $user, AnnualReport $annualReport): bool
    {
        return $user->hasRole(['super_admin', 'editor']);
    }

    // HANYA SUPER ADMIN yang boleh menghapus laporan
    public function delete(User $user, AnnualReport $annualReport): bool
    {
        return $user->hasRole('super_admin');
    }
}