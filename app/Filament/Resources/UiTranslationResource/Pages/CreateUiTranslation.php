<?php

namespace App\Filament\Resources\UiTranslationResource\Pages;

use App\Filament\Resources\UiTranslationResource;
use App\Services\UiTranslationService;
use Filament\Resources\Pages\CreateRecord;

class CreateUiTranslation extends CreateRecord
{
    protected static string $resource = UiTranslationResource::class;

    protected function afterCreate(): void
    {
        app(UiTranslationService::class)->clearCache();
    }
}
