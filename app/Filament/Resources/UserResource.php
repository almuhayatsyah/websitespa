<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Manajemen Akun';
    protected static ?string $navigationGroup = 'Sistem';
    protected static ?string $title = 'Manajemen Akun Admin';
    protected static ?string $modelLabel = 'Akun';
    protected static ?string $pluralModelLabel = 'Daftar Akun';
    protected static ?int $navigationSort = 98;

    public static function form(Form $form): Form
    {
        $isEdit = $form->getOperation() === 'edit';

        return $form->schema([
            Forms\Components\Section::make('👤 Informasi Akun')
                ->schema([
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama Lengkap')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->unique(User::class, 'email', ignoreRecord: true),
                ])->columns(2),

            Forms\Components\Section::make('🔐 Password')
                ->description($isEdit ? 'Kosongkan jika tidak ingin mengganti password.' : 'Masukkan password untuk akun baru.')
                ->schema([
                    Forms\Components\TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->revealable()
                        ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn () => !$isEdit)
                        ->rule(Password::min(8))
                        ->maxLength(255),

                    Forms\Components\TextInput::make('password_confirmation')
                        ->label('Konfirmasi Password')
                        ->password()
                        ->revealable()
                        ->same('password')
                        ->required(fn () => !$isEdit)
                        ->dehydrated(false)
                        ->maxLength(255),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email disalin!')
                    ->icon('heroicon-m-envelope'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'asc')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->tooltip('Edit akun & ganti password'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->tooltip('Hapus akun')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Akun?')
                    ->modalDescription('Akun yang dihapus tidak dapat dipulihkan.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateHeading('Belum ada akun admin')
            ->emptyStateDescription('Klik tombol "Tambah Akun" untuk membuat akun admin baru.')
            ->emptyStateIcon('heroicon-o-user-plus');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
