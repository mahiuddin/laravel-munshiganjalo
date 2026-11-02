<?php

namespace App\Filament\Resources\DistrictInformations;

use App\Filament\Resources\DistrictInformations\Pages\CreateDistrictInformation;
use App\Filament\Resources\DistrictInformations\Pages\EditDistrictInformation;
use App\Filament\Resources\DistrictInformations\Pages\ListDistrictInformations;
use App\Filament\Resources\DistrictInformations\Schemas\DistrictInformationForm;
use App\Filament\Resources\DistrictInformations\Tables\DistrictInformationsTable;
use App\Models\DistrictInformation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DistrictInformationResource extends Resource
{
    protected static ?string $model = DistrictInformation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static string|UnitEnum|null $navigationGroup = 'Information Management';

    protected static ?string $navigationLabel = 'District Information';

    protected static ?string $modelLabel = 'District Information';

    protected static ?string $pluralModelLabel = 'District Information';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return DistrictInformationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DistrictInformationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDistrictInformations::route('/'),
            'create' => CreateDistrictInformation::route('/create'),
            'edit' => EditDistrictInformation::route('/{record}/edit'),
        ];
    }
}
