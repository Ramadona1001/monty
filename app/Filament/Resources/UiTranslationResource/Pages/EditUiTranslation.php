<?php

namespace App\Filament\Resources\UiTranslationResource\Pages;

use App\Filament\Resources\UiTranslationResource;
use App\Services\UiTranslationService;
use Filament\Resources\Pages\EditRecord;

class EditUiTranslation extends EditRecord
{
    protected static string $resource = UiTranslationResource::class;

    protected function afterSave(): void
    {
        app(UiTranslationService::class)->clearCache();
    }

    protected function afterDelete(): void
    {
        app(UiTranslationService::class)->clearCache();
    }
}
