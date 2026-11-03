<?php

namespace App\Filament\Resources\DistrictInformations\Pages;

use App\Filament\Resources\DistrictInformations\DistrictInformationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDistrictInformation extends EditRecord
{
    protected static string $resource = DistrictInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}