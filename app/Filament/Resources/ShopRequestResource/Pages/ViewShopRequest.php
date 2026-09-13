<?php

namespace App\Filament\Resources\ShopRequestResource\Pages;

use App\Filament\Resources\ShopRequestResource;
use Filament\Resources\Pages\ViewRecord;

class ViewShopRequest extends ViewRecord
{
    protected static string $resource = ShopRequestResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (! ($data['is_read'] ?? false)) {
            $this->record->update(['is_read' => true]);
            $data['is_read'] = true;
        }

        return $data;
    }
}
