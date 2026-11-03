<?php

namespace App\Filament\Resources\DistrictInformations\Pages;

use App\Filament\Resources\DistrictInformations\DistrictInformationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDistrictInformations extends ListRecords
{
    protected static string $resource = DistrictInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}