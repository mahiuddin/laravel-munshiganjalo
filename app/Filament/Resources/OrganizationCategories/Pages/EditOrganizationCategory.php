<?php

namespace App\Filament\Resources\OrganizationCategories\Pages;

use App\Filament\Resources\OrganizationCategories\OrganizationCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrganizationCategory extends EditRecord
{
    protected static string $resource = OrganizationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}