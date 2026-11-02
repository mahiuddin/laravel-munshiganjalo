<?php

namespace App\Filament\Resources\EducationInstitutions\Tables;

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

class EducationInstitutionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->disk('public')
                    ->square(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(35),

                TextColumn::make('category.name')
                    ->label('Category'),

                TextColumn::make('eiin')
                    ->label('EIIN')
                    ->searchable(),

                TextColumn::make('district.name')
                    ->label('District'),

                TextColumn::make('upazila.name')
                    ->label('Upazila'),

                TextColumn::make('publication_status')->badge(),

                TextColumn::make('verification_status')->badge(),

                TextColumn::make('views')->sortable(),
            ])
            ->filters([
                SelectFilter::make('education_category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),

                SelectFilter::make('district_id')
                    ->relationship('district', 'name')
                    ->label('District'),

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
