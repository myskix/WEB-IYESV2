<?php

namespace App\Filament\Resources\BoardMemberResource\Pages;

use App\Filament\Resources\BoardMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBoardMember extends CreateRecord
{
    protected static string $resource = BoardMemberResource::class;

    // Tambahkan fungsi ini untuk redirect ke halaman Index (Tabel)
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
