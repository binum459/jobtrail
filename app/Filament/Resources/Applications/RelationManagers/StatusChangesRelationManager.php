<?php

namespace App\Filament\Resources\Applications\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatusChangesRelationManager extends RelationManager
{
    protected static string $relationship = 'statusChanges';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('to_status')
            ->columns([
                TextColumn::make('from_status')
                    ->badge(),
                TextColumn::make('to_status')
                    ->badge(),
                TextColumn::make('changed_at')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('changed_at', 'asc')
            ->filters([
                //
            ]);
    }
}
