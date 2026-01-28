<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;


class EditionsRelationManager extends RelationManager
{
    protected static string $relationship = 'editions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama Edisi (Contoh: Batch 1)')->required(),
                TextInput::make('year')->label('Tahun')->numeric()->required(),
                TextInput::make('location')->label('Lokasi')->required(),

                DatePicker::make('start_date'),
                DatePicker::make('end_date'),

                // 1. Deskripsi Edisi
                RichEditor::make('description')
                    ->label('Cerita/Deskripsi Edisi Ini')
                    ->columnSpanFull(),

                Textarea::make('location_map')
                    ->label('Embed Google Maps (HTML)')
                    ->rows(5)
                    ->placeholder('<iframe src="https://www.google.com/maps/embed?..." ...></iframe>')
                    ->helperText('Cara ambil: Buka Google Maps > Pilih Lokasi > Share > Embed a map > Copy HTML.')
                    ->columnSpanFull(),

                // 2. Capaian Utama (Repeater)
                Repeater::make('achievements')
                    ->label('Capaian Utama (Key Highlights)')
                    ->schema([
                        TextInput::make('number')->label('Angka (Contoh: 50+)')->required(),
                        TextInput::make('label')->label('Keterangan (Contoh: Delegasi Negara)')->required(),
                    ])
                    ->grid(3)
                    ->columnSpanFull(),

                FileUpload::make('thumbnail')
                    ->label('Cover Edisi (Hero Image)')
                    ->image()
                    ->directory('program-editions/covers')
                    ->imageEditor()
                    ->columnSpanFull() // Agar lebar penuh
                    ->helperText('Jika dikosongkan, akan menggunakan cover dari Program Utama.'),

                // 3. Galeri (Multiple Upload)
                FileUpload::make('gallery')
                    ->label('Galeri Dokumentasi')
                    ->image()
                    ->multiple() // BISA UPLOAD BANYAK
                    ->reorderable()
                    ->directory('program-editions/gallery')
                    ->columnSpanFull(),

                Select::make('status')
                    ->options([
                        'upcoming' => 'Segera Hadir',
                        'open_registration' => 'Buka Pendaftaran',
                        'ongoing' => 'Sedang Berjalan',
                        'completed' => 'Selesai',
                    ])->default('upcoming'),

                // REPEATER: Input Testimoni dinamis (JSON)
                Repeater::make('testimonials')
                    ->label('Testimoni Peserta (Edisi Ini)')
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('role')->label('Asal/Jabatan'),
                        Textarea::make('quote')->required(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name') // Wajib ada agar judul modal muncul
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Edisi'),
                Tables\Columns\TextColumn::make('year')->label('Tahun'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'upcoming' => 'gray',
                        'open_registration' => 'success',
                        'ongoing' => 'warning',
                        'completed' => 'info',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // --- INI YANG HILANG SEBELUMNYA ---
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Edisi Baru'),
                // ----------------------------------
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
