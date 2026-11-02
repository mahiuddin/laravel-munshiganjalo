<?php

namespace App\Filament\Resources\PersonalityCategories;

use App\Filament\Resources\PersonalityCategories\Pages\CreatePersonalityCategory;
use App\Filament\Resources\PersonalityCategories\Pages\EditPersonalityCategory;
use App\Filament\Resources\PersonalityCategories\Pages\ListPersonalityCategories;
use App\Filament\Resources\PersonalityCategories\Schemas\PersonalityCategoryForm;
use App\Filament\Resources\PersonalityCategories\Tables\PersonalityCategoriesTable;
use App\Models\PersonalityCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PersonalityCategoryResource extends Resource
{
    protected static ?string $model = PersonalityCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Personality Categories';

    protected static ?string $modelLabel = 'Personality Category';

    protected static ?string $pluralModelLabel = 'Personality Categories';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PersonalityCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersonalityCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPersonalityCategories::route('/'),
            'create' => CreatePersonalityCategory::route('/create'),
            'edit' => EditPersonalityCategory::route('/{record}/edit'),
        ];
    }
}