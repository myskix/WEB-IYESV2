<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnualReportResource\Pages;
use App\Filament\Resources\AnnualReportResource\RelationManagers;
use App\Models\AnnualReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class AnnualReportResource extends Resource
{
    protected static ?string $model = AnnualReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('title')
                        ->label('Judul Laporan')
                        ->placeholder('Misal: Laporan Pertanggungjawaban 2024')
                        ->required(),

                    // Dropdown Tahun (Otomatis 10 tahun terakhir)
                    Select::make('year')
                        ->label('Tahun Laporan')
                        ->options(function () {
                            return array_combine(
                                range(date('Y'), date('Y') - 10),
                                range(date('Y'), date('Y') - 10)
                            );
                        })
                        ->default(date('Y'))
                        ->required(),

                    // Upload Cover (Opsional tapi disarankan untuk UI)
                    FileUpload::make('cover_image')
                        ->label('Cover Depan (Gambar)')
                        ->image()
                        ->imageEditor()
                        ->directory('annual-reports/covers')
                        ->maxSize(10240), // Max 10MB

                    // Upload PDF (Inti Fitur)
                    FileUpload::make('file_path')
                        ->label('File Laporan (PDF)')
                        ->directory('annual-reports/files')
                        ->acceptedFileTypes(['application/pdf']) // Validasi Wajib PDF
                        ->maxSize(10240) // Max 10MB (Sesuaikan kebutuhan)
                        ->downloadable() // Agar admin bisa download ulang untuk cek
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->height(80), // Tampilkan agak besar vertikal

                TextColumn::make('title')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn(AnnualReport $record) => "Tahun: " . $record->year),

                TextColumn::make('year')
                    ->sortable()
                    ->hidden(), // Disembunyikan karena sudah ada di description
            ])
            ->filters([
                // Filter berdasarkan tahun
                Tables\Filters\SelectFilter::make('year')
                    ->options(function () {
                        return array_combine(
                            range(date('Y'), date('Y') - 10),
                            range(date('Y'), date('Y') - 10)
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                // Custom Action: Download PDF
                Action::make('download')
                    ->label('Unduh PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(AnnualReport $record) => asset('storage/' . $record->file_path))
                    ->openUrlInNewTab(),

                Tables\Actions\DeleteAction::make(), // Policy akan otomatis menyembunyikan ini dari Editor
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnnualReports::route('/'),
            'create' => Pages\CreateAnnualReport::route('/create'),
            'edit' => Pages\EditAnnualReport::route('/{record}/edit'),
        ];
    }
}
