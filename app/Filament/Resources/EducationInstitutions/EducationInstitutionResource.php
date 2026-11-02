<?php

namespace App\Filament\Resources\EducationInstitutions;

use App\Filament\Resources\EducationInstitutions\Pages\CreateEducationInstitution;
use App\Filament\Resources\EducationInstitutions\Pages\EditEducationInstitution;
use App\Filament\Resources\EducationInstitutions\Pages\ListEducationInstitutions;
use App\Filament\Resources\EducationInstitutions\Schemas\EducationInstitutionForm;
use App\Filament\Resources\EducationInstitutions\Tables\EducationInstitutionsTable;
use App\Models\EducationInstitution;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EducationInstitutionResource extends Resource
{
    protected static ?string $model = EducationInstitution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'Education Institutions';

    protected static ?string $modelLabel = 'Education Institution';

    protected static ?string $pluralModelLabel = 'Education Institutions';

    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return EducationInstitutionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EducationInstitutionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEducationInstitutions::route('/'),
            'create' => CreateEducationInstitution::route('/create'),
            'edit' => EditEducationInstitution::route('/{record}/edit'),
        ];
    }
}
