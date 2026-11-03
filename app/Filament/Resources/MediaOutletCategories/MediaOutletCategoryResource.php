<?php

namespace App\Filament\Resources\MediaOutletCategories;

use App\Filament\Resources\MediaOutletCategories\Pages\CreateMediaOutletCategory;
use App\Filament\Resources\MediaOutletCategories\Pages\EditMediaOutletCategory;
use App\Filament\Resources\MediaOutletCategories\Pages\ListMediaOutletCategories;
use App\Filament\Resources\MediaOutletCategories\Schemas\MediaOutletCategoryForm;
use App\Filament\Resources\MediaOutletCategories\Tables\MediaOutletCategoriesTable;
use App\Models\MediaOutletCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MediaOutletCategoryResource extends Resource
{
    protected static ?string $model = MediaOutletCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Media Outlet Categories';

    protected static ?string $modelLabel = 'Media Outlet Category';

    protected static ?string $pluralModelLabel = 'Media Outlet Categories';

    protected static ?int $navigationSort = 9;

    public static function form(Schema $schema): Schema
    {
        return MediaOutletCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MediaOutletCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMediaOutletCategories::route('/'),
            'create' => CreateMediaOutletCategory::route('/create'),
            'edit' => EditMediaOutletCategory::route('/{record}/edit'),
        ];
    }
}
