<?php

namespace App\Filament\Resources\AnnualReportResource\Pages;

use App\Filament\Resources\AnnualReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnnualReports extends ListRecords
{
    protected static string $resource = AnnualReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
