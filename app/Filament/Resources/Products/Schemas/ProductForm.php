<?php

namespace App\Filament\Resources\Products\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Basic Information')
                            ->schema([
                            TextInput::make('name')
    ->required()
    ->label('Product Name')
    ->live()
    ->afterStateUpdated(function ($state, $set) {

        $set('slug', Str::slug($state));
    }),

TextInput::make('slug')
    ->disabled()
    ->label('Slug'),

                                MarkdownEditor::make('description')
                                    ->label('Description')
                                    ->columnSpanFull(),
                            ])
                            ->columns(1),
                ]),
            Group::make()->schema([
                        Section::make('Details')
                            ->schema([
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),

                                TextInput::make('quantity')
                                    ->required()
                                    ->numeric()
                                    ->default(0),

                                TextInput::make('sku')
                                    ->label('SKU'),

                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true),
                            ])
                            ->columns(2),
                    ]),
            Group::make()
                ->schema([
                    Section::make('Basic Information')
                        ->schema([
                    FileUpload::make('image')
                        ->label('Product Image')
                        ->image()
                        ->directory('products')
                        ->nullable(),

                    Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->required(),


                ])
                        ->columns(1),
                ]),
            ]);
    }
}
