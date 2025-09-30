<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Toggle;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ForceDeleteBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

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
            ->bulkActions([
                ExportBulkAction::make()    ,    DeleteBulkAction::make(),
            ]) 



            ->toolbarActions([
                                // ExportBulkAction::make('Export to Excel'),

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
