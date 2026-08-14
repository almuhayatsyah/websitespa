<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Konten Website';
    protected static ?string $navigationLabel = 'FAQ';
    protected static ?string $modelLabel = 'FAQ';
    protected static ?string $pluralModelLabel = 'Daftar FAQ';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pertanyaan & Jawaban')
                ->schema([
                    Forms\Components\TextInput::make('pertanyaan')
                        ->label('Pertanyaan')
                        ->required()
                        ->maxLength(500)
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('jawaban')
                        ->label('Jawaban')
                        ->required()
                        ->rows(5)
                        ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->wrap()
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('jawaban')
                    ->label('Jawaban')
                    ->limit(80)
                    ->tooltip(fn ($record) => $record->jawaban),

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
            'index'  => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit'   => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
