<?php

namespace App\Filament\Resources\AnnualReportResource\Pages;

use App\Filament\Resources\AnnualReportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnualReport extends CreateRecord
{
    protected static string $resource = AnnualReportResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
