<?php

namespace App\Filament\Resources\DistrictInformations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Models\DistrictInformation;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Enums\PublicationStatus;
use App\Enums\VerificationStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

class DistrictInformationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('district.name')
                    ->label('District')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('area')
                    ->label('Area'),

                TextColumn::make('publication_status')
                    ->badge(),

                TextColumn::make('verification_status')
                    ->badge(),

                TextColumn::make('views')->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
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
                // Verify Institution
                Action::make('verify')
                    ->label('Verify')
                    ->icon('heroicon-o-shield-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Verify Institution')
                    ->modalDescription(
                        'Are you sure you want to verify this institution?'
                    )
                    ->visible(fn (DistrictInformation $record): bool =>
                        $record->verification_status === VerificationStatus::PENDING
                    )
                    ->action(function (DistrictInformation $record): void {
                        DB::transaction(function () use ($record): void {
                            $record->update([
                                'verification_status' => VerificationStatus::VERIFIED,
                                'verified_by' => Auth::id(),
                                'verified_at' => now(),
                                'verification_notes' => null,
                            ]);
                        });

                        Notification::make()
                            ->title('Institution verified successfully')
                            ->success()
                            ->send();
                    }),

                // Reject Institution
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
                    ->visible(fn (DistrictInformation $record): bool =>
                        in_array(
                            $record->verification_status,
                            [
                                VerificationStatus::PENDING,
                                VerificationStatus::VERIFIED,
                            ],
                            true
                        )
                    )
                    ->action(function (
                        DistrictInformation $record,
                        array $data
                    ): void {
                        $record->update([
                            'verification_status' => VerificationStatus::REJECTED,
                            'publication_status' => PublicationStatus::DRAFT,
                            'verified_by' => null,
                            'verified_at' => null,
                            'verification_notes' => $data['reason'],
                        ]);

                        Notification::make()
                            ->title('Institution rejected')
                            ->warning()
                            ->send();
                    }),

                // Publish Institution
                Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-o-globe-alt')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Publish Institution')
                    ->modalDescription(
                        'Only verified institutions can be published.'
                    )
                    ->visible(fn (DistrictInformation $record): bool =>
                        $record->verification_status === VerificationStatus::VERIFIED
                        && $record->publication_status !== PublicationStatus::PUBLISHED
                    )
                    ->action(function (DistrictInformation $record): void {
                        $record->update([
                            'publication_status' => PublicationStatus::PUBLISHED,
                        ]);

                        Notification::make()
                            ->title('Institution published successfully')
                            ->success()
                            ->send();
                    }),

                // Unpublish Institution
                Action::make('unpublish')
                    ->label('Unpublish')
                    ->icon('heroicon-o-eye-slash')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->visible(fn (DistrictInformation $record): bool =>
                        $record->publication_status === PublicationStatus::PUBLISHED
                    )
                    ->action(function (DistrictInformation $record): void {
                        $record->update([
                            'publication_status' => PublicationStatus::DRAFT,
                        ]);

                        Notification::make()
                            ->title('Institution unpublished')
                            ->success()
                            ->send();
                    }),

                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
