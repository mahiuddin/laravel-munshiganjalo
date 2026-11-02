<?php

namespace App\Filament\Resources\PersonalityCategories\Pages;

use App\Filament\Resources\PersonalityCategories\PersonalityCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPersonalityCategories extends ListRecords
{
    protected static string $resource = PersonalityCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
