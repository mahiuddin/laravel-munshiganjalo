<?php

namespace App\Filament\Resources\Directories;

use App\Filament\Resources\Directories\Pages\CreateDirectoryEntry;
use App\Filament\Resources\Directories\Pages\EditDirectoryEntry;
use App\Filament\Resources\Directories\Pages\ListDirectoryEntries;
use App\Filament\Resources\Directories\Schemas\DirectoryEntryForm;
use App\Filament\Resources\Directories\Tables\DirectoryEntriesTable;
use App\Models\DirectoryEntry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DirectoryEntryResource extends Resource
{
    protected static ?string $model = DirectoryEntry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Public Directory';

    protected static ?string $modelLabel = 'Directory Entry';

    protected static ?string $pluralModelLabel = 'Directory Entries';

    protected static ?int $navigationSort = 13;

    public static function form(Schema $schema): Schema
    {
        return DirectoryEntryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DirectoryEntriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDirectoryEntries::route('/'),
            'create' => CreateDirectoryEntry::route('/create'),
            'edit' => EditDirectoryEntry::route('/{record}/edit'),
        ];
    }
}
