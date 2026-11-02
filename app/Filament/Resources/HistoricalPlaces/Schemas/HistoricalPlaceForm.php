<?php
namespace App\Filament\Resources\HistoricalPlaces\Schemas;

use App\Models\District;
use App\Models\HistoricalPlaceCategory;
use App\Models\Upazila;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class HistoricalPlaceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('historical_place_category_id')
                ->label('Category')
                ->options(fn () => HistoricalPlaceCategory::where('status', true)
                    ->orderBy('name')->pluck('name', 'id'))
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('name')
                ->label('Historical Place Name')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(function (?string $state, Set $set): void {
                    if ($state) {
                        $set('slug', Str::slug($state));
                    }
                }),

            TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            TextInput::make('alternative_name')
                ->label('Alternative Name')
                ->maxLength(255),

            TextInput::make('established_period')
                ->label('Established Period')
                ->placeholder('Example: 18th Century'),

            TextInput::make('founder')
                ->label('Founder / Builder')
                ->maxLength(255),

            Select::make('district_id')
                ->label('District')
                ->options(fn () => District::where('status', true)
                    ->orderBy('name')->pluck('name', 'id'))
                ->searchable()
                ->preload()
                ->live()
                ->required()
                ->afterStateUpdated(fn (Set $set) => $set('upazila_id', null)),

            Select::make('upazila_id')
                ->label('Upazila')
                ->options(fn (Get $get) => $get('district_id')
                    ? Upazila::where('district_id', $get('district_id'))
                        ->where('status', true)
                        ->orderBy('name')
                        ->pluck('name', 'id')
                    : [])
                ->searchable()
                ->preload()
                ->disabled(fn (Get $get) => ! $get('district_id')),

            Textarea::make('address')
                ->label('Full Address')
                ->rows(2)
                ->columnSpanFull(),

            TextInput::make('latitude')
                ->numeric()
                ->placeholder('23.5421000'),

            TextInput::make('longitude')
                ->numeric()
                ->placeholder('90.5260000'),

            FileUpload::make('featured_image')
                ->label('Featured Image')
                ->image()
                ->disk('public')
                ->directory('historical-places/featured')
                ->imageEditor()
                ->maxSize(5120)
                ->columnSpanFull(),

            Textarea::make('short_description')
                ->label('Short Description')
                ->rows(3)
                ->columnSpanFull(),

            RichEditor::make('history')
                ->label('Historical Background')
                ->columnSpanFull(),

            RichEditor::make('historical_significance')
                ->label('Historical Significance')
                ->columnSpanFull(),

            Textarea::make('source')
                ->label('Information Sources / References')
                ->rows(3)
                ->helperText('Mention books, documents, websites or other references.')
                ->columnSpanFull(),

            Repeater::make('images')
                ->label('Photo Gallery')
                ->relationship()
                ->schema([
                    FileUpload::make('image')
                        ->label('Gallery Image')
                        ->image()
                        ->disk('public')
                        ->directory('historical-places/gallery')
                        ->required(),

                    TextInput::make('caption')
                        ->label('Image Caption')
                        ->maxLength(255),

                    TextInput::make('sort_order')
                        ->label('Display Order')
                        ->numeric()
                        ->default(0),
                ])
                ->orderColumn('sort_order')
                ->collapsible()
                ->reorderable()
                ->defaultItems(0)
                ->columnSpanFull(),

            TextInput::make('meta_title')
                ->label('SEO Title')
                ->maxLength(255),

            Textarea::make('meta_description')
                ->label('SEO Description')
                ->rows(2)
                ->columnSpanFull(),
        ]);
    }
}
