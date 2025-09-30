<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Toggle;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('phone')
                    ->sortable(),

                TextColumn::make('address'),

               ToggleColumn::make('is_active')
    ->label('Active')
    ->sortable()
    ->action(function ($record, $state) {
        $record->is_active = $state;
        $record->save();
    })
,

            ])

            ->filters([
            SelectFilter::make('is_active')
                ->label('Status')
                ->options([
                    1 => 'Active',
                    0 => 'Inactive',
                ])
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
