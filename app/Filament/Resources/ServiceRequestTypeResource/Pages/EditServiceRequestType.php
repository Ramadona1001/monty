<?php

namespace App\Filament\Resources\ServiceRequestTypeResource\Pages;

use App\Filament\Resources\ServiceRequestTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceRequestType extends EditRecord
{
    protected static string $resource = ServiceRequestTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
