<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardMemberResource\Pages;
use App\Models\BoardMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class BoardMemberResource extends Resource
{
    protected static ?string $model = BoardMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-users'; // Icon user lebih cocok
    protected static ?string $navigationLabel = 'Struktur Pengurus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pengurus')->schema([

                    // 1. DIVISI
                    Select::make('division')
                        ->label('Divisi / Departemen')
                        ->options(BoardMember::DIVISIONS)
                        ->required()
                        ->native(false),

                    // 2. NAMA & JABATAN
                    TextInput::make('name')->required()->label('Nama Lengkap'),
                    TextInput::make('position')->required()->label('Jabatan'),

                    TextInput::make('linkedin_url')
                        ->label('Link Profil LinkedIn')
                        ->url()
                        ->placeholder('https://linkedin.com/in/username'),

                    // 3. PERIODE (PERBAIKAN: Digabung jadi satu, ambil dari Model)
                    Select::make('period')
                        ->label('Periode Aktif')
                        ->multiple() // Wajib multiple
                        ->options(BoardMember::getAvailablePeriods()) // Ambil fungsi dinamis dari Model
                        ->required()
                        ->searchable(),

                    // 4. TOGGLE FOUNDER
                    Toggle::make('is_founder')
                        ->label('Set sebagai Founder?')
                        ->helperText('Jika aktif, member ini akan muncul di SEMUA periode.')
                        ->inline(false),

                    // 5. URUTAN & FOTO
                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(10)
                        ->label('Urutan Tampil')
                        ->helperText('Angka 1 akan muncul paling atas.'),

                    FileUpload::make('photo')
                        ->label('Foto Profil')
                        ->directory('board-members')
                        ->avatar()
                        ->imageEditor(),

                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // 1. GROUPING
            ->groups([
                Tables\Grouping\Group::make('division')
                    ->label('Divisi')
                    ->collapsible(),
            ])
            ->defaultGroup('division')

            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable(),

                ImageColumn::make('photo')->circular()->label('Foto'),

                TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                // Kolom Divisi (Bisa di-hide karena sudah ada Group Header)
                TextColumn::make('division')
                    ->badge()
                    ->color('gray')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),

                TextColumn::make('period')
                    ->label('Periode')
                    ->badge()
                    ->color('info')
                    ->separator(','),
            ])
            ->filters([
                SelectFilter::make('period')
                    ->label('Filter Periode')
                    ->options(BoardMember::getAvailablePeriods())
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['value'])) {
                            return $query->whereJsonContains('period', $data['value']);
                        }
                        return $query;
                    }),

                // Filter Divisi
                SelectFilter::make('division')
                    ->options(BoardMember::DIVISIONS),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('sort_order', 'asc'); // Sort default berdasarkan urutan
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
            'index' => Pages\ListBoardMembers::route('/'),
            'create' => Pages\CreateBoardMember::route('/create'),
            'edit' => Pages\EditBoardMember::route('/{record}/edit'),
        ];
    }
}