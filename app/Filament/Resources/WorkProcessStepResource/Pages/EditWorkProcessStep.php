<?php

namespace App\Filament\Resources\WorkProcessStepResource\Pages;

use App\Filament\Resources\WorkProcessStepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkProcessStep extends EditRecord
{
    protected static string $resource = WorkProcessStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
