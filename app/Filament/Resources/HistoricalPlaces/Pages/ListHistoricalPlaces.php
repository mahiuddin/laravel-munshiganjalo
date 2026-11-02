<?php

namespace App\Filament\Resources\HistoricalPlaces\Pages;

use App\Filament\Resources\HistoricalPlaces\HistoricalPlaceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistoricalPlaces extends ListRecords
{
    protected static string $resource = HistoricalPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
