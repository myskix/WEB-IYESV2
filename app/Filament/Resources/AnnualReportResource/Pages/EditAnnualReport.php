<?php

namespace App\Filament\Resources\AnnualReportResource\Pages;

use App\Filament\Resources\AnnualReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnnualReport extends EditRecord
{
    protected static string $resource = AnnualReportResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
