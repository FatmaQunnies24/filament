<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Toggle;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            ImageColumn::make('image')
                ->label('Image')
                ->label('Image')
                ->size(50)
                ->extraAttributes(['class' => 'rounded-full']),
                TextColumn::make('name')
                    ->searchable(),
            TextColumn::make('category.name')
                ->label('Category')
                ->sortable()
                ->searchable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
            SelectFilter::make('category')
                ->label('Category')
                ->relationship('category', 'name'),

             TernaryFilter::make('is_active')
                ->label('Active')
                ->nullable(),
            ])
            ->recordActions([
            ActionGroup::make([
                ViewAction::make(),
                EditAction::make(),
            ]),
            ViewAction::make(),
            //   EditAction::make(),
    //             Action::make('view')
    // ->label('View')
    // ->modalHeading('Product Details')
    // ->form([
    //     TextInput::make('name')->disabled(),
    //     TextInput::make('sku')->disabled(),
    //     TextInput::make('price')->disabled(),
    //     TextInput::make('quantity')->disabled(),
    //     Toggle::make('is_active')->disabled(),
    //     Textarea::make('description')->disabled(),
    //     TextInput::make('category.name')->label('Category')->disabled(),
    // ])  ,

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
