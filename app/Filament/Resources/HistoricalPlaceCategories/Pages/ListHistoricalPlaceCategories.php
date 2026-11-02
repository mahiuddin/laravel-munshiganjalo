<?php

namespace App\Filament\Resources\HistoricalPlaceCategories\Pages;

use App\Filament\Resources\HistoricalPlaceCategories\HistoricalPlaceCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistoricalPlaceCategories extends ListRecords
{
    protected static string $resource = HistoricalPlaceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
