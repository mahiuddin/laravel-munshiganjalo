<?php

namespace App\Filament\Resources\HistoricalPlaceCategories;

use App\Filament\Resources\HistoricalPlaceCategories\Pages\CreateHistoricalPlaceCategory;
use App\Filament\Resources\HistoricalPlaceCategories\Pages\EditHistoricalPlaceCategory;
use App\Filament\Resources\HistoricalPlaceCategories\Pages\ListHistoricalPlaceCategories;
use App\Filament\Resources\HistoricalPlaceCategories\Schemas\HistoricalPlaceCategoryForm;
use App\Filament\Resources\HistoricalPlaceCategories\Tables\HistoricalPlaceCategoriesTable;
use App\Models\HistoricalPlaceCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HistoricalPlaceCategoryResource extends Resource
{
    protected static ?string $model = HistoricalPlaceCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Historical Place Categories';

    protected static ?string $modelLabel = 'Historical Place Category';

    protected static ?string $pluralModelLabel = 'Historical Place Categories';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return HistoricalPlaceCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistoricalPlaceCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHistoricalPlaceCategories::route('/'),
            'create' => CreateHistoricalPlaceCategory::route('/create'),
            'edit' => EditHistoricalPlaceCategory::route('/{record}/edit'),
        ];
    }
}
