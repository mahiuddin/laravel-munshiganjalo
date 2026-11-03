<?php

namespace App\Filament\Resources\MediaOutlets\Schemas;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\District;
use App\Models\MediaOutletCategory;
use App\Models\Upazila;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MediaOutletForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('media_outlet_category_id')
                ->label('Media Category')
                ->options(fn () => MediaOutletCategory::where('status', true)
                    ->orderBy('name')
                    ->pluck('name', 'id'))
                ->searchable()
                ->required(),

            TextInput::make('name')
                ->label('Media Outlet Name')
                ->required()
                ->maxLength(200)
                ->live(onBlur: true)
                ->afterStateUpdated(function (?string $state, Set $set): void {
                    if ($state) {
                        $set('slug', Str::slug($state));
                    }
                }),

            TextInput::make('slug')
                ->required()
                ->maxLength(220)
                ->unique(ignoreRecord: true),

            TextInput::make('alternative_name')
                ->maxLength(200),

            TextInput::make('language')
                ->maxLength(100)
                ->placeholder('Bangla / English'),

            TextInput::make('publication_frequency')
                ->maxLength(100)
                ->placeholder('Daily / Weekly / Monthly'),

            TextInput::make('established_year')
                ->numeric()
                ->minValue(1800)
                ->maxValue((int) date('Y')),

            TextInput::make('owner_name')
                ->maxLength(150),

            TextInput::make('editor_name')
                ->maxLength(150),

            TextInput::make('contact_person')
                ->maxLength(150),

            Select::make('district_id')
                ->label('District')
                ->options(fn () => District::where('status', true)
                    ->orderBy('name')
                    ->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->live()
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
                ->disabled(fn (Get $get) => ! $get('district_id')),

            Textarea::make('address')
                ->rows(2)
                ->columnSpanFull(),

            TextInput::make('phone')
                ->tel()
                ->maxLength(50),

            TextInput::make('email')
                ->email()
                ->maxLength(150),

            TextInput::make('website')
                ->url()
                ->maxLength(255),

            TextInput::make('facebook_url')
                ->label('Facebook URL')
                ->url()
                ->maxLength(255),

            TextInput::make('youtube_url')
                ->label('YouTube URL')
                ->url()
                ->maxLength(255),

            TextInput::make('latitude')
                ->numeric(),

            TextInput::make('longitude')
                ->numeric(),

            FileUpload::make('featured_image')
                ->label('Media Logo / Featured Image')
                ->image()
                ->disk('public')
                ->directory('media-outlets/featured')
                ->imageEditor()
                ->columnSpanFull(),

            Textarea::make('short_description')
                ->rows(3)
                ->columnSpanFull(),

            RichEditor::make('description')
                ->columnSpanFull(),

            RichEditor::make('coverage_area')
                ->columnSpanFull(),

            Textarea::make('source')
                ->rows(3)
                ->columnSpanFull(),

            TextInput::make('meta_title')
                ->maxLength(255),

            Textarea::make('meta_description')
                ->rows(3)
                ->columnSpanFull(),

            Select::make('publication_status')
                ->options(collect(PublicationStatus::cases())
                    ->mapWithKeys(fn ($status) => [
                        $status->value => $status->label(),
                    ]))
                ->default(PublicationStatus::DRAFT->value)
                ->required(),

            Select::make('verification_status')
                ->options(collect(VerificationStatus::cases())
                    ->mapWithKeys(fn ($status) => [
                        $status->value => $status->label(),
                    ]))
                ->default(VerificationStatus::PENDING->value)
                ->required(),
        ]);
    }
}
