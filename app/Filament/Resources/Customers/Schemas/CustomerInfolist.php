<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;

class CustomerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
           ->components([

                TextEntry::make('name')
                    ->label('Full Name')
                    ->placeholder('-'),

                TextEntry::make('email')
                    ->label('Email Address')
                    ->placeholder('-'),

                TextEntry::make('phone')
                    ->label('Phone Number')
                    ->placeholder('-'),

                TextEntry::make('address')
                    ->label('Address')
                    ->placeholder('-'),

            Toggle::make('is_active')
                ->label('Active')
                ->default(true),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
