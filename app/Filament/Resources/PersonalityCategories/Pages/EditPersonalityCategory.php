<?php

namespace App\Filament\Resources\PersonalityCategories\Pages;

use App\Filament\Resources\PersonalityCategories\PersonalityCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPersonalityCategory extends EditRecord
{
    protected static string $resource = PersonalityCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
