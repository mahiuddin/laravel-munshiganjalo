<?php

namespace App\Filament\Resources\HistoricalPlaces\Pages;

use App\Filament\Resources\HistoricalPlaces\HistoricalPlaceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHistoricalPlace extends EditRecord
{
    protected static string $resource = HistoricalPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
