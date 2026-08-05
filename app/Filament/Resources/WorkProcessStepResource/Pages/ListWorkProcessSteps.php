<?php

namespace App\Filament\Resources\WorkProcessStepResource\Pages;

use App\Filament\Resources\WorkProcessStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkProcessSteps extends ListRecords
{
    protected static string $resource = WorkProcessStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
