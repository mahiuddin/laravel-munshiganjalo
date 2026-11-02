<?php

namespace App\Filament\Resources\HistoricalPlaces;

use App\Filament\Resources\HistoricalPlaces\Pages\CreateHistoricalPlace;
use App\Filament\Resources\HistoricalPlaces\Pages\EditHistoricalPlace;
use App\Filament\Resources\HistoricalPlaces\Pages\ListHistoricalPlaces;
use App\Filament\Resources\HistoricalPlaces\Schemas\HistoricalPlaceForm;
use App\Filament\Resources\HistoricalPlaces\Tables\HistoricalPlacesTable;
use App\Models\HistoricalPlace;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HistoricalPlaceResource extends Resource
{
    protected static ?string $model = HistoricalPlace::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Historical Places';

    protected static ?string $modelLabel = 'Historical Place';

    protected static ?string $pluralModelLabel = 'Historical Places';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return HistoricalPlaceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistoricalPlacesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHistoricalPlaces::route('/'),
            'create' => CreateHistoricalPlace::route('/create'),
            'edit' => EditHistoricalPlace::route('/{record}/edit'),
        ];
    }
}
