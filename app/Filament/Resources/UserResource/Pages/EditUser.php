<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'Edit Akun: ' . $this->record->nama;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus Akun')
                ->requiresConfirmation()
                ->modalHeading('Hapus Akun?')
                ->modalDescription('Akun yang dihapus tidak dapat dipulihkan.')
                ->modalSubmitActionLabel('Ya, Hapus'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Akun berhasil diperbarui!')
            ->body('Data akun dan password telah disimpan.');
    }
}
