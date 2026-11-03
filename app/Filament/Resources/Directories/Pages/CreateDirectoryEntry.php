<?php

namespace App\Filament\Resources\Directories\Pages;

use App\Filament\Resources\Directories\DirectoryEntryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDirectoryEntry extends CreateRecord
{
    protected static string $resource = DirectoryEntryResource::class;
}