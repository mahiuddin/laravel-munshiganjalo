<?php

namespace App\Filament\Resources\OrganizationCategories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class OrganizationCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->required()
                ->maxLength(150)
                ->live(onBlur: true)
                ->afterStateUpdated(function (?string $state, $set): void {
                    if ($state) {
                        $set('slug', Str::slug($state));
                    }
                }),

            TextInput::make('slug')
                ->required()
                ->maxLength(180)
                ->unique(ignoreRecord: true),

            Textarea::make('description')
                ->rows(3)
                ->columnSpanFull(),

            Toggle::make('status')
                ->label('Active')
                ->default(true),

            TextInput::make('sort_order')
                ->numeric()
                ->default(0)
                ->required(),
        ]);
    }
}
