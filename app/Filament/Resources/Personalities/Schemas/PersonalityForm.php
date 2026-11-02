<?php

namespace App\Filament\Resources\Personalities\Schemas;

use App\Models\Personality;
use App\Models\Upazila;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PersonalityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Personality Name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (?string $state, Set $set, Get $get): void {
                        if (
                            blank($get('slug'))
                            && $state
                            && preg_match('/[A-Za-z]/', $state)
                        ) {
                            $set('slug', Str::slug($state));
                        }
                    }),

                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Use a unique English URL-friendly slug.'),

                Select::make('personality_category_id')
                    ->label('Personality Category')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('district_id')
                    ->label('District')
                    ->relationship('district', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('upazila_id', null)),

                Select::make('upazila_id')
                    ->label('Upazila')
                    ->options(fn (Get $get): array => filled($get('district_id'))
                        ? Upazila::query()
                            ->where('district_id', $get('district_id'))
                            ->where('status', true)
                            ->orderBy('name')
                            ->pluck('name', 'id')
                            ->all()
                        : [])
                    ->searchable()
                    ->preload()
                    ->placeholder('Select an upazila')
                    ->disabled(fn (Get $get): bool => blank($get('district_id')))
                    ->nullable(),

                TextInput::make('designation')
                    ->label('Designation / পরিচয়')
                    ->maxLength(255),

                DatePicker::make('date_of_birth')
                    ->label('Date of Birth')
                    ->native(false)
                    ->displayFormat('d M Y'),

                DatePicker::make('date_of_death')
                    ->label('Date of Death')
                    ->native(false)
                    ->displayFormat('d M Y'),

                TextInput::make('birth_place')
                    ->label('Birth Place')
                    ->maxLength(255),

                FileUpload::make('photo')
                    ->label('Personality Photo')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('personalities')
                    ->visibility('public')
                    ->maxSize(5120),

                Textarea::make('short_bio')
                    ->label('Short Biography')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull(),

                RichEditor::make('biography')
                    ->label('Detailed Biography')
                    ->columnSpanFull(),

                Textarea::make('source')
                    ->label('Source / Reference')
                    ->rows(3)
                    ->helperText('Mention books, publications, websites or other references.')
                    ->columnSpanFull(),

                TextInput::make('meta_title')
                    ->label('SEO Title')
                    ->maxLength(255),

                Textarea::make('meta_description')
                    ->label('SEO Description')
                    ->rows(2)
                    ->maxLength(500)
                    ->columnSpanFull(),
            ]);
    }
}