<?php

namespace App\Filament\Resources\HistoricalPlaces\Tables;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Models\HistoricalPlace;
use App\Services\VerificationService;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Auth;

class HistoricalPlacesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->label('Place Name')
                    ->searchable()
                    ->sortable()
                    ->limit(35),

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
                    ->formatStateUsing(fn ($state) => $state instanceof PublicationStatus
                        ? $state->label()
                        : ucfirst((string) $state))
                    ->color(fn ($state) => match ($state instanceof PublicationStatus
                        ? $state->value : $state) {
                            'published' => 'success',
                            'archived' => 'gray',
                            default => 'warning',
                        }),

                TextColumn::make('verification_status')
                    ->label('Verification')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof VerificationStatus
                        ? $state->label()
                        : ucfirst((string) $state))
                    ->color(fn ($state) => match ($state instanceof VerificationStatus
                        ? $state->value : $state) {
                            'verified' => 'success',
                            'rejected' => 'danger',
                            default => 'warning',
                        }),

                TextColumn::make('views')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('historical_place_category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),

                SelectFilter::make('district_id')
                    ->label('District')
                    ->relationship('district', 'name'),

                SelectFilter::make('publication_status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),

                SelectFilter::make('verification_status')
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
                    ->requiresConfirmation()
                    ->visible(fn (HistoricalPlace $record): bool =>
                        $record->verification_status !== VerificationStatus::VERIFIED
                    )
                    ->action(fn (HistoricalPlace $record) =>
                        app(VerificationService::class)->verify(
                            $record,
                            'Information verified by administrator.',
                            Auth::id()
                        )
                    ),

                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Reason for rejection')
                            ->required(),
                    ])
                    ->visible(fn (HistoricalPlace $record): bool =>
                        $record->verification_status !== VerificationStatus::REJECTED
                    )
                    ->action(fn (HistoricalPlace $record, array $data) =>
                        app(VerificationService::class)->reject(
                            $record,
                            $data['notes'],
                            Auth::id()
                        )
                    ),

                Action::make('publish')
                    ->label('Publish')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (HistoricalPlace $record): bool =>
                        $record->verification_status === VerificationStatus::VERIFIED
                        && $record->publication_status !== PublicationStatus::PUBLISHED
                    )
                    ->action(fn (HistoricalPlace $record) =>
                        $record->update(['publication_status' => PublicationStatus::PUBLISHED])
                    ),

                Action::make('archive')
                    ->label('Archive')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->visible(fn (HistoricalPlace $record): bool =>
                        $record->publication_status !== PublicationStatus::ARCHIVED
                    )
                    ->action(fn (HistoricalPlace $record) =>
                        $record->update(['publication_status' => PublicationStatus::ARCHIVED])
                    ),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
