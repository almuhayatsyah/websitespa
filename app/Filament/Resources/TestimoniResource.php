<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimoniResource\Pages;
use App\Models\Testimoni;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimoniResource extends Resource
{
    protected static ?string $model = Testimoni::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Testimoni';
    protected static ?string $modelLabel = 'Testimoni';
    protected static ?string $pluralModelLabel = 'Daftar Testimoni';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Data Pelanggan')
                ->schema([
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('jabatan')
                        ->label('Jabatan / Pekerjaan')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('perusahaan')
                        ->label('Perusahaan / Instansi')
                        ->maxLength(255),

                    Forms\Components\FileUpload::make('gambar')
                        ->label('Foto Profil')
                        ->image()
                        ->directory('testimoni')
                        ->disk('public')
                        ->avatar()
                        ->imageEditor()
                        ->maxSize(1024)
                        ->helperText('Opsional. Foto profil pelanggan.'),
                ])->columns(2),

            Forms\Components\Section::make('Ulasan')
                ->schema([
                    Forms\Components\Textarea::make('ulasan')
                        ->label('Ulasan / Testimoni')
                        ->required()
                        ->rows(4)
                        ->columnSpanFull(),

                    Forms\Components\Select::make('penilaian')
                        ->label('Rating Bintang')
                        ->options([
                            1 => '⭐ 1 Bintang',
                            2 => '⭐⭐ 2 Bintang',
                            3 => '⭐⭐⭐ 3 Bintang',
                            4 => '⭐⭐⭐⭐ 4 Bintang',
                            5 => '⭐⭐⭐⭐⭐ 5 Bintang',
                        ])
                        ->default(5)
                        ->required(),
                ]),

            Forms\Components\Section::make('Pengaturan')
                ->schema([
                    Forms\Components\Toggle::make('aktif')
                        ->label('Tampilkan di Website')
                        ->default(true),

                    Forms\Components\TextInput::make('urutan')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->size(48)
                    ->defaultImageUrl(asset('images/avatar-placeholder.svg')),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('ulasan')
                    ->label('Ulasan')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->ulasan),

                Tables\Columns\TextColumn::make('penilaian')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),

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
            'index'  => Pages\ListTestimonis::route('/'),
            'create' => Pages\CreateTestimoni::route('/create'),
            'edit'   => Pages\EditTestimoni::route('/{record}/edit'),
        ];
    }
}
