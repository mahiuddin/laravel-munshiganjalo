<?php

namespace App\Filament\Resources\EducationInstitutions\Pages;

use App\Filament\Resources\EducationInstitutions\EducationInstitutionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEducationInstitutions extends ListRecords
{
    protected static string $resource = EducationInstitutionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}