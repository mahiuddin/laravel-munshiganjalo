<?php

namespace App\Filament\Resources\OrganizationCategories\Pages;

use App\Filament\Resources\OrganizationCategories\OrganizationCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrganizationCategories extends ListRecords
{
    protected static string $resource = OrganizationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}