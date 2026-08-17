<?php

namespace App\Filament\Resources\GalleryItemResource\Pages;

use App\Filament\Resources\GalleryItemResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateGalleryItem extends CreateRecord
{
    protected static string $resource = GalleryItemResource::class;

    /** @param  array<string, mixed>  $data */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->normalizeMediaFields($data);
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
                    'media_url' => 'Please enter a URL or switch to upload.',
                ]);
            }

            $data['media_path'] = null;
        }

        return $data;
    }
}
