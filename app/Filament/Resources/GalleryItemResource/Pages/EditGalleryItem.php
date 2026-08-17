<?php

namespace App\Filament\Resources\GalleryItemResource\Pages;

use App\Filament\Resources\GalleryItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditGalleryItem extends EditRecord
{
    protected static string $resource = GalleryItemResource::class;

    /** @param  array<string, mixed>  $data */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['media_source'] = filled($data['media_url'] ?? null) && blank($data['media_path'] ?? null)
            ? 'external'
            : 'upload';

        return $data;
    }

    /** @param  array<string, mixed>  $data */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->normalizeMediaFields($data);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /** @param  array<string, mixed>  $data */
    private function normalizeMediaFields(array $data): array
    {
        $source = $this->form->getState()['media_source'] ?? 'upload';

        if ($source === 'upload') {
            if (blank($data['media_path'] ?? null)) {
                throw ValidationException::withMessages([
                    'media_path' => 'Please upload a file or switch to external URL.',
                ]);
            }

            $data['media_url'] = null;
        } else {
            if (blank($data['media_url'] ?? null)) {
                throw ValidationException::withMessages([
                    'media_url' => 'Please enter a URL or switch to external URL.',
                ]);
            }

            $data['media_path'] = null;
        }

        return $data;
    }
}
