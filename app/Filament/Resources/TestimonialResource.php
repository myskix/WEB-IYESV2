<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Testimoni')->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('role_or_company')->label('Status (Ex: CEO of X / Peserta YVC)'),
                    Select::make('category')
                        ->label('Kategori Testimoni')
                        ->options(Testimonial::CATEGORIES)
                        ->default('Masyarakat')
                        ->required(),
                    TextInput::make('role_or_company')
                        ->label('Label Jabatan')
                        ->placeholder('Contoh: Volunteer IYM 10 / Peserta YVC 2025'),
                    FileUpload::make('photo')
                        ->image()
                        ->avatar()
                        ->directory('testimonials')
                        ->imageEditor()
                        ->maxSize(10240),

                    // Rich Text Editor (Sesuai Instruksi)
                    RichEditor::make('content')
                        ->label('Isi Testimoni')
                        ->toolbarButtons(['bold', 'italic', 'underline']) // Toolbar minimalis saja
                        ->required()
                        ->columnSpanFull(),

                    Toggle::make('is_active')->default(true),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->circular(),
                TextColumn::make('name')
                    ->searchable()
                    ->description(fn($record) => $record->role_or_company),

                // Menampilkan Bintang di Tabel

                TextColumn::make('category')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Alumni IYES' => 'info',
                        'Volunteer' => 'warning',
                        'Pengurus' => 'primary',
                        'Masyarakat' => 'success',
                        default => 'gray',
                    }),
                ToggleColumn::make('is_active'),

            ])
            ->filters([
                SelectFilter::make('category')
                    ->options(Testimonial::CATEGORIES)
                    ->label('Filter Kategori'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
