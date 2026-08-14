<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelResource\Pages;
use App\Models\Artikel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'Artikel';
    protected static ?string $modelLabel = 'Artikel';
    protected static ?string $pluralModelLabel = 'Daftar Artikel';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Artikel')
                ->schema([
                    Forms\Components\TextInput::make('judul')
                        ->label('Judul Artikel')
                        ->required()
                        ->maxLength(500)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('slug')
                        ->label('Slug URL')
                        ->required()
                        ->maxLength(500)
                        ->unique(ignoreRecord: true)
                        ->helperText('Otomatis terisi dari judul. Bisa diubah manual.')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('deskripsi')
                        ->label('Ringkasan / Deskripsi')
                        ->rows(3)
                        ->helperText('Tampil sebagai preview di halaman daftar artikel.')
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('konten')
                        ->label('Konten Artikel')
                        ->toolbarButtons([
                            'bold', 'italic', 'underline', 'strike',
                            'h2', 'h3',
                            'bulletList', 'orderedList', 'blockquote',
                            'link', 'attachFiles',
                            'undo', 'redo',
                        ])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('artikel/uploads')
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('artikel')
                        ->disk('public')
                        ->imageEditor()
                        ->maxSize(3072)
                        ->helperText('Format: JPG, PNG, WEBP. Maks 3MB.')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Pengaturan Publikasi')
                ->schema([
                    Forms\Components\Toggle::make('diterbitkan')
                        ->label('Terbitkan Artikel')
                        ->default(false),

                    Forms\Components\DateTimePicker::make('tanggal_terbit')
                        ->label('Tanggal Terbit')
                        ->native(false)
                        ->seconds(false)
                        ->default(now())
                        ->helperText('Artikel hanya tampil jika tanggal terbit sudah lewat.'),
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
                    ->size(56)
                    ->defaultImageUrl(asset('images/placeholder-article.svg')),

                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->limit(50),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Ringkasan')
                    ->limit(60)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('diterbitkan')
                    ->label('Diterbitkan')
                    ->boolean(),

                Tables\Columns\TextColumn::make('tanggal_terbit')
                    ->label('Tanggal Terbit')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('diterbitkan')->label('Status Publikasi'),
            ])
            ->defaultSort('tanggal_terbit', 'desc')
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
            'index'  => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'edit'   => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
