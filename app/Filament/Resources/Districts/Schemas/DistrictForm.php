<?php

namespace App\Filament\Resources\Districts\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
    TextInput::make('name')
        ->required()
        ->maxLength(255),

    TextInput::make('slug')
        ->required()
        ->maxLength(255),

    Toggle::make('status')
        ->default(true),
]);
    }
}
