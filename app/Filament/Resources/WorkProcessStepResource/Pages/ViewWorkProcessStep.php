<?php

namespace App\Filament\Resources\WorkProcessStepResource\Pages;

use App\Filament\Resources\WorkProcessStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkProcessStep extends ViewRecord
{
    protected static string $resource = WorkProcessStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
