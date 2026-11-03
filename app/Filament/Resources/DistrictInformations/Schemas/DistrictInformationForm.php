<?php

namespace App\Filament\Resources\DistrictInformations\Schemas;

use App\Models\District;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DistrictInformationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('district_id')
                ->label('District')
                ->options(fn () => District::orderBy('name')->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('tagline')->maxLength(255),
            TextInput::make('area')->label('Area')->maxLength(100),
            TextInput::make('population')->maxLength(100),
            TextInput::make('population_year')->maxLength(20),
            TextInput::make('density')->maxLength(100),
            TextInput::make('established_year')->maxLength(100),
            TextInput::make('postal_code')->maxLength(100),
            TextInput::make('official_website')->url()->maxLength(255),

            FileUpload::make('featured_image')
                ->image()
                ->disk('public')
                ->directory('district-information')
                ->imageEditor()
                ->columnSpanFull(),

            RichEditor::make('overview')->columnSpanFull(),
            RichEditor::make('history')->columnSpanFull(),
            RichEditor::make('geography')->columnSpanFull(),
            RichEditor::make('economy')->columnSpanFull(),
            RichEditor::make('culture')->columnSpanFull(),
            RichEditor::make('communication')->columnSpanFull(),
            RichEditor::make('rivers')->columnSpanFull(),
            RichEditor::make('education')->columnSpanFull(),
            RichEditor::make('administration')->columnSpanFull(),
            RichEditor::make('tourism')->columnSpanFull(),

            Textarea::make('sources')
                ->rows(4)
                ->columnSpanFull(),

            TextInput::make('meta_title')->maxLength(255),
            Textarea::make('meta_description')->rows(3)->columnSpanFull(),
        ]);
    }
}
