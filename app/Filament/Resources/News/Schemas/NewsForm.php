<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
Select::make('district_id')
    ->label('District')
    ->relationship('district', 'name')
    ->searchable()
    ->preload()
    ->live()
    ->afterStateUpdated(function (callable $set) {
        $set('upazila_id', null);
    }),

Select::make('upazila_id')
    ->label('Upazila')
    ->options(function (callable $get) {
        $districtId = $get('district_id');

        if (!$districtId) {
            return [];
        }

        return \App\Models\Upazila::query()
            ->where('district_id', $districtId)
            ->where('status', true)
            ->orderBy('name')
            ->pluck('name', 'id');
    })
    ->searchable()
    ->preload()
    ->disabled(fn (callable $get): bool => !$get('district_id'))
    ->required(fn (callable $get): bool => filled($get('district_id'))),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('excerpt')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('featured_image')
                    ->image()
                    ->disk('public')
                    ->directory('news'),
                Select::make('status')
                    ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('published_at'),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('views')
                    ->required()
                    ->numeric()
                    ->default(0),
                ]);
    }
}
