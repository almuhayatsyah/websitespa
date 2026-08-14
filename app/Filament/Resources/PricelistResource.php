<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricelistResource\Pages;
use App\Models\Pricelist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PricelistResource extends Resource
{
    protected static ?string $model = Pricelist::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Pricelist';
    protected static ?string $modelLabel = 'Pricelist';
    protected static ?string $pluralModelLabel = 'Daftar Pricelist';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Treatment')
                ->schema([
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama Treatment')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\Select::make('kategori')
                        ->label('Kategori')
                        ->options([
                            'Body'  => 'Body Treatment',
                            'Face'  => 'Facial Treatment',
                            'Hair'  => 'Hair Treatment',
                            'Nail'  => 'Nail Care',
                            'Paket' => 'Paket Spa',
                        ])
                        ->required()
                        ->searchable(),

                    Forms\Components\Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('harga')
                        ->label('Harga (Rp)')
                        ->required()
                        ->numeric()
                        ->prefix('Rp')
                        ->minValue(0),

                    Forms\Components\TextInput::make('durasi')
                        ->label('Durasi (menit)')
                        ->numeric()
                        ->suffix('menit')
                        ->minValue(0)
                        ->helperText('Opsional. Masukkan durasi treatment dalam menit.'),

                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('pricelist')
                        ->disk('public')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->helperText('Format: JPG, PNG, WEBP. Maks 2MB.')
                        ->columnSpanFull(),
                ])->columns(2),

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

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Treatment')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('idr')
                    ->sortable(),

                Tables\Columns\TextColumn::make('durasi')
                    ->label('Durasi')
                    ->suffix(' menit')
                    ->sortable()
                    ->placeholder('-'),

                Tables\Columns\ToggleColumn::make('aktif')
                    ->label('Aktif'),

                Tables\Columns\TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'Body'  => 'Body Treatment',
                        'Face'  => 'Facial Treatment',
                        'Hair'  => 'Hair Treatment',
                        'Nail'  => 'Nail Care',
                        'Paket' => 'Paket Spa',
                    ]),
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
            'index'  => Pages\ListPricelists::route('/'),
            'create' => Pages\CreatePricelist::route('/create'),
            'edit'   => Pages\EditPricelist::route('/{record}/edit'),
        ];
    }
}
