<?php

namespace App\Filament\Resources\EducationInstitutions\Pages;

use App\Filament\Resources\EducationInstitutions\EducationInstitutionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEducationInstitution extends EditRecord
{
    protected static string $resource = EducationInstitutionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}