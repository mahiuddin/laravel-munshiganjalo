<?php

namespace App\Filament\Resources\MediaOutlets;

use App\Filament\Resources\MediaOutlets\Pages\CreateMediaOutlet;
use App\Filament\Resources\MediaOutlets\Pages\EditMediaOutlet;
use App\Filament\Resources\MediaOutlets\Pages\ListMediaOutlets;
use App\Filament\Resources\MediaOutlets\Schemas\MediaOutletForm;
use App\Filament\Resources\MediaOutlets\Tables\MediaOutletsTable;
use App\Models\MediaOutlet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MediaOutletResource extends Resource
{
    protected static ?string $model = MediaOutlet::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Media Outlets';

    protected static ?string $modelLabel = 'Media Outlet';

    protected static ?string $pluralModelLabel = 'Media Outlets';

    protected static ?int $navigationSort = 12;

    public static function form(Schema $schema): Schema
    {
        return MediaOutletForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MediaOutletsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMediaOutlets::route('/'),
            'create' => CreateMediaOutlet::route('/create'),
            'edit' => EditMediaOutlet::route('/{record}/edit'),
        ];
    }
}
