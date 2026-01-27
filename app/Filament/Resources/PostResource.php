<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
// Komponen Form
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Set;
// Komponen Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    // KOLOM KIRI (Konten Utama) - Mengambil 2 grid
                    Section::make('Konten Utama')->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('external_link')
                            ->label('Link Eksternal / YouTube')
                            ->helperText('Abaikan Jika Artikel Tulisan Sendiri')
                            ->url()
                            ->placeholder('https://youtube.com/... atau https://detik.com/...')
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->label('Isi Berita')
                            ->required()
                            ->fileAttachmentsDirectory('posts/content') // Upload gambar di dalam editor
                            ->columnSpanFull(),
                    ])->columnSpan(2),

                    Section::make('Meta Data')->schema([
                        FileUpload::make('thumbnail')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('posts/thumbnails')
                            ->maxSize(5240)
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1280')
                            ->imageResizeTargetHeight('720')
                            ->required(),

                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->required()
                            ->createOptionForm([ // Fitur Quick Create Category
                                TextInput::make('name')->required(),
                                TextInput::make('slug')->required(),
                            ]),

                        TextInput::make('author')
                            ->helperText('Skip Jika Bukan Artikel')
                            ->label('Nama Author')
                            ->placeholder('Contoh: Tim Redaksi IYES')
                            ->columnSpanFull(),


                        Select::make('tags')
                            ->label('Tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload(),

                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->default('draft')
                            ->required(),

                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publish')
                            ->default(now()),

                        Toggle::make('is_featured')
                            ->label('Jadikan Headline')
                            ->onColor('success'),

                        // Hidden field untuk User ID otomatis
                        Forms\Components\Hidden::make('user_id')
                            ->default(auth()->id()),
                    ])->columnSpan(1),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->description(fn(Post $record): string => Str::limit(strip_tags($record->content), 30)),

                TextColumn::make('category.name')
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'warning',
                    }),

                TextColumn::make('published_at')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),

                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), // Akan dibatasi policy nanti
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
