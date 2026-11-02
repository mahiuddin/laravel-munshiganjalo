<?php

namespace App\Filament\Resources\HistoricalPlaceCategories\Pages;

use App\Filament\Resources\HistoricalPlaceCategories\HistoricalPlaceCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHistoricalPlaceCategory extends EditRecord
{
    protected static string $resource = HistoricalPlaceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
