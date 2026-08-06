<?php

namespace App\Filament\Resources\ServiceRequestResource\Pages;

use App\Filament\Resources\ServiceRequestResource;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceRequest extends ViewRecord
{
    protected static string $resource = ServiceRequestResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (! ($data['is_read'] ?? false)) {
            $this->record->update(['is_read' => true]);
            $data['is_read'] = true;
        }

        return $data;
    }
}
