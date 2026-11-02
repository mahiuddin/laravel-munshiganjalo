<?php

namespace App\Filament\Resources\EducationCategories;

use App\Filament\Resources\EducationCategories\Pages\CreateEducationCategory;
use App\Filament\Resources\EducationCategories\Pages\EditEducationCategory;
use App\Filament\Resources\EducationCategories\Pages\ListEducationCategories;
use App\Filament\Resources\EducationCategories\Schemas\EducationCategoryForm;
use App\Filament\Resources\EducationCategories\Tables\EducationCategoriesTable;
use App\Models\EducationCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EducationCategoryResource extends Resource
{
    protected static ?string $model = EducationCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Education Categories';

    protected static ?string $modelLabel = 'Education Category';

    protected static ?string $pluralModelLabel = 'Education Categories';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return EducationCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EducationCategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEducationCategories::route('/'),
            'create' => CreateEducationCategory::route('/create'),
            'edit' => EditEducationCategory::route('/{record}/edit'),
        ];
    }
}
