<?php

namespace App\Filament\Resources\Personalities\Tables;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\Personality;
use App\Services\VerificationService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PersonalitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Photo')
                    ->disk('public')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Personality $record): ?string => $record->designation),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('district.name')
                    ->label('District')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('upazila.name')
                    ->label('Upazila')
                    ->placeholder('District-wide'),

                TextColumn::make('publication_status')
                    ->label('Publication')
                    ->badge()
                    ->formatStateUsing(
                        fn (PublicationStatus $state): string => $state->label()
                    )
                    ->color(fn (PublicationStatus $state): string => match ($state) {
                        PublicationStatus::DRAFT => 'gray',
                        PublicationStatus::PUBLISHED => 'success',
                        PublicationStatus::ARCHIVED => 'warning',
                    }),

                TextColumn::make('verification_status')
                    ->label('Verification')
                    ->badge()
                    ->formatStateUsing(
                        fn (VerificationStatus $state): string => $state->label()
                    )
                    ->color(fn (VerificationStatus $state): string => match ($state) {
                        VerificationStatus::PENDING => 'warning',
                        VerificationStatus::VERIFIED => 'success',
                        VerificationStatus::REJECTED => 'danger',
                    }),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('personality_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('district_id')
                    ->label('District')
                    ->relationship('district', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('publication_status')
                    ->label('Publication Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),

                SelectFilter::make('verification_status')
                    ->label('Verification Status')
                    ->options([
                        'pending' => 'Pending',
                        'verified' => 'Verified',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->recordActions([
                Action::make('verify')
                    ->label('Verify')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->modalHeading('Verify Personality')
                    ->modalDescription('Confirm that the information and its sources have been reviewed.')
                    ->visible(fn (Personality $record): bool =>
                        $record->verification_status === VerificationStatus::PENDING
                    )
                    ->action(fn (Personality $record) =>
                        app(VerificationService::class)->verify($record)
                    ),

                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Rejection Reason')
                            ->required()
                            ->rows(3),
                    ])
                    ->visible(fn (Personality $record): bool =>
                        $record->verification_status !== VerificationStatus::REJECTED
                    )
                    ->action(fn (Personality $record, array $data) =>
                        app(VerificationService::class)->reject(
                            $record,
                            $data['notes']
                        )
                    ),

                Action::make('publish')
                    ->label('Publish')
                    ->color('success')
                    ->icon('heroicon-o-globe-alt')
                    ->requiresConfirmation()
                    ->visible(fn (Personality $record): bool =>
                        $record->verification_status === VerificationStatus::VERIFIED
                        && $record->publication_status !== PublicationStatus::PUBLISHED
                    )
                    ->action(fn (Personality $record) =>
                        $record->update([
                            'publication_status' => PublicationStatus::PUBLISHED,
                        ])
                    ),

                Action::make('archive')
                    ->label('Archive')
                    ->color('warning')
                    ->icon('heroicon-o-archive-box')
                    ->requiresConfirmation()
                    ->visible(fn (Personality $record): bool =>
                        $record->publication_status === PublicationStatus::PUBLISHED
                    )
                    ->action(fn (Personality $record) =>
                        $record->update([
                            'publication_status' => PublicationStatus::ARCHIVED,
                        ])
                    ),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}