<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Filament\Resources\ProgramResource\RelationManagers;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Repeater;


class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Baris 1: Nama & Slug
                Forms\Components\Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Nama Program')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),

                    TextInput::make('slug')
                        ->required()
                        ->readOnly() // Biar otomatis saja, user tidak perlu pusing
                        ->unique(ignoreRecord: true),
                ]),

                // Baris 2: Deskripsi Singkat
                Textarea::make('brief_description')
                    ->label('Deskripsi Singkat (Untuk Tampilan Depan)')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

                // Baris 3: Gambar
                FileUpload::make('thumbnail')
                    ->label('Gambar Cover')
                    ->image()
                    ->directory('programs')
                    ->required()
                    ->imageEditor()
                    ->maxSize(10240)
                    ->columnSpanFull(),

                // Baris 4: Deskripsi Lengkap
                RichEditor::make('description')
                    ->label('Deskripsi Lengkap')
                    ->columnSpanFull(),

                Repeater::make('focus_areas')
                    ->label('Fokus Program (Pilar Utama)')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Fokus (Contoh: Pendidikan)')
                            ->required(),
                        TextInput::make('icon')
                            ->label('Icon FontAwesome (Contoh: fas fa-book)')
                            ->helperText('Cari icon di fontawesome.com, copy class-nya.')
                            ->required(),
                    ])
                    ->grid(3) // Tampilan grid di form admin
                    ->columnSpanFull(),

                // Baris 5: Status (Toggle saja)
                Toggle::make('is_active')
                    ->label('Tampilkan Program ini?')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Menampilkan Thumbnail (Kotak)
                ImageColumn::make('thumbnail')
                    ->label('Cover')
                    ->square(),

                // 2. Nama Program
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                // 3. Status (Bisa di-klik langsung untuk on/off)
                ToggleColumn::make('is_active')
                    ->label('Aktif?'),

                // 4. Sort Order
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
                // Daftarkan Relation Manager di sini
            RelationManagers\EditionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
