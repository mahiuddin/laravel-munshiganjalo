<?php

namespace App\Filament\Resources\MediaOutletCategories\Pages;

use App\Filament\Resources\MediaOutletCategories\MediaOutletCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMediaOutletCategories extends ListRecords
{
    protected static string $resource = MediaOutletCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}