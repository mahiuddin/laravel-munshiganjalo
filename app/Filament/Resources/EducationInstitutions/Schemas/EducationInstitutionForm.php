<?php

namespace App\Filament\Resources\EducationInstitutions\Schemas;

use App\Models\District;
use App\Models\EducationCategory;
use App\Models\Upazila;
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

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;

class EducationInstitutionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('education_category_id')
                ->label('Institution Category')
                ->options(fn () => EducationCategory::where('status', true)
                    ->orderBy('name')->pluck('name', 'id'))
                ->searchable()
                ->required(),

            TextInput::make('name')
                ->label('Institution Name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(function (?string $state, Set $set): void {
                    if ($state) {
                        $set('slug', Str::slug($state));
                    }
                }),

            TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('alternative_name'),

            TextInput::make('eiin')
                ->label('EIIN')
                ->helperText('Keep blank if the institution has no EIIN.'),

            TextInput::make('institution_type')
                ->label('Institution Type')
                ->placeholder('Government / Private / MPO'),

            TextInput::make('management_type')
                ->label('Management Type'),

            TextInput::make('established_year')
                ->numeric()
                ->minValue(1800)
                ->maxValue((int) date('Y')),

            TextInput::make('head_name')
                ->label('Head of Institution'),

            Select::make('district_id')
                ->options(fn () => District::where('status', true)
                    ->orderBy('name')->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->live()
                ->afterStateUpdated(fn (Set $set) => $set('upazila_id', null)),

            Select::make('upazila_id')
                ->options(fn (Get $get) => $get('district_id')
                    ? Upazila::where('district_id', $get('district_id'))
                        ->where('status', true)
                        ->orderBy('name')->pluck('name', 'id')
                    : [])
                ->searchable()
                ->disabled(fn (Get $get) => ! $get('district_id')),

            TextInput::make('address')->columnSpanFull(),
            TextInput::make('phone'),
            TextInput::make('email')->email(),
            TextInput::make('website')->url(),

            TextInput::make('latitude'),
            TextInput::make('longitude'),



            FileUpload::make('featured_image')
                ->image()
                ->disk('public')
                ->directory('education-institutions/featured')
                ->imageEditor()
                ->columnSpanFull(),

            Textarea::make('short_description')
                ->rows(3)
                ->columnSpanFull(),

            RichEditor::make('history')->columnSpanFull(),
            RichEditor::make('facilities')->columnSpanFull(),
            RichEditor::make('academic_information')->columnSpanFull(),

            Textarea::make('source')->rows(3)->columnSpanFull(),

            Repeater::make('images')
                ->label('Institution Image Gallery')
                ->relationship()
                ->schema([
                    FileUpload::make('image')
                        ->label('Upload Image')
                        ->image()
                        ->disk('public')
                        ->directory('education-institutions/gallery')
                        ->imageEditor()
                        ->required(),

                    TextInput::make('caption')
                        ->label('Image Caption')
                        ->maxLength(255),

                    TextInput::make('sort_order')
                        ->label('Display Order')
                        ->numeric()
                        ->default(0)
                        ->required(),
                ])
                ->orderColumn('sort_order')
                ->collapsible()
                ->reorderable()
                ->defaultItems(0)
                ->addActionLabel('Add Institution Image')
                ->columnSpanFull(),

            TextInput::make('meta_title'),
            Textarea::make('meta_description')->rows(3)->columnSpanFull(),
            Select::make('publication_status')
                ->options(collect(PublicationStatus::cases())
                    ->mapWithKeys(fn ($status) => [
                        $status->value => ucfirst($status->value),
                    ]))
                ->default(PublicationStatus::DRAFT->value)
                ->required(),

            Select::make('verification_status')
                ->options(collect(VerificationStatus::cases())
                    ->mapWithKeys(fn ($status) => [
                        $status->value => ucfirst($status->value),
                    ]))
                ->default(VerificationStatus::PENDING->value)
                ->required(),
        ]);
    }
}
