<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Mitra')->schema([
                    TextInput::make('name')
                        ->label('Nama Mitra')
                        ->required(),

                    Select::make('type')
                        ->label('Tipe Kerjasama')
                        ->options(Partner::TYPES)
                        ->default('sponsor')
                        ->required(),

                    TextInput::make('url')
                        ->label('Website / Link Medsos')
                        ->url()
                        ->prefix('https://'),

                    // Upload Logo (Optimasi ukuran)
                    FileUpload::make('logo')
                        ->label('Logo Mitra')
                        ->image()
                        ->directory('partners')
                        ->imageEditor()
                        ->maxSize(10240)
                        ->imageResizeMode('contain') // Agar logo tidak terpotong (contain)
                        ->imageCropAspectRatio(null) // Bebaskan rasio
                        ->imageResizeTargetWidth('300') // Resize lebar max 300px
                        ->required(),

                    Toggle::make('is_visible')
                        ->label('Tampilkan di Website?')
                        ->default(true),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tampilkan Logo
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->height(50) // Tinggi fix agar rapi
                    ->extraImgAttributes(['style' => 'object-fit: contain']), // CSS agar logo proporsional

                TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'sponsor' => 'warning',
                        'media_partner' => 'info',
                        'government' => 'danger',
                        default => 'gray',
                    }),

                ToggleColumn::make('is_visible')->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('type')->options(Partner::TYPES),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            // --- FITUR DRAG & DROP ---
            ->reorderable('sort_order') // Kolom database yang menyimpan urutan
            ->defaultSort('sort_order', 'asc'); // Tampilkan berdasarkan urutan ini
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
