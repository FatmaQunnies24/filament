<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms;
use App\Models\Product;
use App\Models\Customer;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Set;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Wizard::make([

          Step::make('Order Details')
                        ->schema([
                           

                           Select::make('customer_id')
                                ->label('Customer')
                                ->relationship('customer', 'name')
                                ->searchable()
                                ->required(),

                           TextInput::make('total')
                                ->label('Total')
                        ->disabled()
                        ->dehydrated()
                                ->numeric()
                                ->default(0.0),

                           Select::make('status')
                                ->label('Status')
                                ->options([
                                    'pending' => 'Pending',
                                    'processing' => 'Processing',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->default('pending')
                                ->required(),

                           DateTimePicker::make('order_date')
                                ->label('Order Date')
                                ->required(),

                           MarkdownEditor::make('notes')
                                ->columnSpanFull(),
                        ])->columns(2),


                    Step::make('Order Items')

                        ->schema([
                           Repeater::make('orderProducts')
                                ->relationship('orderProducts')

                        ->reactive()
                        ->afterStateUpdated(function ($state, $set, $get) {

                            $total = collect($state)->sum(function ($item) {
                                $quantity = $item['quantity'] ?? 0;
                                $price = $item['price'] ?? 0;
                                return $quantity * $price;
                            });

                            $set('total', $total);
                        })
                                ->schema([
                                   Select::make('product_id')
                                        ->label('Product')
                            ->searchable()
                                        ->options(Product::query()->pluck('name', 'id'))
                                        ->required()
                                        ->reactive()
                                                    ->afterStateUpdated(
                                fn($state, $set) =>
                                $set('price', Product::find($state)?->price ?? 0)
                            ),

                                   TextInput::make('quantity')
                                        ->label('Quantity')
                                        ->numeric()
                                        ->default(1)
                                        ->required()
                                        ->reactive()
                            ->afterStateUpdated(
                            fn($get) => $get('quantity') * $get('price')
                            ),


                        TextInput::make('price')
                                        ->label('price')
                                        ->disabled()
                                             ->dehydrated()
                                        ->required(),

                                   Placeholder::make('total_price')
                                        ->label('Total Price')
                                        ->content(fn($get) => $get('quantity') * $get('price')),
                                ])->columns(4)
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
