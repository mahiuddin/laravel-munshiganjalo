<?php

namespace App\Filament\Resources\OrganizationCategories;

use App\Filament\Resources\OrganizationCategories\Pages\CreateOrganizationCategory;
use App\Filament\Resources\OrganizationCategories\Pages\EditOrganizationCategory;
use App\Filament\Resources\OrganizationCategories\Pages\ListOrganizationCategories;
use App\Filament\Resources\OrganizationCategories\Schemas\OrganizationCategoryForm;
use App\Filament\Resources\OrganizationCategories\Tables\OrganizationCategoriesTable;
use App\Models\OrganizationCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OrganizationCategoryResource extends Resource
{
    protected static ?string $model = OrganizationCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Organization Categories';

    protected static ?string $modelLabel = 'Organization Category';

    protected static ?string $pluralModelLabel = 'Organization Categories';

    protected static ?int $navigationSort = 8;

    public static function form(Schema $schema): Schema
    {
        return OrganizationCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrganizationCategories::route('/'),
            'create' => CreateOrganizationCategory::route('/create'),
            'edit' => EditOrganizationCategory::route('/{record}/edit'),
        ];
    }
}
