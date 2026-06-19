<?php

namespace App\Filament\Resources\Leads\Schemas;

use App\Enums\LeadStatus;
use App\Enums\LeadType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Select::make('type')
                    ->options(LeadType::class)
                    ->required(),
                Select::make('status')
                    ->options(LeadStatus::class)
                    ->default('new')
                    ->required(),
                Select::make('car_model_id')
                    ->relationship('carModel', 'name'),
                Select::make('car_trim_id')
                    ->relationship('carTrim', 'name'),
                Textarea::make('message')
                    ->columnSpanFull(),
                DateTimePicker::make('preferred_at'),
                KeyValue::make('metadata')
                    ->columnSpanFull(),
            ]);
    }
}
