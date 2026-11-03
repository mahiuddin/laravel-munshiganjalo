<?php

namespace App\Filament\Resources\MediaOutlets\Tables;

use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use App\Models\MediaOutlet;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MediaOutletsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->label('Media Outlet')
                    ->searchable()
                    ->sortable()
                    ->limit(35),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),

                TextColumn::make('language')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('publication_frequency')
                    ->label('Frequency')
                    ->toggleable(),

                TextColumn::make('district.name')
                    ->label('District')
                    ->sortable(),

                TextColumn::make('upazila.name')
                    ->label('Upazila')
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('publication_status')
                    ->label('Publication')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state?->label() ?? 'Unknown'),

                TextColumn::make('verification_status')
                    ->label('Verification')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state?->label() ?? 'Unknown'),

                TextColumn::make('verifiedBy.name')
                    ->label('Verified By')
                    ->toggleable(),

                TextColumn::make('verified_at')
                    ->label('Verified At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('views')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])

            ->filters([
                SelectFilter::make('media_outlet_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),

                SelectFilter::make('district_id')
                    ->relationship('district', 'name')
                    ->label('District'),

                SelectFilter::make('publication_status')
                    ->options([
                        PublicationStatus::DRAFT->value => PublicationStatus::DRAFT->label(),
                        PublicationStatus::PUBLISHED->value => PublicationStatus::PUBLISHED->label(),
                        PublicationStatus::ARCHIVED->value => PublicationStatus::ARCHIVED->label(),
                    ]),

                SelectFilter::make('verification_status')
                    ->options(
                        collect(VerificationStatus::cases())
                            ->mapWithKeys(fn (VerificationStatus $status) => [
                                $status->value => $status->label(),
                            ])
                            ->all()
                    ),
            ])

            ->recordActions([
                EditAction::make(),

                Action::make('verify')
                    ->label('Verify')
                    ->icon('heroicon-o-shield-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Verify Media Outlet')
                    ->visible(fn (MediaOutlet $record): bool =>
                        $record->verification_status === VerificationStatus::PENDING
                    )
                    ->action(function (MediaOutlet $record): void {
                        DB::transaction(function () use ($record): void {
                            $record->update([
                                'verification_status' => VerificationStatus::VERIFIED,
                                'verified_by' => Auth::id(),
                                'verified_at' => now(),
                                'verification_notes' => null,
                            ]);
                        });

                        Notification::make()
                            ->title('Media outlet verified successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Textarea::make('reason')
                            ->label('Rejection Reason')
                            ->required()
                            ->rows(3),
                    ])
                    ->visible(fn (MediaOutlet $record): bool =>
                        in_array(
                            $record->verification_status,
                            [
                                VerificationStatus::PENDING,
                                VerificationStatus::VERIFIED,
                            ],
                            true
                        )
                    )
                    ->action(function (MediaOutlet $record, array $data): void {
                        $record->update([
                            'verification_status' => VerificationStatus::REJECTED,
                            'publication_status' => PublicationStatus::DRAFT,
                            'verified_by' => null,
                            'verified_at' => null,
                            'verification_notes' => $data['reason'],
                        ]);

                        Notification::make()
                            ->title('Media outlet rejected')
                            ->warning()
                            ->send();
                    }),

                Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-o-globe-alt')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (MediaOutlet $record): bool =>
                        $record->verification_status === VerificationStatus::VERIFIED
                        && $record->publication_status !== PublicationStatus::PUBLISHED
                    )
                    ->action(function (MediaOutlet $record): void {
                        $record->update([
                            'publication_status' => PublicationStatus::PUBLISHED,
                        ]);

                        Notification::make()
                            ->title('Media outlet published successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('unpublish')
                    ->label('Unpublish')
                    ->icon('heroicon-o-eye-slash')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->visible(fn (MediaOutlet $record): bool =>
                        $record->publication_status === PublicationStatus::PUBLISHED
                    )
                    ->action(function (MediaOutlet $record): void {
                        $record->update([
                            'publication_status' => PublicationStatus::DRAFT,
                        ]);

                        Notification::make()
                            ->title('Media outlet unpublished')
                            ->success()
                            ->send();
                    }),

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
