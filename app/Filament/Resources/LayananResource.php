<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Layanan';
    protected static ?string $modelLabel = 'Layanan';
    protected static ?string $pluralModelLabel = 'Daftar Layanan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Layanan')
                ->schema([
                    Forms\Components\TextInput::make('judul')
                        ->label('Judul Layanan')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('layanan')
                        ->disk('public')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->helperText('Format: JPG, PNG, WEBP. Maks 2MB.')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Pengaturan Tampilan')
                ->schema([
                    Forms\Components\Toggle::make('aktif')
                        ->label('Tampilkan di Website')
                        ->default(true),

                    Forms\Components\TextInput::make('urutan')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0)
                        ->helperText('Angka lebih kecil tampil lebih awal.'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->square()
                    ->size(56),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Layanan')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->deskripsi),

                Tables\Columns\ToggleColumn::make('aktif')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('aktif')->label('Status Aktif'),
            ])
            ->defaultSort('urutan')
            ->reorderable('urutan')
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLayanans::route('/'),
            'create' => Pages\CreateLayanan::route('/create'),
            'edit'   => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}
