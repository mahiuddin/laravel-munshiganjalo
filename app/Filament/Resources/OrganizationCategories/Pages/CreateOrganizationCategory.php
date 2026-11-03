<?php

namespace App\Filament\Resources\OrganizationCategories\Pages;

use App\Filament\Resources\OrganizationCategories\OrganizationCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrganizationCategory extends CreateRecord
{
    protected static string $resource = OrganizationCategoryResource::class;
}