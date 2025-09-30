<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;


class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Basic Information')
                ->schema([
                    TextInput::make('name')
                        ->label('Full Name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->unique(ignoreRecord: true)
                        ->required(),
                ])
                ->columns(2),

            Section::make('Contact Details')
                ->schema([
                    TextInput::make('phone')
                        ->label('Phone Number')
                        ->tel()
                        ->maxLength(10),

                    TextInput::make('address')
                        ->label('Address')
                        ->maxLength(255),
                ])
                ->columns(2),

            Section::make('Status')
                ->schema([
                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ])
                ->columns(1),
        ]);
    }
}
