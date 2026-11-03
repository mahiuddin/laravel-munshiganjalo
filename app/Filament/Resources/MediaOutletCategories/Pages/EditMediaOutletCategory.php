<?php

namespace App\Filament\Resources\MediaOutletCategories\Pages;

use App\Filament\Resources\MediaOutletCategories\MediaOutletCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMediaOutletCategory extends EditRecord
{
    protected static string $resource = MediaOutletCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}